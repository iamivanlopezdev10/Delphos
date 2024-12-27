<?php

namespace App\Http\Controllers;

use App\Models\Proveedore;  // Importa el modelo Proveedore
use App\Models\Producto;    // Si necesitas el conteo de productos también
use App\Models\Ordencompra; // Si necesitas el conteo de órdenes pendientes
use App\Models\Cliente;     // Si necesitas el conteo de clientes
use App\Models\Venta;       // Si necesitas el conteo de ventas
use Illuminate\Http\Request;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Obtener el conteo de cada modelo
        $proveedoresCount = Proveedore::count();
        $productosCount = Producto::count();
        $ordenesPendientesCount = OrdenCompra::where('estado', 'pendiente')->count();
        $clientesCount = Cliente::count();
        $ventasCount = Venta::count();

        // Pasar los datos a la vista
        return view('home', compact(
            'proveedoresCount',
            'productosCount',
            'ordenesPendientesCount',
            'clientesCount',
            'ventasCount'
        ));
    }
}
