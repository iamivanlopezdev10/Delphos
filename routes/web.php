<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    HomeController,
    ProveedoreController,
    ProductoController,
    OrdencompraController,
    DetalleordencompraController,
    ClienteController,
    VentaController,
    DetalleventaController
};

// Rutas públicas (inicio de sesión)
Route::get('/', function () {
    return view('auth.login'); // Página de login
})->name('login');

// Autenticación
Auth::routes();

// Rutas protegidas por el middleware 'auth'
Route::middleware(['auth'])->group(function () {

    // Página principal después de autenticarse
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Rutas de recursos
    Route::resource('proveedores', ProveedoreController::class);
    Route::resource('productos', ProductoController::class);
    Route::resource('ordencompras', OrdencompraController::class);
    Route::resource('detalleordencompras', DetalleordencompraController::class);
    Route::resource('clientes', ClienteController::class);
    Route::resource('ventas', VentaController::class);
    Route::resource('detalleventas', DetalleventaController::class);
    
    Route::delete('/detalleordencompras/{id}/eliminar', [DetalleordencompraController::class, 'eliminarOrden'])->name('detalleordencompras.eliminarOrden');

    // Rutas personalizadas
    Route::put('/ordencompra/{id}/finalizar', [OrdencompraController::class, 'finalizar'])->name('ordencompras.finalizar');

    // Rutas específicas para Detalleordencompra
    Route::get('detalleordencompras/{id}/edit', [DetalleordencompraController::class, 'edit'])->name('detalleordencompras.edit');
    Route::put('detalleordencompras/{id}', [DetalleordencompraController::class, 'update'])->name('detalleordencompras.update');

    // Ruta para finalizar un detalle de orden de compra
    Route::patch('detalleordencompras/{id}/finalizar', [DetalleordencompraController::class, 'finalizarOrden'])->name('detalleordencompras.finalizarOrden');
    Route::delete('detalleordencompras/eliminarOrden/{id}', [DetalleordencompraController::class, 'eliminarOrden'])->name('detalleordencompras.eliminarOrden');
    Route::delete('detalleordencompras/eliminarOrden/{id}', [DetalleordencompraController::class, 'eliminarOrden'])->name('detalleordencompras.eliminarOrden');

    // Rutas personalizadas para obtener el detalle de una orden
    Route::get('detalleordencompras/{id}', [DetalleordencompraController::class, 'show'])->name('detalleordencompras.show');
    Route::put('detalleordencompras/{detalleId}/actualizarCantidadRecibida', [DetalleordencompraController::class, 'actualizarCantidadRecibida'])->name('detalleordencompras.actualizarCantidadRecibida');
    Route::put('detalleordencompras/{detalleId}/actualizarCantidadRecibida', [DetalleordencompraController::class, 'actualizarCantidadRecibida'])->name('detalleordencompras.actualizarCantidadRecibida');
    Route::put('detalleordencompras/{detalleId}/finalizar', [DetalleordencompraController::class, 'finalizarOrden'])->name('detalleordencompras.finalizarOrden');

    // Ruta para finalizar una orden de compra
    Route::put('ordencompras/{id}/finalizar', [OrdencompraController::class, 'finalizarOrden'])->name('ordencompras.finalizar');

    // Ruta para finalizar un detalle de orden de compra
    Route::put('detalleordencompras/{id}/finalizar', [DetalleordencompraController::class, 'finalizarOrden'])->name('detalleordencompras.finalizarOrden');
    Route::put('/ordencompras/{id}/finalizar', [OrdenCompraController::class, 'finalizarOrden'])->name('ordencompras.finalizarOrden');
    Route::get('productos-por-proveedor/{proveedorId}', [OrdencompraController::class, 'getProductosPorProveedor'])->name('productos.porProveedor');


});
