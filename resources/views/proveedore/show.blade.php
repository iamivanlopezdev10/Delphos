@extends('layouts.app')

@section('template_title')
    {{ $proveedore->name ?? __('Show') . " " . __('Proveedore') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Proveedore</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('proveedores.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                        <div class="form-group mb-2 mb20">
                            <strong>Clave Proveedor:</strong>
                            {{ $proveedore->clave_proveedor }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Nombre:</strong>
                            {{ $proveedore->nombre }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Rfc:</strong>
                            {{ $proveedore->rfc }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Codigo Postal:</strong>
                            {{ $proveedore->codigo_postal }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Estado:</strong>
                            {{ $proveedore->estado }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Correo Ordenes:</strong>
                            {{ $proveedore->correo_ordenes }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Correo Pagos:</strong>
                            {{ $proveedore->correo_pagos }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Banco:</strong>
                            {{ $proveedore->banco }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Numero Cuenta:</strong>
                            {{ $proveedore->numero_cuenta }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Cuenta Interbancaria:</strong>
                            {{ $proveedore->cuenta_interbancaria }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Telefono:</strong>
                            {{ $proveedore->telefono }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Habilitado:</strong>
                            {{ $proveedore->habilitado }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
