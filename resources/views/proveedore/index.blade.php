@extends('layouts.app')

@section('template_title')
    Proveedores
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card shadow-lg border-primary">
                    <div class="card-header bg-primary text-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <span id="card_title">
                                <i class="fa fa-truck"></i> {{ __('Proveedores') }}
                            </span>
                            <div class="float-right">
                                <button class="btn btn-sm btn-light" data-toggle="modal" data-target="#createModal">
                                    <i class="fa fa-plus"></i> {{ __('Nuevo Proveedor') }}
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Clave</th>
                                        <th>Nombre</th>
                                        <th>RFC</th>
                                        <th>Estado</th>
                                        <th>Correo Órdenes</th>
                                        <th>Correo Pagos</th>
                                        <th>Teléfono</th>
                                        <th>Habilitado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($proveedores as $proveedore)
                                        <tr class="hoverable">
                                            <td>{{ $proveedore->clave_proveedor }}</td>
                                            <td>{{ $proveedore->nombre }}</td>
                                            <td>{{ $proveedore->rfc }}</td>
                                            <td>{{ $proveedore->estado }}</td>
                                            <td>{{ $proveedore->correo_ordenes }}</td>
                                            <td>{{ $proveedore->correo_pagos }}</td>
                                            <td>{{ $proveedore->telefono }}</td>
                                            <td>
                                                <span class="badge {{ $proveedore->habilitado ? 'badge-success' : 'badge-danger' }}">
                                                    <i class="fa {{ $proveedore->habilitado ? 'fa-check' : 'fa-times' }}"></i>
                                                    {{ $proveedore->habilitado ? 'Sí' : 'No' }}
                                                </span>
                                            </td>
                                            <td>
                                                <form action="{{ route('proveedores.destroy', $proveedore->id) }}" method="POST">
                                                    <a class="btn btn-info btn-sm" data-toggle="modal" data-target="#showModal{{$proveedore->id}}">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    
                                                    <!-- Modal para editar -->
                                                    <a class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal{{$proveedore->id}}">
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
                                        <!-- Modal Ver Proveedor -->
                                        <div class="modal fade" id="showModal{{$proveedore->id}}" tabindex="-1" aria-labelledby="showModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-info text-white">
                                                        <h5 class="modal-title" id="showModalLabel"><i class="fa fa-eye"></i> {{ __('Ver Proveedor') }}</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-row">
                                                            <div class="form-group col-md-4">
                                                                <label for="clave_proveedor">{{ __('Clave Proveedor') }}</label>
                                                                <input type="text" value="{{ $proveedore->clave_proveedor }}" class="form-control form-control-sm" id="clave_proveedor" disabled>
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label for="nombre">{{ __('Nombre') }}</label>
                                                                <input type="text" value="{{ $proveedore->nombre }}" class="form-control form-control-sm" id="nombre" disabled>
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label for="rfc">{{ __('RFC') }}</label>
                                                                <input type="text" value="{{ $proveedore->rfc }}" class="form-control form-control-sm" id="rfc" disabled>
                                                            </div>
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="form-group col-md-4">
                                                                <label for="estado">{{ __('Estado') }}</label>
                                                                <input type="text" value="{{ $proveedore->estado }}" class="form-control form-control-sm" id="estado" disabled>
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label for="correo_ordenes">{{ __('Correo Órdenes') }}</label>
                                                                <input type="text" value="{{ $proveedore->correo_ordenes }}" class="form-control form-control-sm" id="correo_ordenes" disabled>
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label for="telefono">{{ __('Teléfono') }}</label>
                                                                <input type="text" value="{{ $proveedore->telefono }}" class="form-control form-control-sm" id="telefono" disabled>
                                                            </div>
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="form-group col-md-4">
                                                                <label for="banco">{{ __('Banco') }}</label>
                                                                <input type="text" value="{{ $proveedore->banco }}" class="form-control form-control-sm" id="banco" disabled>
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label for="habilitado">{{ __('Habilitado') }}</label>
                                                                <input type="text" value="{{ $proveedore->habilitado ? 'Sí' : 'No' }}" class="form-control form-control-sm" id="habilitado" disabled>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">{{ __('Cerrar') }}</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal Editar Proveedor -->
                                        <div class="modal fade" id="editModal{{$proveedore->id}}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-warning text-white">
                                                        <h5 class="modal-title" id="editModalLabel"><i class="fa fa-edit"></i> {{ __('Editar Proveedor') }}</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{ route('proveedores.update', $proveedore->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">
                                                            <div class="form-row">
                                                                <div class="form-group col-md-4">
                                                                    <label for="clave_proveedor">{{ __('Clave Proveedor') }}</label>
                                                                    <input type="text" name="clave_proveedor" class="form-control form-control-sm" id="clave_proveedor" value="{{ $proveedore->clave_proveedor }}" required>
                                                                </div>
                                                                <div class="form-group col-md-4">
                                                                    <label for="nombre">{{ __('Nombre') }}</label>
                                                                    <input type="text" name="nombre" class="form-control form-control-sm" id="nombre" value="{{ $proveedore->nombre }}" required>
                                                                </div>
                                                                <div class="form-group col-md-4">
                                                                    <label for="rfc">{{ __('RFC') }}</label>
                                                                    <input type="text" name="rfc" class="form-control form-control-sm" id="rfc" value="{{ $proveedore->rfc }}" required>
                                                                </div>
                                                            </div>
                                                            <div class="form-row">
                                                                <div class="form-group col-md-4">
                                                                    <label for="estado">{{ __('Estado') }}</label>
                                                                    <input type="text" name="estado" class="form-control form-control-sm" id="estado" value="{{ $proveedore->estado }}" required>
                                                                </div>
                                                                <div class="form-group col-md-4">
                                                                    <label for="correo_ordenes">{{ __('Correo Órdenes') }}</label>
                                                                    <input type="email" name="correo_ordenes" class="form-control form-control-sm" id="correo_ordenes" value="{{ $proveedore->correo_ordenes }}" required>
                                                                </div>
                                                                <div class="form-group col-md-4">
                                                                    <label for="telefono">{{ __('Teléfono') }}</label>
                                                                    <input type="text" name="telefono" class="form-control form-control-sm" id="telefono" value="{{ $proveedore->telefono }}" required>
                                                                </div>
                                                            </div>
                                                            <div class="form-row">
                                                                <div class="form-group col-md-4">
                                                                    <label for="banco">{{ __('Banco') }}</label>
                                                                    <input type="text" name="banco" class="form-control form-control-sm" id="banco" value="{{ $proveedore->banco }}" required>
                                                                </div>
                                                                <div class="form-group col-md-4">
                                                                    <label for="habilitado">{{ __('Habilitado') }}</label>
                                                                    <select name="habilitado" id="habilitado" class="form-control form-control-sm" required>
                                                                        <option value="1" {{ $proveedore->habilitado ? 'selected' : '' }}>Sí</option>
                                                                        <option value="0" {{ !$proveedore->habilitado ? 'selected' : '' }}>No</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">{{ __('Cerrar') }}</button>
                                                            <button type="submit" class="btn btn-warning btn-sm">{{ __('Guardar Cambios') }}</button>
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

                <!-- Paginación Mejorada -->
                <div class="d-flex justify-content-center">
                    {!! $proveedores->links() !!}
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para crear un nuevo proveedor -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="createModalLabel"><i class="fa fa-plus-circle"></i> {{ __('Crear Nuevo Proveedor') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('proveedores.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="clave_proveedor">{{ __('Clave Proveedor') }}</label>
                                <input type="text" name="clave_proveedor" class="form-control form-control-sm" id="clave_proveedor" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="nombre">{{ __('Nombre') }}</label>
                                <input type="text" name="nombre" class="form-control form-control-sm" id="nombre" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="rfc">{{ __('RFC') }}</label>
                                <input type="text" name="rfc" class="form-control form-control-sm" id="rfc" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="codigo_postal">{{ __('Código Postal') }}</label>
                                <input type="text" name="codigo_postal" class="form-control form-control-sm" id="codigo_postal" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="estado">{{ __('Estado') }}</label>
                                <input type="text" name="estado" class="form-control form-control-sm" id="estado" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="correo_ordenes">{{ __('Correo Órdenes') }}</label>
                                <input type="email" name="correo_ordenes" class="form-control form-control-sm" id="correo_ordenes" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="correo_pagos">{{ __('Correo Pagos') }}</label>
                                <input type="email" name="correo_pagos" class="form-control form-control-sm" id="correo_pagos" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="banco">{{ __('Banco') }}</label>
                                <input type="text" name="banco" class="form-control form-control-sm" id="banco" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="numero_cuenta">{{ __('Número Cuenta') }}</label>
                                <input type="text" name="numero_cuenta" class="form-control form-control-sm" id="numero_cuenta" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="cuenta_interbancaria">{{ __('Cuenta Interbancaria') }}</label>
                                <input type="text" name="cuenta_interbancaria" class="form-control form-control-sm" id="cuenta_interbancaria" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="telefono">{{ __('Teléfono') }}</label>
                                <input type="text" name="telefono" class="form-control form-control-sm" id="telefono" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="habilitado">{{ __('Habilitado') }}</label>
                                <select name="habilitado" id="habilitado" class="form-control form-control-sm" required>
                                    <option value="1">Sí</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">{{ __('Cerrar') }}</button>
                        <button type="submit" class="btn btn-primary btn-sm">{{ __('Guardar') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection
