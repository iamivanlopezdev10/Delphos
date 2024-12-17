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
                                        <td>{{ $cliente->tipo_persona ? 'Moral' : 'Física' }}</td>
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

                                    <!-- Modal Show -->
                                    <div class="modal fade" id="showModal{{$cliente->id}}" tabindex="-1" role="dialog" aria-labelledby="showModalLabel{{$cliente->id}}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="showModalLabel{{$cliente->id}}">{{ __('Detalles de Cliente') }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p><strong>{{ __('Clave') }}:</strong> {{ $cliente->clave }}</p>
                                                    <p><strong>{{ __('Tipo Persona') }}:</strong> {{ $cliente->tipo_persona ? 'Moral' : 'Física' }}</p>
                                                    <p><strong>{{ __('Razon Social') }}:</strong> {{ $cliente->razon_social }}</p>
                                                    <p><strong>{{ __('RFC') }}:</strong> {{ $cliente->rfc }}</p>
                                                    <p><strong>{{ __('Régimen Fiscal') }}:</strong> {{ $cliente->regimen_fiscal }}</p>
                                                    <p><strong>{{ __('Código Postal') }}:</strong> {{ $cliente->codigo_postal }}</p>
                                                    <p><strong>{{ __('Dirección') }}:</strong> {{ $cliente->direccion }}</p>
                                                    <p><strong>{{ __('Estado') }}:</strong> {{ $cliente->estado }}</p>
                                                    <p><strong>{{ __('Ciudad') }}:</strong> {{ $cliente->ciudad }}</p>
                                                    <p><strong>{{ __('Correo') }}:</strong> {{ $cliente->correo }}</p>
                                                    <p><strong>{{ __('Teléfono') }}:</strong> {{ $cliente->telefono }}</p>
                                                    <p><strong>{{ __('Representante') }}:</strong> {{ $cliente->representante }}</p>
                                                    <p><strong>{{ __('Vendedor') }}:</strong> {{ $cliente->vendedor }}</p>
                                                    <p><strong>{{ __('Banco') }}:</strong> {{ $cliente->banco }}</p>
                                                    <p><strong>{{ __('Número de Cuenta') }}:</strong> {{ $cliente->numero_cuenta }}</p>
                                                    <p><strong>{{ __('CLABE Interbancaria') }}:</strong> {{ $cliente->cuenta_interbancaria }}</p>
                                                    <p><strong>{{ __('Teléfono de Contacto') }}:</strong> {{ $cliente->telefono_contacto }}</p>
                                                    <p><strong>{{ __('Activo') }}:</strong> {{ $cliente->activo ? 'Sí' : 'No' }}</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Cerrar') }}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal Edit -->
                                    <div class="modal fade" id="editModal{{$cliente->id}}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{$cliente->id}}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalLabel{{$cliente->id}}">{{ __('Editar Cliente') }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{ route('clientes.update', $cliente->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <!-- Formulario de edición -->
                                                        <div class="row">
                                                            <div class="col-md-6 form-group">
                                                                <label for="clave">{{ __('Clave') }}</label>
                                                                <input type="text" name="clave" id="clave" class="form-control form-control-sm" value="{{ $cliente->clave }}" required>
                                                            </div>
                                                            <div class="col-md-6 form-group">
                                                                <label for="tipo_persona">{{ __('Tipo Persona') }}</label>
                                                                <select name="tipo_persona" id="tipo_persona" class="form-control form-control-sm">
                                                                    <option value="1" {{ $cliente->tipo_persona ? 'selected' : '' }}>{{ __('Moral') }}</option>
                                                                    <option value="0" {{ !$cliente->tipo_persona ? 'selected' : '' }}>{{ __('Física') }}</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6 form-group">
                                                                <label for="razon_social">{{ __('Razon Social') }}</label>
                                                                <input type="text" name="razon_social" id="razon_social" class="form-control form-control-sm" value="{{ $cliente->razon_social }}" required>
                                                            </div>
                                                            <div class="col-md-6 form-group">
                                                                <label for="rfc">{{ __('RFC') }}</label>
                                                                <input type="text" name="rfc" id="rfc" class="form-control form-control-sm" value="{{ $cliente->rfc }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6 form-group">
                                                                <label for="regimen_fiscal">{{ __('Régimen Fiscal') }}</label>
                                                                <input type="text" name="regimen_fiscal" id="regimen_fiscal" class="form-control form-control-sm" value="{{ $cliente->regimen_fiscal }}" required>
                                                            </div>
                                                            <div class="col-md-6 form-group">
                                                                <label for="codigo_postal">{{ __('Código Postal') }}</label>
                                                                <input type="text" name="codigo_postal" id="codigo_postal" class="form-control form-control-sm" value="{{ $cliente->codigo_postal }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6 form-group">
                                                                <label for="direccion">{{ __('Dirección') }}</label>
                                                                <input type="text" name="direccion" id="direccion" class="form-control form-control-sm" value="{{ $cliente->direccion }}" required>
                                                            </div>
                                                            <div class="col-md-6 form-group">
                                                                <label for="estado">{{ __('Estado') }}</label>
                                                                <input type="text" name="estado" id="estado" class="form-control form-control-sm" value="{{ $cliente->estado }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6 form-group">
                                                                <label for="ciudad">{{ __('Ciudad') }}</label>
                                                                <input type="text" name="ciudad" id="ciudad" class="form-control form-control-sm" value="{{ $cliente->ciudad }}" required>
                                                            </div>
                                                            <div class="col-md-6 form-group">
                                                                <label for="correo">{{ __('Correo') }}</label>
                                                                <input type="email" name="correo" id="correo" class="form-control form-control-sm" value="{{ $cliente->correo }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6 form-group">
                                                                <label for="telefono">{{ __('Teléfono') }}</label>
                                                                <input type="text" name="telefono" id="telefono" class="form-control form-control-sm" value="{{ $cliente->telefono }}" required>
                                                            </div>
                                                            <div class="col-md-6 form-group">
                                                                <label for="representante">{{ __('Representante') }}</label>
                                                                <input type="text" name="representante" id="representante" class="form-control form-control-sm" value="{{ $cliente->representante }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6 form-group">
                                                                <label for="vendedor">{{ __('Vendedor') }}</label>
                                                                <input type="text" name="vendedor" id="vendedor" class="form-control form-control-sm" value="{{ $cliente->vendedor }}" required>
                                                            </div>
                                                            <div class="col-md-6 form-group">
                                                                <label for="banco">{{ __('Banco') }}</label>
                                                                <input type="text" name="banco" id="banco" class="form-control form-control-sm" value="{{ $cliente->banco }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6 form-group">
                                                                <label for="numero_cuenta">{{ __('Número de Cuenta') }}</label>
                                                                <input type="text" name="numero_cuenta" id="numero_cuenta" class="form-control form-control-sm" value="{{ $cliente->numero_cuenta }}" required>
                                                            </div>
                                                            <div class="col-md-6 form-group">
                                                                <label for="cuenta_interbancaria">{{ __('CLABE Interbancaria') }}</label>
                                                                <input type="text" name="cuenta_interbancaria" id="cuenta_interbancaria" class="form-control form-control-sm" value="{{ $cliente->cuenta_interbancaria }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6 form-group">
                                                                <label for="telefono_contacto">{{ __('Teléfono de Contacto') }}</label>
                                                                <input type="text" name="telefono_contacto" id="telefono_contacto" class="form-control form-control-sm" value="{{ $cliente->telefono_contacto }}" required>
                                                            </div>
                                                            <div class="col-md-6 form-group">
                                                                <label for="activo">{{ __('Activo') }}</label>
                                                                <select name="activo" id="activo" class="form-control form-control-sm">
                                                                    <option value="1" {{ $cliente->activo ? 'selected' : '' }}>{{ __('Sí') }}</option>
                                                                    <option value="0" {{ !$cliente->activo ? 'selected' : '' }}>{{ __('No') }}</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Cerrar') }}</button>
                                                        <button type="submit" class="btn btn-primary">{{ __('Actualizar') }}</button>
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
        </div>
    </div>
</div>

<!-- Modal Crear Cliente -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">{{ __('Crear Cliente') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('clientes.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <!-- Formulario de creación -->
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="clave">{{ __('Clave') }}</label>
                            <input type="text" name="clave" id="clave" class="form-control form-control-sm" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="tipo_persona">{{ __('Tipo Persona') }}</label>
                            <select name="tipo_persona" id="tipo_persona" class="form-control form-control-sm">
                                <option value="1">{{ __('Moral') }}</option>
                                <option value="0">{{ __('Física') }}</option>
                            </select>
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
                            <label for="regimen_fiscal">{{ __('Régimen Fiscal') }}</label>
                            <input type="text" name="regimen_fiscal" id="regimen_fiscal" class="form-control form-control-sm" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="codigo_postal">{{ __('Código Postal') }}</label>
                            <input type="text" name="codigo_postal" id="codigo_postal" class="form-control form-control-sm" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="direccion">{{ __('Dirección') }}</label>
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
                            <label for="telefono">{{ __('Teléfono') }}</label>
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
                            <label for="numero_cuenta">{{ __('Número de Cuenta') }}</label>
                            <input type="text" name="numero_cuenta" id="numero_cuenta" class="form-control form-control-sm" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="cuenta_interbancaria">{{ __('CLABE Interbancaria') }}</label>
                            <input type="text" name="cuenta_interbancaria" id="cuenta_interbancaria" class="form-control form-control-sm" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="telefono_contacto">{{ __('Teléfono de Contacto') }}</label>
                            <input type="text" name="telefono_contacto" id="telefono_contacto" class="form-control form-control-sm" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="activo">{{ __('Activo') }}</label>
                            <select name="activo" id="activo" class="form-control form-control-sm">
                                <option value="1">{{ __('Sí') }}</option>
                                <option value="0">{{ __('No') }}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Cerrar') }}</button>
                    <button type="submit" class="btn btn-primary">{{ __('Guardar') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
