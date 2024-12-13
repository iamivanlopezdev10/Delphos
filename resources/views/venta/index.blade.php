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

                    <!-- Mostrar mensaje de éxito -->
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success m-4 alert-dismissible fade show" role="alert">
                            <i class="fa fa-check-circle"></i> {{ $message }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <!-- Mostrar mensaje de error -->
                    @if ($message = Session::get('error'))
                        <div class="alert alert-danger m-4 alert-dismissible fade show" role="alert">
                            <i class="fa fa-times-circle"></i> {{ $message }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

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
                        <!-- Cliente -->
                        <div class="form-group">
                            <label for="cliente_id">Cliente</label>
                            <select class="form-control" id="cliente_id" name="cliente_id" required>
                                @foreach ($clientes as $cliente)
                                    <option value="{{ $cliente->id }}">{{ $cliente->representante }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Tipo de Venta -->
                        <div class="form-group">
                            <label for="tipo_venta">Tipo de Venta</label>
                            <input type="text" class="form-control" id="tipo_venta" name="tipo_venta" required>
                        </div>

                        <!-- Método de Pago -->
                        <div class="form-group">
                            <label for="metodo_pago">Método de Pago</label>
                            <input type="text" class="form-control" id="metodo_pago" name="metodo_pago" required>
                        </div>

                        <!-- Fecha de Venta -->
                        <div class="form-group">
                            <label for="fecha_venta">Fecha de Venta</label>
                            <input type="date" class="form-control" id="fecha_venta" name="fecha_venta" required>
                        </div>

                        <!-- Productos -->
                        <div class="form-group">
                            <label for="productos">Productos</label>
                            <div id="productos-container">
                                <div class="product-item">
                                    <select class="form-control" name="productos[0][id]" required>
                                        @foreach ($productos as $producto)
                                            <option value="{{ $producto->id }}" data-stock="{{ $producto->stock }}">{{ $producto->descripcion }} (Stock: {{ $producto->stock }})</option>
                                        @endforeach
                                    </select>
                                    <input type="number" name="productos[0][cantidad]" placeholder="Cantidad" required min="1" class="form-control">
                                    <button type="button" class="btn btn-danger btn-sm remove-product" style="margin-top: 10px;">Eliminar</button>
                                </div>
                            </div>
                            <button type="button" class="btn btn-info btn-sm" id="add-product">Agregar Producto</button>
                        </div>

                        <button type="submit" class="btn btn-primary">Crear Venta</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script>
    // Función para actualizar el total del producto
    function updateProductTotal(productElement) {
        const quantityInput = productElement.querySelector("input[name*='cantidad']");
        const selectedOption = productElement.querySelector("select").selectedOptions[0];
        const stock = parseInt(selectedOption.getAttribute('data-stock'));
        const price = parseFloat(selectedOption.getAttribute('data-price'));
        const totalElement = productElement.querySelector(".product-total");
        
        const quantity = parseInt(quantityInput.value);
        if (quantity > stock) {
            // Mostrar un mensaje si la cantidad excede el stock
            totalElement.innerText = `Stock insuficiente. Solo hay ${stock} unidades disponibles.`;
            totalElement.classList.add("text-danger");
        } else {
            // Calcular el total
            const total = quantity * price;
            totalElement.innerText = `Total: $${total.toFixed(2)}`;
            totalElement.classList.remove("text-danger");
        }
    }

    // Al agregar un producto, establecer los datos iniciales
    document.getElementById('add-product').addEventListener('click', function() {
        const container = document.getElementById('productos-container');
        const newProduct = document.createElement('div');
        newProduct.classList.add('product-item');
        newProduct.innerHTML = `
            <select class="form-control" name="productos[${container.children.length}][id]" required>
                @foreach ($productos as $producto)
                    <option value="{{ $producto->id }}" data-stock="{{ $producto->stock }}" data-price="{{ $producto->precio_unitario }}">{{ $producto->descripcion }} (Stock: {{ $producto->stock }})</option>
                @endforeach
            </select>
            <input type="number" name="productos[${container.children.length}][cantidad]" placeholder="Cantidad" required min="1" class="form-control" oninput="updateProductTotal(this.parentElement)">
            <span class="product-total">Total: $0.00</span>
            <button type="button" class="btn btn-danger btn-sm remove-product" style="margin-top: 10px;">Eliminar</button>
        `;
        container.appendChild(newProduct);
        updateProductTotal(newProduct);
    });

    // Eliminar un producto del formulario
    document.getElementById('productos-container').addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-product')) {
            e.target.parentElement.remove();
        }
    });

    // Inicializa el total de los productos al cargar la página
    document.querySelectorAll('.product-item').forEach(function(productElement) {
        updateProductTotal(productElement);
    });
</script>
