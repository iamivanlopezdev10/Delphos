<?php

namespace App\Http\Controllers;

use App\Models\Detalleventa;
use App\Models\Producto;
use Illuminate\Http\Request;

class DetalleventaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $detalleventas = Detalleventa::paginate();  // Paginación de los detalles de ventas

        return view('detalleventa.index', compact('detalleventas'))
            ->with('i', (request()->input('page', 1) - 1) * $detalleventas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $productos = Producto::all();  // Obtener los productos

        $detalleventa = new Detalleventa();  // Crear un nuevo detalle de venta

        return view('detalleventa.create', compact('detalleventa', 'productos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos
        $request->validate([
            'venta_id' => 'required|exists:ventas,id',
            'producto_id' => 'required|exists:productos,id',
            'cantidad' => 'required|integer|min:1',
            'precio_unitario' => 'required|numeric',
        ]);

        // Crear el nuevo detalle de venta
        Detalleventa::create($request->all());

        return redirect()->route('ventas.index')->with('success', 'Detalle de venta creado con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $detalleventa = Detalleventa::find($id);

        return view('detalleventa.show', compact('detalleventa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $detalleventa = Detalleventa::find($id);
        $productos = Producto::all();

        return view('detalleventa.edit', compact('detalleventa', 'productos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $detalleventa = Detalleventa::find($id);

        // Validar los datos
        $request->validate([
            'cantidad' => 'required|integer|min:1',
            'precio_unitario' => 'required|numeric',
        ]);

        // Actualizar el detalle de venta
        $detalleventa->update($request->all());

        return redirect()->route('ventas.index')->with('success', 'Detalle de venta actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Detalleventa::find($id)->delete();

        return redirect()->route('ventas.index')->with('success', 'Detalle de venta eliminado con éxito');
    }
}
