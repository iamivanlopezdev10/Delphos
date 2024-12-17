@extends('layouts.app')

@section('template_title')
    Órdenes de Compra Pendientes
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card shadow-lg border-primary">
                    <div class="card-header bg-primary text-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <span id="card_title">
                                <i class="fa fa-shopping-cart"></i> {{ __('Órdenes de Compra Pendientes') }}
                            </span>
                            <div class="float-right">
                                <!-- Botón para abrir el modal -->
                                <button class="btn btn-sm btn-light" data-toggle="modal" data-target="#createOrderModal">
                                    <i class="fa fa-plus"></i> {{ __('Crear Nueva Orden de Compra') }}
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body bg-white">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Clave de Orden</th>
                                        <th>Proveedor</th>
                                        <th>Fecha</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ordencompras as $orden)
                                        <tr class="hoverable">
                                            <td>{{ $orden->clave_orden }}</td>
                                            <td>{{ $orden->proveedore->nombre }}</td>
                                            <td>{{ $orden->fecha }}</td>
                                            <td>
                                                <span class="badge {{ $orden->estado == 'pendiente' ? 'badge-warning' : 'badge-success' }}">
                                                    {{ ucfirst($orden->estado) }}
                                                </span>
                                            </td>
                                            <td>
                                                <form action="{{ route('ordencompras.destroy', $orden->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-info" href="{{ route('ordencompras.show', $orden->id) }}">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    <a class="btn btn-sm btn-warning" href="{{ route('ordencompras.edit', $orden->id) }}">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <!-- Paginación -->
                            {{ $ordencompras->links() }}
                        </div>
                    </div>

                    <!-- Modal para crear nueva orden de compra -->
                    <div class="modal fade" id="createOrderModal" tabindex="-1" role="dialog" aria-labelledby="createOrderModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="createOrderModalLabel">Crear Orden de Compra</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('ordencompras.store') }}" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <!-- Fecha -->
                                        <div class="form-group">
                                            <label for="fecha">Fecha</label>
                                            <input type="date" class="form-control" id="fecha" name="fecha" required>
                                        </div>

                                        <!-- Estado -->
                                        <div class="form-group">
                                            <label for="estado">Estado</label>
                                            <select class="form-control" id="estado" name="estado" required>
                                                <option value="pendiente">Pendiente</option>
                                                <option value="completa">Completa</option>
                                                <option value="cancelada">Cancelada</option>
                                                <option value="finalizado">Finalizado</option>
                                            </select>
                                        </div>

                                        <!-- Proveedor -->
                                        <div class="form-group">
                                            <label for="proveedor_id">Proveedor</label>
                                            <select class="form-control" id="proveedor_id" name="proveedor_id" required>
                                                <option value="">Seleccione un Proveedor</option>
                                                @foreach ($proveedores as $proveedor)
                                                    <option value="{{ $proveedor->id }}">{{ $proveedor->nombre }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- Productos -->
                                        <div class="form-group" id="productos-container">
                                            <label for="productos">Productos</label>
                                            <div class="form-row mb-3 producto-item" id="producto-1">
                                                <div class="col-md-8">
                                                    <select class="form-control" name="productos[0][producto_id]" required>
                                                        <option value="">Seleccione un Producto</option>
                                                        @foreach ($productos as $producto)
                                                            <option value="{{ $producto->id }}">{{ $producto->descripcion }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="number" class="form-control" name="productos[0][cantidad]" placeholder="Cantidad" min="1" required>
                                                </div>
                                            </div>
                                        </div>

                                        <button type="button" class="btn btn-info" id="add-product-btn">Agregar Producto</button>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                        <button type="submit" class="btn btn-primary">Guardar Orden</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    let productCount = 1;  // Inicia con 1 producto por defecto

    document.addEventListener('DOMContentLoaded', function() {
        const addProductButton = document.getElementById('add-product-btn');
        const productosContainer = document.getElementById('productos-container');

        addProductButton.addEventListener('click', () => {
            productCount++;

            const newProduct = document.createElement('div');
            newProduct.classList.add('form-row', 'mb-3', 'producto-item');
            newProduct.setAttribute('id', `producto-${productCount}`);
            newProduct.innerHTML = `
                <div class="col-md-8">
                    <select class="form-control" name="productos[${productCount - 1}][producto_id]" required>
                        <option value="">Seleccione un Producto</option>
                        @foreach ($productos as $producto)
                            <option value="{{ $producto->id }}">{{ $producto->descripcion }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <input type="number" class="form-control" name="productos[${productCount - 1}][cantidad]" placeholder="Cantidad" min="1" required>
                </div>
            `;
            productosContainer.appendChild(newProduct);
        });
    });
</script>

