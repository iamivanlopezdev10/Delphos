@extends('layouts.app')

@section('template_title')
    Órdenes de Compras
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card shadow-lg border-primary">
                    <div class="card-header bg-primary text-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <span id="card_title">
                                <i class="fa fa-shopping-cart"></i> {{ __('Órdenes de Compras') }}
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
                                                    <!-- Ver -->
                                                    <a class="btn btn-sm btn-info" href="{{ route('ordencompras.show', $orden->id) }}">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    <!-- Editar -->
                                                    <a class="btn btn-sm btn-warning" href="{{ route('ordencompras.edit', $orden->id) }}">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <!-- PDF -->
                                                    <a class="btn btn-sm btn-danger" href="{{ route('ordencompra.pdf', $orden->id) }}" target="_blank">
                                                        <i class="fa fa-file-pdf"></i>
                                                    </a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <!-- Eliminar -->
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
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="number" class="form-control" name="productos[0][cantidad]" placeholder="Cantidad" min="1" required>
                                                </div>
                                                <div class="col-md-12 mt-2">
                                                    <button type="button" class="btn btn-danger btn-sm remove-product-btn" onclick="removeProducto(0)">
                                                        <i class="fa fa-trash"></i> Eliminar Producto
                                                    </button>
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

                    <!-- Modal de Alerta (cuando no hay productos disponibles) -->
                    <div class="modal fade" id="alertModal" tabindex="-1" role="dialog" aria-labelledby="alertModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="alertModalLabel">¡Advertencia!</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Este proveedor no tiene productos disponibles.
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const proveedorSelect = document.getElementById('proveedor_id');
        const productosContainer = document.getElementById('productos-container');
        const addProductBtn = document.getElementById('add-product-btn');

        let productoIndex = 0; // Controlar el índice de los productos

        // Función para cargar productos del proveedor
        function cargarProductos(proveedorId, inicial = true) {
            if (!proveedorId) return;

            fetch(`/api/productos-por-proveedor/${proveedorId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.productos.length > 0) {
                        if (inicial) {
                            productosContainer.innerHTML = ''; // Limpiar productos actuales
                            agregarProducto(data.productos, productoIndex);
                        }
                    } else {
                        // Mostrar el modal de alerta cuando no haya productos disponibles
                        $('#alertModal').modal('show');
                    }
                })
                .catch(error => console.error('Error al cargar productos:', error));
        }

        // Función para agregar un producto al contenedor
        function agregarProducto(productos, index) {
            const productoDiv = document.createElement('div');
            productoDiv.classList.add('form-row', 'mb-3', 'producto-item');
            productoDiv.setAttribute('id', `producto-${index}`);

            const opciones = productos.map(producto =>
                `<option value="${producto.id}">${producto.descripcion}</option>`).join('');

            productoDiv.innerHTML = `
                <div class="col-md-8">
                    <select class="form-control" name="productos[${index}][producto_id]" required>
                        <option value="">Seleccione un Producto</option>
                        ${opciones}
                    </select>
                </div>
                <div class="col-md-4">
                    <input type="number" class="form-control" name="productos[${index}][cantidad]" placeholder="Cantidad" min="1" required>
                </div>
                <div class="col-md-12 mt-2">
                    <button type="button" class="btn btn-danger btn-sm remove-product-btn" onclick="removeProducto(${index})">
                        <i class="fa fa-trash"></i> Eliminar Producto
                    </button>
                </div>
            `;

            productosContainer.appendChild(productoDiv);
        }

        // Cargar productos al cambiar proveedor
        proveedorSelect.addEventListener('change', function() {
            const proveedorId = proveedorSelect.value;
            if (proveedorId) {
                productoIndex = 0; // Reiniciar índice
                cargarProductos(proveedorId);
            } else {
                productosContainer.innerHTML = '';
            }
        });

        // Agregar más productos manualmente
        addProductBtn.addEventListener('click', function() {
            const proveedorId = proveedorSelect.value;

            if (proveedorId) {
                fetch(`/api/productos-por-proveedor/${proveedorId}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.productos.length > 0) {
                            productoIndex++; // Incrementar índice
                            agregarProducto(data.productos, productoIndex);
                        } else {
                            // Mostrar el modal de alerta cuando no haya productos disponibles
                            $('#alertModal').modal('show');
                        }
                    })
                    .catch(error => console.error('Error al cargar productos:', error));
            } else {
                alert('Debe seleccionar un proveedor primero.');
            }
        });

        // Función para eliminar producto
        window.removeProducto = function(index) {
            const productoDiv = document.getElementById(`producto-${index}`);
            if (productoDiv) {
                productoDiv.remove();
            }
        };
    });
</script>
