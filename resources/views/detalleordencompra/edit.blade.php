@extends('layouts.app')

@section('template_title')
    Editar Detalle de Orden
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h3>{{ __('Editar Detalle de Orden de Compra') }}</h3>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('detalleordencompras.update', $detalleOrdenCompra->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="cantidad_recibida">Cantidad Recibida</label>
                                <input type="number" class="form-control" id="cantidad_recibida" name="cantidad_recibida" value="{{ $detalleOrdenCompra->cantidad_recibida }}" required>
                            </div>

                            <div class="form-group">
                                <label for="recibido">Recibido</label>
                                <select name="recibido" id="recibido" class="form-control" required>
                                    <option value="1" {{ $detalleOrdenCompra->recibido ? 'selected' : '' }}>Sí</option>
                                    <option value="0" {{ !$detalleOrdenCompra->recibido ? 'selected' : '' }}>No</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Actualizar Detalle</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
