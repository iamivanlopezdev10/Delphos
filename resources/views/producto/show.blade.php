@extends('layouts.app')

@section('template_title')
    {{ $producto->name ?? __('Mostrar') . " " . __('Producto') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Mostrar') }} Producto</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('productos.index') }}"> {{ __('Volver') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                        <div class="form-group mb-2 mb20">
                            <strong>Clave Producto:</strong>
                            {{ $producto->clave_producto }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Descripción:</strong>
                            {{ $producto->descripcion }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Procedencia:</strong>
                            {{ $producto->procedencia }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Tipo:</strong>
                            {{ $producto->tipo }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Clasificación:</strong>
                            {{ $producto->clasificacion }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Stock:</strong>
                            {{ $producto->stock }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Precio Unitario:</strong>
                            {{ $producto->precio_unitario }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Habilitado:</strong>
                            {{ $producto->habilitado }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Proveedor Id:</strong>
                            {{ $producto->proveedor_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
