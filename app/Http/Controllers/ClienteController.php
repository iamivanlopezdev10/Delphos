<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Http\Requests\ClienteRequest;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = Cliente::all();  // Obtiene todos los clientes
        return view('cliente.index', compact('clientes'));  // Asegúrate de pasar 'clientes' a la vista
    }
    
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cliente = new Cliente();
        return view('cliente.create', compact('cliente'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClienteRequest $request)
    {
        Cliente::create($request->validated());

        return redirect()->route('clientes.index')
            ->with('success', 'Cliente creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function edit($id)
    {
        $cliente = Cliente::findOrFail($id);  // Encuentra el cliente por ID
        return view('cliente.index', compact('cliente'));  // Pasa el cliente a la vista
    }
    
    public function show($id)
    {
        $cliente = Cliente::findOrFail($id);  // Encuentra el cliente por ID
        return view('cliente.index', compact('cliente'));  // Pasa el cliente a la vista
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $cliente = Cliente::findOrFail($id);  // Encuentra el cliente por ID
    
        $cliente->update($request->all());  // Actualiza el cliente con los nuevos datos
    
        return redirect()->route('clientes.index')->with('success', 'Cliente actualizado correctamente.');
    }
    
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $cliente = Cliente::find($id);

        if ($cliente) {
            $cliente->delete();
            return redirect()->route('clientes.index')
                ->with('success', 'Cliente eliminado correctamente');
        }

        return redirect()->route('clientes.index')
            ->with('error', 'Cliente no encontrado');
    }
}
