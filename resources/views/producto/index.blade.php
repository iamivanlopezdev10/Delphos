@extends('layouts.app')

@section('template_title')
    Producto
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card shadow-lg border-primary">
                    <div class="card-header bg-primary text-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <span id="card_title">
                                <i class="fa fa-cube"></i> {{ __('Producto') }}
                            </span>

                            <!-- Botón para abrir el modal -->
                            <button type="button" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#createProductModal">
                                <i class="fa fa-plus"></i> {{ __('Nuevo Producto') }}
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Clave Producto</th>
                                        <th>Descripción</th>
                                        <th>Procedencia</th>
                                        <th>Tipo</th>
                                        <th>Clasificación</th>
                                        <th>Stock</th>
                                        <th>Precio Unitario</th>
                                        <th>Proveedor</th>
                                        <th>Habilitado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($productos as $producto)
                                        <tr class="hoverable">
                                            <td>{{ $producto->clave_producto }}</td>
                                            <td>{{ $producto->descripcion }}</td>
                                            <td>{{ $producto->procedencia }}</td>
                                            <td>{{ $producto->tipo }}</td>
                                            <td>{{ $producto->clasificacion }}</td>
                                            <td>{{ $producto->stock }}</td>
                                            <td>${{ number_format($producto->precio_unitario, 2) }}</td>
                                            <td>{{ $producto->proveedore->nombre }}</td>
                                            <td>
                                                <span class="badge {{ $producto->habilitado ? 'badge-success' : 'badge-danger' }}">
                                                    <i class="fa {{ $producto->habilitado ? 'fa-check' : 'fa-times' }}"></i>
                                                    {{ $producto->habilitado ? 'Sí' : 'No' }}
                                                </span>
                                            </td>
                                            <td>
                                                <form action="{{ route('productos.destroy', $producto->id) }}" method="POST">
                                                    <!-- Ver Producto -->
                                                    <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#viewProductModal{{ $producto->id }}">
                                                        <i class="fa fa-eye"></i>
                                                    </button>

                                                    <!-- Editar Producto -->
                                                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editProductModal{{ $producto->id }}">
                                                        <i class="fa fa-edit"></i>
                                                    </button>

                                                    <!-- Eliminar Producto -->
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>

                                        <!-- Modal Ver Producto -->
                                        <div class="modal fade" id="viewProductModal{{ $producto->id }}" tabindex="-1" aria-labelledby="viewProductModalLabel{{ $producto->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="viewProductModalLabel{{ $producto->id }}">Ver Producto: {{ $producto->descripcion }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p><strong>Clave Producto:</strong> {{ $producto->clave_producto }}</p>
                                                        <p><strong>Descripción:</strong> {{ $producto->descripcion }}</p>
                                                        <p><strong>Procedencia:</strong> {{ $producto->procedencia }}</p>
                                                        <p><strong>Tipo:</strong> {{ $producto->tipo }}</p>
                                                        <p><strong>Clasificación:</strong> {{ $producto->clasificacion }}</p>
                                                        <p><strong>Stock:</strong> {{ $producto->stock }}</p>
                                                        <p><strong>Precio Unitario:</strong> ${{ number_format($producto->precio_unitario, 2) }}</p>
                                                        <p><strong>Proveedor:</strong> {{ $producto->proveedore->nombre }}</p>
                                                        <p><strong>Habilitado:</strong> {{ $producto->habilitado ? 'Sí' : 'No' }}</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal Editar Producto -->
                                        <div class="modal fade" id="editProductModal{{ $producto->id }}" tabindex="-1" aria-labelledby="editProductModalLabel{{ $producto->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editProductModalLabel{{ $producto->id }}">Editar Producto: {{ $producto->descripcion }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('productos.update', $producto->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label for="clave_producto" class="form-label">Clave Producto</label>
                                                                <input type="text" name="clave_producto" class="form-control" value="{{ $producto->clave_producto }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="descripcion" class="form-label">Descripción</label>
                                                                <input type="text" name="descripcion" class="form-control" value="{{ $producto->descripcion }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="procedencia" class="form-label">Procedencia</label>
                                                                <input type="text" name="procedencia" class="form-control" value="{{ $producto->procedencia }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="tipo" class="form-label">Tipo</label>
                                                                <input type="text" name="tipo" class="form-control" value="{{ $producto->tipo }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="clasificacion" class="form-label">Clasificación</label>
                                                                <input type="text" name="clasificacion" class="form-control" value="{{ $producto->clasificacion }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="stock" class="form-label">Stock</label>
                                                                <input type="number" name="stock" class="form-control" value="{{ $producto->stock }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="precio_unitario" class="form-label">Precio Unitario</label>
                                                                <input type="number" name="precio_unitario" class="form-control" value="{{ $producto->precio_unitario }}" step="0.01" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="habilitado" class="form-label">Habilitado</label>
                                                                <select name="habilitado" class="form-control" required>
                                                                    <option value="1" {{ $producto->habilitado ? 'selected' : '' }}>Sí</option>
                                                                    <option value="0" {{ !$producto->habilitado ? 'selected' : '' }}>No</option>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="proveedor_id" class="form-label">Proveedor</label>
                                                                <select name="proveedor_id" class="form-control" required>
                                                                    @foreach($proveedores as $proveedore)
                                                                        <option value="{{ $proveedore->id }}" {{ $proveedore->id == $producto->proveedor_id ? 'selected' : '' }}>
                                                                            {{ $proveedore->nombre }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $productos->links() !!}
            </div>
        </div>
    </div>
@endsection
<!-- Modal para Crear Producto -->
<div class="modal fade" id="createProductModal" tabindex="-1" role="dialog" aria-labelledby="createProductModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createProductModalLabel">Crear un producto</h5>
            </div>
            <form action="{{ route('productos.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <!-- Fila de Campos en Horizontal -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="clave_producto" class="form-label">Clave Producto</label>
                                <input type="text" name="clave_producto" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="descripcion" class="form-label">Descripción</label>
                                <input type="text" name="descripcion" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <!-- Fila de Campos en Horizontal -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="procedencia" class="form-label">Procedencia</label>
                                <input type="text" name="procedencia" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="tipo" class="form-label">Tipo</label>
                                <input type="text" name="tipo" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <!-- Fila de Campos en Horizontal -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="clasificacion" class="form-label">Clasificación</label>
                                <input type="text" name="clasificacion" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="stock" class="form-label">Stock</label>
                                <input type="number" name="stock" class="form-control" value="0" required readonly>
                            </div>
                        </div>
                    </div>

                    <!-- Fila de Campos en Horizontal -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="precio_unitario" class="form-label">Precio Unitario</label>
                                <input type="number" name="precio_unitario" class="form-control" step="0.01" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="habilitado" class="form-label">Habilitado</label>
                                <select name="habilitado" class="form-control" required>
                                    <option value="1">Sí</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Fila de Campos en Horizontal -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="proveedor_id" class="form-label">Proveedor</label>
                                <select name="proveedor_id" class="form-control" required>
                                    @foreach($proveedores as $proveedore)
                                        <option value="{{ $proveedore->id }}">{{ $proveedore->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Crear Producto</button>
                </div>
            </form>
        </div>
    </div>
</div>
