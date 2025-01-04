@extends('layouts.app')

@section('template_title')
    Crear Venta
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card shadow-lg border-primary">
                    <div class="card-header bg-primary text-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <span id="card_title">
                                <i class="fa fa-shopping-cart"></i> {{ __('Ventas') }}
                            </span>
                            <div class="float-right">
                                <!-- Botón para abrir el modal -->
                                <button class="btn btn-sm btn-light" data-toggle="modal" data-target="#createVentaModal">
                                    <i class="fa fa-plus"></i> {{ __('Crear Nueva Venta') }}
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body bg-white">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Cliente</th>
                                        <th>Tipo Venta</th>
                                        <th>Metodo Pago</th>
                                        <th>Fecha Venta</th>
                                        <th>Total</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ventas as $venta)
                                        <tr class="hoverable">
                                            <td>{{ $venta->cliente->representante }}</td>
                                            <td>{{ $venta->tipo_venta }}</td>
                                            <td>{{ $venta->metodo_pago }}</td>
                                            <td>{{ $venta->fecha_venta }}</td>
                                            <td>{{ $venta->total }}</td>
                                            <td>
                                                <form action="{{ route('ventas.destroy', $venta->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-info" href="{{ route('ventas.show', $venta->id) }}">
                                                        <i class="fa fa-fw fa-eye"></i>
                                                    </a>
                                                    <a class="btn btn-sm btn-warning" href="{{ route('ventas.edit', $venta->id) }}">
                                                        <i class="fa fa-fw fa-edit"></i>
                                                    </a>
                                                    <!-- Botón o enlace para generar el PDF -->
                                                    <a href="{{ route('ventas.pdf', $venta->id) }}" class="btn btn-sm btn-danger" target="_blank">
                                                        <i class="fa fa-file-pdf"></i> 
                                                    </a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="fa fa-fw fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $ventas->links() !!}
            </div>
        </div>
    </div>
<!-- Modal para crear venta -->
<div class="modal fade" id="createVentaModal" tabindex="-1" role="dialog" aria-labelledby="createVentaModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="createVentaModalLabel">
                    <i class="fa fa-plus"></i> Crear Nueva Venta
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('ventas.store') }}" method="POST">
                    @csrf

                    <!-- Cliente y Tipo de Venta -->
                    <div class="form-row">
                        <!-- Cliente -->
                        <div class="form-group col-md-6">
                            <label for="cliente_id">Cliente</label>
                            <select class="form-control" id="cliente_id" name="cliente_id" required>
                                @foreach ($clientes as $cliente)
                                    <option value="{{ $cliente->id }}">{{ $cliente->representante }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Tipo de Venta -->
                        <div class="form-group col-md-6">
                            <label for="tipo_venta">Tipo de Venta</label>
                            <select class="form-control" id="tipo_venta" name="tipo_venta" required>
                                <option value="Sencilla">Sencilla</option>
                            </select>
                        </div>
                    </div>

                    <!-- Método de Pago y Fecha de Venta -->
                    <div class="form-row">
                        <!-- Método de Pago -->
                        <div class="form-group col-md-6">
                            <label for="metodo_pago">Método de Pago</label>
                            <select class="form-control" id="metodo_pago" name="metodo_pago" required>
                                <option value="Transferencia">Transferencia</option>
                                <option value="Tarjeta">Tarjeta</option>
                                <option value="Efectivo">Efectivo</option>
                            </select>
                        </div>

                        <!-- Fecha de Venta -->
                        <div class="form-group col-md-6">
                            <label for="fecha_venta">Fecha de Venta</label>
                            <input type="date" class="form-control" id="fecha_venta" name="fecha_venta" required>
                        </div>
                    </div>

                    <!-- Productos -->
                    <div class="form-group">
                        <label for="productos">Productos</label>
                        <div id="productos-container">
                            <div class="product-item mb-3">
                                <select class="form-control" name="productos[0][id]" required>
                                    @foreach ($productos as $producto)
                                        <option value="{{ $producto->id }}" data-stock="{{ $producto->stock }}">
                                            {{ $producto->descripcion }} (Stock: {{ $producto->stock }})
                                        </option>
                                    @endforeach
                                </select>
                                <input type="number" name="productos[0][cantidad]" placeholder="Cantidad" required min="1" class="form-control mt-2">
                                <button type="button" class="btn btn-danger btn-sm remove-product mt-2">Eliminar</button>
                            </div>
                        </div>
                        <button type="button" class="btn btn-info btn-sm mt-3" id="add-product">
                            <i class="fa fa-plus-circle"></i> Agregar Producto
                        </button>
                    </div>

                    <!-- Botón de envío -->
                    <button type="submit" class="btn btn-primary btn-block mt-4">Crear Venta</button>
                </form>
            </div>
        </div>
    </div>
</div>
    
    <script>
        // Agregar un nuevo producto
        document.getElementById('add-product').addEventListener('click', function() {
            var container = document.getElementById('productos-container');
            var index = container.getElementsByClassName('product-item').length;
            var newProduct = document.createElement('div');
            newProduct.classList.add('product-item', 'mb-3');
            newProduct.innerHTML = `
                <select class="form-control" name="productos[${index}][id]" required>
                    @foreach ($productos as $producto)
                        <option value="{{ $producto->id }}" data-stock="{{ $producto->stock }}">{{ $producto->descripcion }} (Stock: {{ $producto->stock }})</option>
                    @endforeach
                </select>
                <input type="number" name="productos[${index}][cantidad]" placeholder="Cantidad" required min="1" class="form-control mt-2">
                <button type="button" class="btn btn-danger btn-sm remove-product mt-2">Eliminar</button>
            `;
            container.appendChild(newProduct);
        });

        // Eliminar producto
        document.getElementById('productos-container').addEventListener('click', function(event) {
            if (event.target && event.target.classList.contains('remove-product')) {
                event.target.parentElement.remove();
            }
        });
    </script>
@endsection

<style>
    /* Estilos adicionales */
    .product-item {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .product-item select, .product-item input {
        flex-grow: 1;
    }

    .modal-header {
        border-bottom: 2px solid #eee;
    }

    .form-control {
        border-radius: 0.5rem;
    }

    .btn-info {
        border-radius: 0.3rem;
    }

    .btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
    }

    .btn-danger:hover {
        background-color: #c82333;
        border-color: #c82333;
    }

    .btn-sm {
        font-size: 0.875rem;
    }
</style>
