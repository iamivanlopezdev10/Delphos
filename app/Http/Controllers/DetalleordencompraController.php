<?php

namespace App\Http\Controllers;

use App\Models\DetalleOrdenCompra;
use App\Models\Ordencompra;
use App\Models\Producto;
use Illuminate\Http\Request;

class DetalleordencompraController extends Controller
{
    /**
     * Muestra la lista de detalles de órdenes de compra.
     */
    public function index()
    {
        $detalleOrdenCompras = DetalleOrdenCompra::with('producto', 'ordencompra')->paginate(10);
        return view('detalleordencompra.index', compact('detalleOrdenCompras'));
    }

    /**
     * Muestra el formulario para crear un nuevo detalle de orden de compra.
     */
    public function create()
    {
        $detalleordencompra = new DetalleOrdenCompra();
        $productos = Producto::all();
        return view('detalleordencompra.create', compact('detalleordencompra', 'productos'));
    }

    /**
     * Almacena un nuevo detalle de orden de compra.
     */
    public function store(Request $request)
    {
        // Validación de los datos de entrada
        $request->validate([
            'orden_id' => 'required|exists:ordencompras,id',
            'producto_id' => 'required|exists:productos,id',
            'cantidad' => 'required|integer|min:1',
        ]);

        DetalleOrdenCompra::create($request->all());

        // Redirigir al index de las órdenes de compra
        return redirect()->route('ordencompras.index')->with('success', 'Detalle de orden de compra guardado correctamente.');
    }

    /**
     * Actualiza la cantidad recibida de un detalle de orden de compra.
     */
    public function actualizarCantidadRecibida(Request $request, $detalleId)
    {
        $detalle = DetalleOrdenCompra::findOrFail($detalleId);
        $producto = $detalle->producto;
        $cantidadRecibida = $request->input('cantidad_recibida');

        // Actualizar cantidad recibida y stock
        if ($cantidadRecibida > 0) {
            $detalle->cantidad_recibida = $cantidadRecibida;
            $detalle->recibido = true;
            $detalle->save();

            // Actualizar el stock
            $producto->stock += $cantidadRecibida;
            $producto->save();

            // Redirigir al index de las órdenes de compra
            return redirect()->route('ordencompras.index')->with('success', 'Cantidad recibida actualizada correctamente.');
        } else {
            return back()->withErrors(['error' => 'La cantidad recibida debe ser mayor que cero.']);
        }
    }
    /**
     * Finaliza un detalle de orden de compra.
     */
    public function finalizarOrden($id)
    {
        $detalle = DetalleOrdenCompra::findOrFail($id);
        $ordenCompra = $detalle->ordencompra; // Obtener la orden asociada al detalle

        // Verificar si todas las cantidades han sido recibidas
        if ($detalle->cantidad_recibida >= $detalle->cantidad) {
            // Cambiar el estado de la orden de compra a 'finalizado'
            $ordenCompra->estado = 'finalizado';
            $ordenCompra->save(); // Guardar la orden con el nuevo estado

            // Redirigir al índice de las órdenes de compra
            return redirect()->route('ordencompras.index')->with('success', 'Orden de compra finalizada correctamente.');
        } else {
            return back()->withErrors(['error' => 'No todas las cantidades han sido recibidas.']);
        }
    }

    /**
     * Elimina una orden de compra.
     */
    public function eliminarOrden($id)
    {
        // Buscar la orden de compra
        $ordenCompra = Ordencompra::findOrFail($id);

        // Eliminar los detalles asociados a la orden
        Detalleordencompra::where('orden_id', $ordenCompra->id)->delete();

        // Eliminar la orden de compra
        $ordenCompra->delete();

        // Redirigir al índice de las órdenes de compra
        return redirect()->route('ordencompras.index')->with('success', 'Orden de compra y sus detalles eliminados correctamente.');
    }
    
    
}
