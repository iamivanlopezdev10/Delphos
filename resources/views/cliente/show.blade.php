@extends('layouts.app')

@section('template_title')
    Mostrar Cliente
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card shadow-lg border-primary">
                <div class="card-header bg-primary text-white">
                    <h5>{{ __('Detalles del Cliente') }}</h5>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <strong>Clave: </strong> {{ $cliente->clave }}
                        </div>
                        <div class="col-md-6">
                            <strong>Tipo Persona: </strong> {{ $cliente->tipo_persona }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <strong>Razón Social: </strong> {{ $cliente->razon_social }}
                        </div>
                        <div class="col-md-6">
                            <strong>RFC: </strong> {{ $cliente->rfc }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <strong>Estado: </strong> {{ $cliente->estado }}
                        </div>
                        <div class="col-md-6">
                            <strong>Ciudad: </strong> {{ $cliente->ciudad }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <strong>Correo: </strong> {{ $cliente->correo }}
                        </div>
                        <div class="col-md-6">
                            <strong>Teléfono: </strong> {{ $cliente->telefono }}
                        </div>
                    </div>

                    <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Volver</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
