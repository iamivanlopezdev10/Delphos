<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Producto;
use App\Models\Detalleventa;
use App\Models\Cliente;
use Illuminate\Http\Request;
use PDF; // Esto es para utilizar el alias que registramos


class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = Cliente::all();  // Obtener todos los clientes
        $productos = Producto::all();  // Obtener todos los productos
        $ventas = Venta::paginate();

        return view('venta.index', compact('ventas', 'clientes', 'productos'))
            ->with('i', (request()->input('page', 1) - 1) * $ventas->perPage());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Validación de los datos de entrada
    $request->validate([
        'cliente_id' => 'required',
        'tipo_venta' => 'required',
        'metodo_pago' => 'required',
        'fecha_venta' => 'required|date',
        'productos' => 'required|array',
        'productos.*.id' => 'required|exists:productos,id',
        'productos.*.cantidad' => 'required|integer|min:1',
    ]);

    // Crear la venta
    $venta = Venta::create([
        'cliente_id' => $request->cliente_id,
        'tipo_venta' => $request->tipo_venta,
        'metodo_pago' => $request->metodo_pago,
        'fecha_venta' => $request->fecha_venta,
        'total' => 0,  // El total se calcula después
    ]);

    $totalVenta = 0;

    // Verificar stock y procesar los productos
    foreach ($request->productos as $productoData) {
        $producto = Producto::find($productoData['id']);
        $cantidad = $productoData['cantidad'];

        // Verificar que hay suficiente stock
        if ($producto->stock < $cantidad) {
            return redirect()->route('ventas.index')->with('error', 'No hay suficiente stock para el producto: ' . $producto->descripcion);
        }

        // Crear detalle de venta
        $subtotal = $producto->precio_unitario * $cantidad;
        $iva = $subtotal * 0.16;  // Suponiendo un 16% de IVA
        $totalVenta += $subtotal + $iva;

        Detalleventa::create([
            'venta_id' => $venta->id,
            'producto_id' => $producto->id,
            'cantidad' => $cantidad,
            'precio_unitario' => $producto->precio_unitario,
            'subtotal' => $subtotal,
            'iva' => $iva,
        ]);

        // Actualizar el stock del producto
        $producto->stock -= $cantidad;
        $producto->save();
    }

    // Actualizar el total de la venta
    $venta->total = $totalVenta;
    $venta->save();

    // Redirigir a la página de ventas con un mensaje de éxito
    return redirect()->route('ventas.index')->with('success', 'Venta creada con éxito');
}

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $venta = Venta::find($id);

        return view('venta.show', compact('venta'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $venta = Venta::find($id);
        $clientes = Cliente::all();  // Obtener todos los clientes
        $productos = Producto::all();  // Obtener todos los productos
        return view('venta.edit', compact('venta', 'clientes', 'productos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Venta $venta)
    {
        // Validación de datos
        $request->validate([
            'cliente_id' => 'required',
            'tipo_venta' => 'required',
            'metodo_pago' => 'required',
            'fecha_venta' => 'required|date',
        ]);

        // Actualizar la venta
        $venta->update([
            'cliente_id' => $request->cliente_id,
            'tipo_venta' => $request->tipo_venta,
            'metodo_pago' => $request->metodo_pago,
            'fecha_venta' => $request->fecha_venta,
        ]);

        return redirect()->route('ventas.index')->with('success', 'Venta actualizada con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Venta::find($id)->delete();

        return redirect()->route('ventas.index')->with('success', 'Venta eliminada con éxito');
    }
    public function generarPDF($id)
    {
        // Obtener la venta con su cliente y los detalles
        $venta = Venta::with(['cliente', 'detalleventas.producto'])->findOrFail($id);

        // Generar el PDF usando la vista 'venta.pdf'
        $pdf = PDF::loadView('venta.pdf', compact('venta'));

        // Descargar el archivo PDF
        return $pdf->download('Pdf_Venta' . $venta->clave_venta . '.pdf');
    }
}
