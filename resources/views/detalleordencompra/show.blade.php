@extends('layouts.app')

@section('template_title')
    Detalle de la Orden de Compra
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Detalle de la Orden de Compra #{{ $ordencompra->id }}</h4>
                    </div>

                    <div class="card-body">
                        <h5>Clave de Orden: {{ $ordencompra->clave_orden }}</h5>
                        <p>Fecha: {{ $ordencompra->fecha }}</p>
                        <p>Proveedor: {{ $ordencompra->proveedor->nombre }}</p>

                        <h5>Productos:</h5>
                        <ul>
                            @foreach($ordencompra->productos as $producto)
                                <li>{{ $producto->nombre }} - Cantidad: {{ $producto->pivot->cantidad }}</li>
                            @endforeach
                        </ul>

                        <!-- Aquí puedes agregar más información relacionada con la orden -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
