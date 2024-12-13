@extends('layouts.app')

@section('template_title')
    {{ __('Actualizar Producto') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Actualizar Producto') }}</span>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('productos.update', $producto->id) }}" role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            <!-- Incluir el formulario de campos -->
                            <div class="form-group">
                                <label for="clave_producto">{{ __('Clave Producto') }}</label>
                                <input type="text" name="clave_producto" value="{{ old('clave_producto', $producto->clave_producto) }}" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="descripcion">{{ __('Descripción') }}</label>
                                <input type="text" name="descripcion" value="{{ old('descripcion', $producto->descripcion) }}" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="procedencia">{{ __('Procedencia') }}</label>
                                <input type="text" name="procedencia" value="{{ old('procedencia', $producto->procedencia) }}" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="tipo">{{ __('Tipo') }}</label>
                                <input type="text" name="tipo" value="{{ old('tipo', $producto->tipo) }}" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="clasificacion">{{ __('Clasificación') }}</label>
                                <input type="text" name="clasificacion" value="{{ old('clasificacion', $producto->clasificacion) }}" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="stock">{{ __('Stock') }}</label>
                                <input type="number" name="stock" value="{{ old('stock', $producto->stock) }}" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="precio_unitario">{{ __('Precio Unitario') }}</label>
                                <input type="number" name="precio_unitario" value="{{ old('precio_unitario', $producto->precio_unitario) }}" class="form-control" step="0.01" required>
                            </div>

                            <div class="form-group">
                                <label for="habilitado">{{ __('Habilitado') }}</label>
                                <input type="checkbox" name="habilitado" value="1" {{ $producto->habilitado ? 'checked' : '' }}>
                            </div>

                            <div class="form-group">
                                <label for="proveedor_id">{{ __('Proveedor') }}</label>
                                <select name="proveedor_id" class="form-control" required>
                                    @foreach($proveedores as $proveedor)
                                        <option value="{{ $proveedor->id }}" {{ $proveedor->id == $producto->proveedor_id ? 'selected' : '' }}>
                                            {{ $proveedor->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-success">{{ __('Actualizar Producto') }}</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
