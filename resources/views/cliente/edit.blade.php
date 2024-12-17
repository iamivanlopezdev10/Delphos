@extends('layouts.app')

@section('template_title')
    Editar Cliente
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card shadow-lg border-primary">
                <div class="card-header bg-primary text-white">
                    <h5>{{ __('Editar Cliente') }}</h5>
                </div>

                <div class="card-body">
                    <form action="{{ route('clientes.update', $cliente->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="clave">{{ __('Clave') }}</label>
                                <input type="text" name="clave" id="clave" class="form-control form-control-sm" value="{{ $cliente->clave }}" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="tipo_persona">{{ __('Tipo Persona') }}</label>
                                <input type="text" name="tipo_persona" id="tipo_persona" class="form-control form-control-sm" value="{{ $cliente->tipo_persona }}" required>
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
                                <label for="estado">{{ __('Estado') }}</label>
                                <input type="text" name="estado" id="estado" class="form-control form-control-sm" value="{{ $cliente->estado }}" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="ciudad">{{ __('Ciudad') }}</label>
                                <input type="text" name="ciudad" id="ciudad" class="form-control form-control-sm" value="{{ $cliente->ciudad }}" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="correo">{{ __('Correo') }}</label>
                            <input type="email" name="correo" id="correo" class="form-control form-control-sm" value="{{ $cliente->correo }}" required>
                        </div>
                        <div class="form-group">
                            <label for="telefono">{{ __('Telefono') }}</label>
                            <input type="text" name="telefono" id="telefono" class="form-control form-control-sm" value="{{ $cliente->telefono }}" required>
                        </div>

                        <div class="form-group">
                            <label for="activo">{{ __('Activo') }}</label>
                            <select name="activo" id="activo" class="form-control form-control-sm">
                                <option value="1" {{ $cliente->activo ? 'selected' : '' }}>{{ __('Sí') }}</option>
                                <option value="0" {{ !$cliente->activo ? 'selected' : '' }}>{{ __('No') }}</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">{{ __('Actualizar Cliente') }}</button>
                            <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
