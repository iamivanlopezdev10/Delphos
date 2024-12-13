@extends('layouts.app')

@section('template_title')
    {{ $detalleventa->name ?? __('Show') . " " . __('Detalleventa') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Detalleventa</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('detalleventas.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                        <div class="form-group mb-2 mb20">
                            <strong>Venta Id:</strong>
                            {{ $detalleventa->venta_id }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Producto Id:</strong>
                            {{ $detalleventa->producto_id }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Cantidad:</strong>
                            {{ $detalleventa->cantidad }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Precio Unitario:</strong>
                            {{ $detalleventa->precio_unitario }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Subtotal:</strong>
                            {{ $detalleventa->subtotal }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Iva:</strong>
                            {{ $detalleventa->iva }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
