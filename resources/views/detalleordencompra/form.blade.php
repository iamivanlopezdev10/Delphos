<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="orden_id" class="form-label">{{ __('Orden Id') }}</label>
            <input type="text" name="orden_id" class="form-control @error('orden_id') is-invalid @enderror" value="{{ old('orden_id', $detalleordencompra?->orden_id) }}" id="orden_id" placeholder="Orden Id">
            {!! $errors->first('orden_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="producto_id" class="form-label">{{ __('Producto Id') }}</label>
            <input type="text" name="producto_id" class="form-control @error('producto_id') is-invalid @enderror" value="{{ old('producto_id', $detalleordencompra?->producto_id) }}" id="producto_id" placeholder="Producto Id">
            {!! $errors->first('producto_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="cantidad" class="form-label">{{ __('Cantidad') }}</label>
            <input type="text" name="cantidad" class="form-control @error('cantidad') is-invalid @enderror" value="{{ old('cantidad', $detalleordencompra?->cantidad) }}" id="cantidad" placeholder="Cantidad">
            {!! $errors->first('cantidad', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="cantidad_recibida" class="form-label">{{ __('Cantidad Recibida') }}</label>
            <input type="text" name="cantidad_recibida" class="form-control @error('cantidad_recibida') is-invalid @enderror" value="{{ old('cantidad_recibida', $detalleordencompra?->cantidad_recibida) }}" id="cantidad_recibida" placeholder="Cantidad Recibida">
            {!! $errors->first('cantidad_recibida', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="total" class="form-label">{{ __('Total') }}</label>
            <input type="text" name="total" class="form-control @error('total') is-invalid @enderror" value="{{ old('total', $detalleordencompra?->total) }}" id="total" placeholder="Total">
            {!! $errors->first('total', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="recibido" class="form-label">{{ __('Recibido') }}</label>
            <input type="text" name="recibido" class="form-control @error('recibido') is-invalid @enderror" value="{{ old('recibido', $detalleordencompra?->recibido) }}" id="recibido" placeholder="Recibido">
            {!! $errors->first('recibido', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>