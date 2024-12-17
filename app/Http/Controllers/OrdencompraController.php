<?php

namespace App\Http\Controllers;

use App\Models\Ordencompra;
use App\Models\DetalleOrdenCompra;
use App\Models\Proveedore;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrdencompraController extends Controller
{
    /**
     * Muestra la lista de órdenes de compra pendientes.
     */
    public function index()
    {
        // Solo mostrar órdenes con estado 'pendiente'
        $ordencompras = Ordencompra::with('proveedore', 'detalleordencompras.producto')
            ->where('estado', 'pendiente')
            ->paginate(10);
    
        $proveedores = Proveedore::all();
        $productos = Producto::all();
    
        return view('ordencompra.index', compact('ordencompras', 'proveedores', 'productos'))
            ->with('i', (request()->input('page', 1) - 1) * $ordencompras->perPage());
    }
    

    /**
     * Muestra el formulario para crear una nueva orden de compra.
     */
    public function create()
    {   
        $proveedores = Proveedore::all();
        $productos = Producto::all(); // Obtener productos para el formulario
        return view('ordencompra.index', compact('proveedores', 'productos'));
    }

    /**
     * Almacena una nueva orden de compra.
     */
    public function store(Request $request)
    {
        // Validación de los datos de entrada (sin validar clave_orden ya que la generamos)
        $request->validate([
            'fecha' => 'required|date',
            'estado' => 'required',
            'proveedor_id' => 'required|exists:proveedores,id',
            'productos' => 'required|array',
            'productos.*.producto_id' => 'required|exists:productos,id',
            'productos.*.cantidad' => 'required|integer|min:1',
        ]);

        // Iniciar una transacción para asegurar que todos los datos se guardan correctamente
        DB::beginTransaction();

        try {
            // Generación de la clave_orden con el formato requerido
            $ultimo = Ordencompra::latest('id')->first(); // Obtenemos la última orden
            $numeroOrden = $ultimo ? intval(substr($ultimo->clave_orden, 1)) + 1 : 1; // Si no hay órdenes, comenzamos con 1

            // Formateamos la clave_orden con 6 dígitos
            $claveOrden = str_pad($numeroOrden, 6, '0', STR_PAD_LEFT);

            // Crear la orden de compra
            $orden = Ordencompra::create([
                'clave_orden' => $claveOrden,
                'fecha' => $request->fecha,
                'estado' => $request->estado,
                'proveedor_id' => $request->proveedor_id,
            ]);

            // Crear los detalles de la orden de compra
            foreach ($request->productos as $productoData) {
                $producto = Producto::findOrFail($productoData['producto_id']);
                $cantidad = $productoData['cantidad'];

                // Crear el detalle de la orden de compra
                DetalleOrdenCompra::create([
                    'orden_id' => $orden->id,
                    'producto_id' => $producto->id,
                    'cantidad' => $cantidad,
                    'cantidad_recibida' => 0,  // No se ha recibido nada aún
                    'total' => $producto->precio_unitario * $cantidad,  // Total por la cantidad del producto
                    'recibido' => false,  // La orden no ha sido recibida aún
                ]);
            }

            // Confirmar la transacción si todo se guardó correctamente
            DB::commit();

            // Redirigir al listado de órdenes con un mensaje de éxito
            return redirect()->route('ordencompras.index')->with('success', 'Orden de compra creada exitosamente.');
        } catch (\Exception $e) {
            // Si algo falla, revertir la transacción
            DB::rollBack();

            // Volver a la página anterior con un mensaje de error
            return back()->withErrors(['error' => 'Error al crear la orden de compra: ' . $e->getMessage()]);
        }
    }


    /**
     * Actualiza una orden de compra existente en la base de datos.
     */
    public function update(Request $request, $id)
    {
        // Validaciones
        $request->validate([
            'clave_orden' => 'required|string|max:20|unique:ordencompras,clave_orden,' . $id,
            'fecha' => 'required|date',
            'proveedor_id' => 'required|exists:proveedores,id',
            'productos' => 'required|array',
            'productos.*.producto_id' => 'required|exists:productos,id',
            'productos.*.cantidad' => 'required|integer|min:1',
        ]);

        DB::beginTransaction();

        try {
            // Obtener la orden de compra
            $orden = Ordencompra::findOrFail($id);

            // Actualizar la orden de compra
            $orden->update([
                'clave_orden' => $request->clave_orden,
                'fecha' => $request->fecha,
                'proveedor_id' => $request->proveedor_id,
            ]);

            // Eliminar los detalles existentes de la orden
            $orden->detalleordencompras()->delete();

            // Crear los nuevos detalles de la orden
            foreach ($request->productos as $producto) {
                $productoModel = Producto::findOrFail($producto['producto_id']);

                DetalleOrdenCompra::create([
                    'orden_id' => $orden->id,
                    'producto_id' => $producto['producto_id'],
                    'cantidad' => $producto['cantidad'],
                    'total' => $productoModel->precio * $producto['cantidad'],
                    'recibido' => false,
                ]);
            }

            DB::commit();

            return redirect()->route('ordencompras.index')->with('success', 'Orden de compra actualizada correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Error al actualizar la orden: ' . $e->getMessage()]);
        }
    }

    /**
     * Finaliza una orden de compra y actualiza el stock de los productos.
     */
    public function finalizarOrden($id)
    {
        // Obtener el detalle de la orden
        $detalle = DetalleOrdenCompra::findOrFail($id);
    
        // Verificar si se han recibido todas las cantidades
        if ($detalle->cantidad_recibida >= $detalle->cantidad) {
            // Obtener la orden de compra relacionada con el detalle
            $ordenCompra = $detalle->ordencompra;
    
            // Actualizar el estado de la orden a 'finalizado'
            $ordenCompra->estado = 'finalizado';
            $ordenCompra->save();
    
            // Redirigir al index de las órdenes de compra
            return redirect()->route('ordencompras.index')->with('success', 'Detalle de orden de compra finalizado correctamente.');
        } else {
            return back()->withErrors(['error' => 'No todas las cantidades han sido recibidas.']);
        }
    }
    public function show($id)
{
    // Obtener la orden de compra con sus detalles relacionados
    $orden = Ordencompra::with(['proveedore', 'detalleordencompras.producto'])->findOrFail($id);

    // Retornar la vista con los detalles de la orden
    return view('ordencompra.show', compact('orden'));
}
public function edit($id)
{
    // Obtener la orden de compra por su ID
    $ordencompra = Ordencompra::findOrFail($id);
    
    // Obtener todos los proveedores y productos
    $proveedores = Proveedore::all();
    $productos = Producto::all();

    // Pasar los datos a la vista
    return view('ordencompra.edit', compact('ordencompra', 'proveedores', 'productos'));
}

    
    /**
     * Elimina una orden de compra.
     */
    public function destroy($id)
    {
        try {
            // Buscar la orden de compra por ID
            $ordencompra = Ordencompra::findOrFail($id);

            // Eliminar la orden de compra
            $ordencompra->delete();

            return redirect()->route('ordencompras.index')->with('success', 'Orden de compra eliminada correctamente.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Error al eliminar la orden: ' . $e->getMessage()]);
        }
    }
    public function detalle($id)
    {
        $orden = Ordencompra::with(['proveedore', 'detalleordencompras.producto'])->findOrFail($id);

        $detalles = $orden->detalleordencompras->map(function ($detalle) {
            return [
                'producto' => $detalle->producto,
                'cantidad' => $detalle->cantidad,
                'total' => $detalle->total,
            ];
        });

        return response()->json([
            'clave_orden' => $orden->clave_orden,
            'proveedor' => $orden->proveedore->nombre,
            'fecha' => $orden->fecha,
            'detalles' => $detalles,
        ]);
        }

    public function recibirProductos(Request $request, $ordenId)
    {
        $orden = Ordencompra::with('detalleordencompras.producto')->findOrFail($ordenId);

        DB::beginTransaction();

        try {
            foreach ($orden->detalleordencompras as $detalle) {
                $producto = $detalle->producto;
                $cantidadRecibida = $request->input('productos')[$producto->id] ?? 0;

                if ($cantidadRecibida > 0) {
                    // Actualizar la cantidad recibida en el detalle
                    $detalle->cantidad_recibida = $cantidadRecibida;
                    $detalle->recibido = true;
                    $detalle->save();

                    // Actualizar el stock del producto
                    $producto->stock += $cantidadRecibida;
                    $producto->save();
                }
            }

            // Cambiar el estado de la orden a 'completa' si todos los productos han sido recibidos
            $orden->estado = 'completa';
            $orden->save();

            DB::commit();
            return redirect()->route('ordencompras.index')->with('success', 'Productos recibidos y stock actualizado correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Error al recibir los productos: ' . $e->getMessage()]);
        }
    }


    public function getProductosPorProveedor($proveedorId)
    {
        // Obtener los productos asociados al proveedor seleccionado
        $productos = Producto::where('proveedor_id', $proveedorId)->get();

        // Retornar los productos en formato JSON
        return response()->json($productos);
    }
}
