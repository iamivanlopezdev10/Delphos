<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Proveedore;  // Agregar el modelo Proveedore
use App\Http\Requests\ProductoRequest;
use Illuminate\Http\Request;

/**
 * Class ProductoController
 * @package App\Http\Controllers
 */
class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos = Producto::paginate();
        $proveedores = Proveedore::all(); // Obtener todos los proveedores

        return view('producto.index', compact('productos', 'proveedores')) // Pasar proveedores a la vista
            ->with('i', (request()->input('page', 1) - 1) * $productos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $producto = new Producto();
        $proveedores = Proveedore::all(); // Obtener todos los proveedores

        return view('producto.create', compact('producto', 'proveedores')); // Pasar proveedores a la vista
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)  // Usamos Request directamente aquí
    {
        // Validación del formulario usando Request
        $validated = $request->validate([
            'clave_producto' => 'required',
            'descripcion' => 'required',
            'procedencia' => 'required',
            'tipo' => 'required',
            'clasificacion' => 'required',
            'stock' => 'required|integer',
            'precio_unitario' => 'required|numeric',
            'habilitado' => 'nullable|boolean',
            'proveedor_id' => 'required|integer',
        ]);

        // Guardar el producto
        Producto::create([
            'clave_producto' => $request->clave_producto,
            'descripcion' => $request->descripcion,
            'procedencia' => $request->procedencia,
            'tipo' => $request->tipo,
            'clasificacion' => $request->clasificacion,
            'stock' => $request->stock,
            'precio_unitario' => $request->precio_unitario,
            'habilitado' => $request->has('habilitado') ? 1 : 0,
            'proveedor_id' => $request->proveedor_id,
        ]);

        return redirect()->route('productos.index')->with('success', 'Producto creado exitosamente');
    }
    

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $producto = Producto::find($id);
        $proveedores = Proveedore::all(); // Obtener todos los proveedores

        return view('producto.show', compact('producto', 'proveedores')); // Pasar proveedores a la vista
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $producto = Producto::find($id);
        $proveedores = Proveedore::all(); // Obtener todos los proveedores

        return view('producto.edit', compact('producto', 'proveedores')); // Pasar proveedores a la vista
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Producto $producto)
    {
        // Validación de los campos del formulario
        $validated = $request->validate([
            'clave_producto' => 'required',
            'descripcion' => 'required',
            'procedencia' => 'required',
            'tipo' => 'required',
            'clasificacion' => 'required',
            'stock' => 'required|integer',
            'precio_unitario' => 'required|numeric',
            'habilitado' => 'nullable|boolean', // Habilitado como valor booleano
            'proveedor_id' => 'required|integer',
        ]);
    
        // Convertir el valor del checkbox 'habilitado' a booleano
        $validated['habilitado'] = $request->has('habilitado'); // 'habilitado' será true si está marcado
    
        // Actualizar el producto con los datos validados
        $producto->update($validated);
    
        return redirect()->route('productos.index')
            ->with('success', 'Producto actualizado con éxito');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Producto::find($id)->delete();

        return redirect()->route('productos.index')
            ->with('success', 'Producto deleted successfully');
    }
}
