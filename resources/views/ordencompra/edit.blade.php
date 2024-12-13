@extends('layouts.app')

@section('template_title')
    Editar Orden de Compra
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>{{ __('Editar Orden de Compra') }}</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('ordencompras.update', $ordencompra->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="clave_orden">Clave de Orden</label>
                                <input type="text" name="clave_orden" class="form-control" value="{{ old('clave_orden', $ordencompra->clave_orden) }}" required>
                            </div>

                            <div class="form-group">
                                <label for="fecha">Fecha</label>
                                <input type="date" name="fecha" class="form-control" value="{{ old('fecha', $ordencompra->fecha) }}" required>
                            </div>

                            <div class="form-group">
                                <label for="proveedor_id">Proveedor</label>
                                <select name="proveedor_id" class="form-control" required>
                                    @foreach($proveedores as $proveedor)
                                        <option value="{{ $proveedor->id }}" {{ $proveedor->id == $ordencompra->proveedor_id ? 'selected' : '' }}>
                                            {{ $proveedor->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="productos">Productos</label>

                                @if($ordencompra->productos && $ordencompra->productos->count() > 0)
                                    @foreach($ordencompra->productos as $index => $producto)
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <select name="productos[{{ $index }}][producto_id]" class="form-control">
                                                    @foreach($productos as $prod)
                                                        <option value="{{ $prod->id }}" {{ $prod->id == $producto->id ? 'selected' : '' }}>
                                                            {{ $prod->nombre }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="number" name="productos[{{ $index }}][cantidad]" class="form-control" value="{{ $producto->pivot->cantidad }}" required min="1">
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <p>No hay productos asociados a esta orden de compra.</p>
                                @endif
                            </div>

                            <button type="submit" class="btn btn-success">Actualizar Orden</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
