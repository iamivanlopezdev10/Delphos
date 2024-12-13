@extends('layouts.app')

@section('template_title')
    Clientes
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card shadow-lg border-primary">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <span id="card_title">
                            <i class="fa fa-users"></i> {{ __('Clientes') }}
                        </span>
                        <div class="float-right">
                            <!-- Botón para abrir el modal -->
                            <button class="btn btn-sm btn-light" data-toggle="modal" data-target="#createModal">
                                <i class="fa fa-plus"></i> {{ __('Nuevo Cliente') }}
                            </button>
                        </div>
                    </div>
                </div>

                @if ($message = Session::get('success'))
                    <div class="alert alert-success m-4 alert-dismissible fade show" role="alert">
                        <i class="fa fa-check-circle"></i> {{ $message }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Clave</th>
                                    <th>Tipo Persona</th>
                                    <th>Razon Social</th>
                                    <th>Rfc</th>
                                    <th>Estado</th>
                                    <th>Ciudad</th>
                                    <th>Correo</th>
                                    <th>Telefono</th>
                                    <th>Representante</th>
                                    <th>Vendedor</th>
                                    <th>Activo</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($clientes as $cliente)
                                    <tr class="hoverable">
                                        <td>{{ $cliente->clave }}</td>
                                        <td>{{ $cliente->tipo_persona }}</td>
                                        <td>{{ $cliente->razon_social }}</td>
                                        <td>{{ $cliente->rfc }}</td>
                                        <td>{{ $cliente->estado }}</td>
                                        <td>{{ $cliente->ciudad }}</td>
                                        <td>{{ $cliente->correo }}</td>
                                        <td>{{ $cliente->telefono }}</td>
                                        <td>{{ $cliente->representante }}</td>
                                        <td>{{ $cliente->vendedor }}</td>
                                        <td>
                                            <span class="badge {{ $cliente->activo ? 'badge-success' : 'badge-danger' }}">
                                                <i class="fa {{ $cliente->activo ? 'fa-check' : 'fa-times' }}"></i>
                                                {{ $cliente->activo ? 'Sí' : 'No' }}
                                            </span>
                                        </td>
                                        <td>
                                            <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')

                                                <!-- Botón Show -->
                                                <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#showModal{{$cliente->id}}">
                                                    <i class="fa fa-eye"></i>
                                                </button>

                                                <!-- Botón Edit -->
                                                <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editModal{{$cliente->id}}">
                                                    <i class="fa fa-edit"></i>
                                                </button>

                                                <!-- Botón Delete -->
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
            {!! $clientes->links() !!}
        </div>
    </div>
</div>

<!-- Modal para crear nuevo cliente -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">{{ __('Create Cliente') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('clientes.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <!-- Aquí va el formulario de creación con todos los campos -->
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="clave">{{ __('Clave') }}</label>
                            <input type="text" name="clave" id="clave" class="form-control form-control-sm" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="tipo_persona">{{ __('Tipo Persona') }}</label>
                            <input type="text" name="tipo_persona" id="tipo_persona" class="form-control form-control-sm" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="razon_social">{{ __('Razon Social') }}</label>
                            <input type="text" name="razon_social" id="razon_social" class="form-control form-control-sm" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="rfc">{{ __('RFC') }}</label>
                            <input type="text" name="rfc" id="rfc" class="form-control form-control-sm" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="regimen_fiscal">{{ __('Regimen Fiscal') }}</label>
                            <input type="text" name="regimen_fiscal" id="regimen_fiscal" class="form-control form-control-sm" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="codigo_postal">{{ __('Codigo Postal') }}</label>
                            <input type="text" name="codigo_postal" id="codigo_postal" class="form-control form-control-sm" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="direccion">{{ __('Direccion') }}</label>
                            <input type="text" name="direccion" id="direccion" class="form-control form-control-sm" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="estado">{{ __('Estado') }}</label>
                            <input type="text" name="estado" id="estado" class="form-control form-control-sm" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="ciudad">{{ __('Ciudad') }}</label>
                            <input type="text" name="ciudad" id="ciudad" class="form-control form-control-sm" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="correo">{{ __('Correo') }}</label>
                            <input type="email" name="correo" id="correo" class="form-control form-control-sm" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="telefono">{{ __('Telefono') }}</label>
                            <input type="text" name="telefono" id="telefono" class="form-control form-control-sm" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="representante">{{ __('Representante') }}</label>
                            <input type="text" name="representante" id="representante" class="form-control form-control-sm" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="vendedor">{{ __('Vendedor') }}</label>
                            <input type="text" name="vendedor" id="vendedor" class="form-control form-control-sm" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="banco">{{ __('Banco') }}</label>
                            <input type="text" name="banco" id="banco" class="form-control form-control-sm" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="numero_cuenta">{{ __('Numero Cuenta') }}</label>
                            <input type="text" name="numero_cuenta" id="numero_cuenta" class="form-control form-control-sm" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="cuenta_interbancaria">{{ __('Cuenta Interbancaria') }}</label>
                            <input type="text" name="cuenta_interbancaria" id="cuenta_interbancaria" class="form-control form-control-sm" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="telefono_contacto">{{ __('Telefono Contacto') }}</label>
                            <input type="text" name="telefono_contacto" id="telefono_contacto" class="form-control form-control-sm" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="activo">{{ __('Activo') }}</label>
                            <select name="activo" id="activo" class="form-control form-control-sm">
                                <option value="1">{{ __('Yes') }}</option>
                                <option value="0">{{ __('No') }}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                    <button type="submit" class="btn btn-primary">{{ __('Create') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Edit -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">{{ __('Editar Cliente') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('clientes.update', $cliente->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="clave" class="col-sm-4 col-form-label">{{ __('Clave') }}</label>
                        <div class="col-sm-8">
                            <input type="text" name="clave" id="clave" class="form-control form-control-sm" value="{{ old('clave', $cliente->clave) }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tipo_persona" class="col-sm-4 col-form-label">{{ __('Tipo Persona') }}</label>
                        <div class="col-sm-8">
                            <input type="text" name="tipo_persona" id="tipo_persona" class="form-control form-control-sm" value="{{ old('tipo_persona', $cliente->tipo_persona) }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="razon_social" class="col-sm-4 col-form-label">{{ __('Razón Social') }}</label>
                        <div class="col-sm-8">
                            <input type="text" name="razon_social" id="razon_social" class="form-control form-control-sm" value="{{ old('razon_social', $cliente->razon_social) }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="rfc" class="col-sm-4 col-form-label">{{ __('RFC') }}</label>
                        <div class="col-sm-8">
                            <input type="text" name="rfc" id="rfc" class="form-control form-control-sm" value="{{ old('rfc', $cliente->rfc) }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="regimen_fiscal" class="col-sm-4 col-form-label">{{ __('Régimen Fiscal') }}</label>
                        <div class="col-sm-8">
                            <input type="text" name="regimen_fiscal" id="regimen_fiscal" class="form-control form-control-sm" value="{{ old('regimen_fiscal', $cliente->regimen_fiscal) }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="codigo_postal" class="col-sm-4 col-form-label">{{ __('Código Postal') }}</label>
                        <div class="col-sm-8">
                            <input type="text" name="codigo_postal" id="codigo_postal" class="form-control form-control-sm" value="{{ old('codigo_postal', $cliente->codigo_postal) }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="direccion" class="col-sm-4 col-form-label">{{ __('Dirección') }}</label>
                        <div class="col-sm-8">
                            <input type="text" name="direccion" id="direccion" class="form-control form-control-sm" value="{{ old('direccion', $cliente->direccion) }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="estado" class="col-sm-4 col-form-label">{{ __('Estado') }}</label>
                        <div class="col-sm-8">
                            <input type="text" name="estado" id="estado" class="form-control form-control-sm" value="{{ old('estado', $cliente->estado) }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="ciudad" class="col-sm-4 col-form-label">{{ __('Ciudad') }}</label>
                        <div class="col-sm-8">
                            <input type="text" name="ciudad" id="ciudad" class="form-control form-control-sm" value="{{ old('ciudad', $cliente->ciudad) }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="correo" class="col-sm-4 col-form-label">{{ __('Correo') }}</label>
                        <div class="col-sm-8">
                            <input type="email" name="correo" id="correo" class="form-control form-control-sm" value="{{ old('correo', $cliente->correo) }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="telefono" class="col-sm-4 col-form-label">{{ __('Teléfono') }}</label>
                        <div class="col-sm-8">
                            <input type="text" name="telefono" id="telefono" class="form-control form-control-sm" value="{{ old('telefono', $cliente->telefono) }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="representante" class="col-sm-4 col-form-label">{{ __('Representante') }}</label>
                        <div class="col-sm-8">
                            <input type="text" name="representante" id="representante" class="form-control form-control-sm" value="{{ old('representante', $cliente->representante) }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="vendedor" class="col-sm-4 col-form-label">{{ __('Vendedor') }}</label>
                        <div class="col-sm-8">
                            <input type="text" name="vendedor" id="vendedor" class="form-control form-control-sm" value="{{ old('vendedor', $cliente->vendedor) }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="banco" class="col-sm-4 col-form-label">{{ __('Banco') }}</label>
                        <div class="col-sm-8">
                            <input type="text" name="banco" id="banco" class="form-control form-control-sm" value="{{ old('banco', $cliente->banco) }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="numero_cuenta" class="col-sm-4 col-form-label">{{ __('Número Cuenta') }}</label>
                        <div class="col-sm-8">
                            <input type="text" name="numero_cuenta" id="numero_cuenta" class="form-control form-control-sm" value="{{ old('numero_cuenta', $cliente->numero_cuenta) }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cuenta_interbancaria" class="col-sm-4 col-form-label">{{ __('Cuenta Interbancaria') }}</label>
                        <div class="col-sm-8">
                            <input type="text" name="cuenta_interbancaria" id="cuenta_interbancaria" class="form-control form-control-sm" value="{{ old('cuenta_interbancaria', $cliente->cuenta_interbancaria) }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="telefono_contacto" class="col-sm-4 col-form-label">{{ __('Teléfono Contacto') }}</label>
                        <div class="col-sm-8">
                            <input type="text" name="telefono_contacto" id="telefono_contacto" class="form-control form-control-sm" value="{{ old('telefono_contacto', $cliente->telefono_contacto) }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="activo" class="col-sm-4 col-form-label">{{ __('Activo') }}</label>
                        <div class="col-sm-8">
                            <select name="activo" id="activo" class="form-control form-control-sm">
                                <option value="1" {{ old('activo', $cliente->activo) ? 'selected' : '' }}>{{ __('Sí') }}</option>
                                <option value="0" {{ old('activo', !$cliente->activo) ? 'selected' : '' }}>{{ __('No') }}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Cerrar') }}</button>
                    <button type="submit" class="btn btn-primary">{{ __('Guardar cambios') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Show -->
<div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="showModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showModalLabel">{{ __('Detalles del Cliente') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label for="clave" class="col-sm-4 col-form-label">{{ __('Clave') }}</label>
                    <div class="col-sm-8">
                        <input type="text" value="{{ $cliente->clave }}" class="form-control form-control-sm" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="tipo_persona" class="col-sm-4 col-form-label">{{ __('Tipo Persona') }}</label>
                    <div class="col-sm-8">
                        <input type="text" value="{{ $cliente->tipo_persona }}" class="form-control form-control-sm" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="razon_social" class="col-sm-4 col-form-label">{{ __('Razón Social') }}</label>
                    <div class="col-sm-8">
                        <input type="text" value="{{ $cliente->razon_social }}" class="form-control form-control-sm" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="rfc" class="col-sm-4 col-form-label">{{ __('RFC') }}</label>
                    <div class="col-sm-8">
                        <input type="text" value="{{ $cliente->rfc }}" class="form-control form-control-sm" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="regimen_fiscal" class="col-sm-4 col-form-label">{{ __('Régimen Fiscal') }}</label>
                    <div class="col-sm-8">
                        <input type="text" value="{{ $cliente->regimen_fiscal }}" class="form-control form-control-sm" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="codigo_postal" class="col-sm-4 col-form-label">{{ __('Código Postal') }}</label>
                    <div class="col-sm-8">
                        <input type="text" value="{{ $cliente->codigo_postal }}" class="form-control form-control-sm" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="direccion" class="col-sm-4 col-form-label">{{ __('Dirección') }}</label>
                    <div class="col-sm-8">
                        <input type="text" value="{{ $cliente->direccion }}" class="form-control form-control-sm" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="estado" class="col-sm-4 col-form-label">{{ __('Estado') }}</label>
                    <div class="col-sm-8">
                        <input type="text" value="{{ $cliente->estado }}" class="form-control form-control-sm" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="ciudad" class="col-sm-4 col-form-label">{{ __('Ciudad') }}</label>
                    <div class="col-sm-8">
                        <input type="text" value="{{ $cliente->ciudad }}" class="form-control form-control-sm" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="correo" class="col-sm-4 col-form-label">{{ __('Correo') }}</label>
                    <div class="col-sm-8">
                        <input type="email" value="{{ $cliente->correo }}" class="form-control form-control-sm" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="telefono" class="col-sm-4 col-form-label">{{ __('Teléfono') }}</label>
                    <div class="col-sm-8">
                        <input type="text" value="{{ $cliente->telefono }}" class="form-control form-control-sm" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="representante" class="col-sm-4 col-form-label">{{ __('Representante') }}</label>
                    <div class="col-sm-8">
                        <input type="text" value="{{ $cliente->representante }}" class="form-control form-control-sm" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="vendedor" class="col-sm-4 col-form-label">{{ __('Vendedor') }}</label>
                    <div class="col-sm-8">
                        <input type="text" value="{{ $cliente->vendedor }}" class="form-control form-control-sm" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="banco" class="col-sm-4 col-form-label">{{ __('Banco') }}</label>
                    <div class="col-sm-8">
                        <input type="text" value="{{ $cliente->banco }}" class="form-control form-control-sm" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="numero_cuenta" class="col-sm-4 col-form-label">{{ __('Número Cuenta') }}</label>
                    <div class="col-sm-8">
                        <input type="text" value="{{ $cliente->numero_cuenta }}" class="form-control form-control-sm" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="cuenta_interbancaria" class="col-sm-4 col-form-label">{{ __('Cuenta Interbancaria') }}</label>
                    <div class="col-sm-8">
                        <input type="text" value="{{ $cliente->cuenta_interbancaria }}" class="form-control form-control-sm" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="telefono_contacto" class="col-sm-4 col-form-label">{{ __('Teléfono Contacto') }}</label>
                    <div class="col-sm-8">
                        <input type="text" value="{{ $cliente->telefono_contacto }}" class="form-control form-control-sm" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="activo" class="col-sm-4 col-form-label">{{ __('Activo') }}</label>
                    <div class="col-sm-8">
                        <input type="text" value="{{ $cliente->activo ? 'Sí' : 'No' }}" class="form-control form-control-sm" readonly>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Cerrar') }}</button>
            </div>
        </div>
    </div>
</div>
<!-- Bootstrap JS (con Popper) -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap JS y Popper.js (requerido para los modales) -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>


@endsection
