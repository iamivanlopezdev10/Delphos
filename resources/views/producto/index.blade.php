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
                                            <td>{{ $producto->stock }}</td>
                                            <td>{{ $producto->precio_unitario }}</td>
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
                                                    <a class="btn btn-info btn-sm" href="{{ route('productos.show', $producto->id) }}">
                                                        <i class="fa fa-eye"></i>
                                                    </a>

                                                    <!-- Editar Producto -->
                                                    <a class="btn btn-warning btn-sm" href="{{ route('productos.edit', $producto->id) }}">
                                                        <i class="fa fa-edit"></i>
                                                    </a>

                                                    <!-- Eliminar Producto -->
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
                    <!-- Formulario Horizontal -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="clave_producto" class="form-label">{{ __('Clave Producto') }}</label>
                                <input type="text" name="clave_producto" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="descripcion" class="form-label">{{ __('nombre') }}</label>
                                <input type="text" name="descripcion" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="procedencia" class="form-label">{{ __('Procedencia') }}</label>
                                <input type="text" name="procedencia" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="tipo" class="form-label">{{ __('Tipo') }}</label>
                                <input type="text" name="tipo" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="clasificacion" class="form-label">{{ __('Clasificación') }}</label>
                                <input type="text" name="clasificacion" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="stock" class="form-label">{{ __('Stock') }}</label>
                                <!-- Aquí agregamos value="0" para poner el valor predeterminado -->
                                <input type="number" name="stock" class="form-control" value="0" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="precio_unitario" class="form-label">{{ __('Precio Unitario') }}</label>
                                <input type="number" step="0.01" name="precio_unitario" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="habilitado" class="form-label">{{ __('Habilitado') }}</label>
                                <select name="habilitado" class="form-control" required>
                                    <option value="1">{{ __('Sí') }}</option>
                                    <option value="0">{{ __('No') }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="proveedor_id" class="form-label">{{ __('Proveedor') }}</label>
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
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cerrar') }}</button>
                    <button type="submit" class="btn btn-primary">{{ __('Guardar Producto') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
