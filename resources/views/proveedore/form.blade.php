<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="clave_proveedor" class="form-label">{{ __('Clave Proveedor') }}</label>
            <input type="text" name="clave_proveedor" class="form-control @error('clave_proveedor') is-invalid @enderror" value="{{ old('clave_proveedor', $proveedore?->clave_proveedor) }}" id="clave_proveedor" placeholder="Clave Proveedor">
            {!! $errors->first('clave_proveedor', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="nombre" class="form-label">{{ __('Nombre') }}</label>
            <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre', $proveedore?->nombre) }}" id="nombre" placeholder="Nombre">
            {!! $errors->first('nombre', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="rfc" class="form-label">{{ __('Rfc') }}</label>
            <input type="text" name="rfc" class="form-control @error('rfc') is-invalid @enderror" value="{{ old('rfc', $proveedore?->rfc) }}" id="rfc" placeholder="Rfc">
            {!! $errors->first('rfc', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="codigo_postal" class="form-label">{{ __('Codigo Postal') }}</label>
            <input type="text" name="codigo_postal" class="form-control @error('codigo_postal') is-invalid @enderror" value="{{ old('codigo_postal', $proveedore?->codigo_postal) }}" id="codigo_postal" placeholder="Codigo Postal">
            {!! $errors->first('codigo_postal', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="estado" class="form-label">{{ __('Estado') }}</label>
            <input type="text" name="estado" class="form-control @error('estado') is-invalid @enderror" value="{{ old('estado', $proveedore?->estado) }}" id="estado" placeholder="Estado">
            {!! $errors->first('estado', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="correo_ordenes" class="form-label">{{ __('Correo Ordenes') }}</label>
            <input type="text" name="correo_ordenes" class="form-control @error('correo_ordenes') is-invalid @enderror" value="{{ old('correo_ordenes', $proveedore?->correo_ordenes) }}" id="correo_ordenes" placeholder="Correo Ordenes">
            {!! $errors->first('correo_ordenes', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="correo_pagos" class="form-label">{{ __('Correo Pagos') }}</label>
            <input type="text" name="correo_pagos" class="form-control @error('correo_pagos') is-invalid @enderror" value="{{ old('correo_pagos', $proveedore?->correo_pagos) }}" id="correo_pagos" placeholder="Correo Pagos">
            {!! $errors->first('correo_pagos', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="banco" class="form-label">{{ __('Banco') }}</label>
            <input type="text" name="banco" class="form-control @error('banco') is-invalid @enderror" value="{{ old('banco', $proveedore?->banco) }}" id="banco" placeholder="Banco">
            {!! $errors->first('banco', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="numero_cuenta" class="form-label">{{ __('Numero Cuenta') }}</label>
            <input type="text" name="numero_cuenta" class="form-control @error('numero_cuenta') is-invalid @enderror" value="{{ old('numero_cuenta', $proveedore?->numero_cuenta) }}" id="numero_cuenta" placeholder="Numero Cuenta">
            {!! $errors->first('numero_cuenta', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="cuenta_interbancaria" class="form-label">{{ __('Cuenta Interbancaria') }}</label>
            <input type="text" name="cuenta_interbancaria" class="form-control @error('cuenta_interbancaria') is-invalid @enderror" value="{{ old('cuenta_interbancaria', $proveedore?->cuenta_interbancaria) }}" id="cuenta_interbancaria" placeholder="Cuenta Interbancaria">
            {!! $errors->first('cuenta_interbancaria', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="telefono" class="form-label">{{ __('Telefono') }}</label>
            <input type="text" name="telefono" class="form-control @error('telefono') is-invalid @enderror" value="{{ old('telefono', $proveedore?->telefono) }}" id="telefono" placeholder="Telefono">
            {!! $errors->first('telefono', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="habilitado" class="form-label">{{ __('Habilitado') }}</label>
            <input type="text" name="habilitado" class="form-control @error('habilitado') is-invalid @enderror" value="{{ old('habilitado', $proveedore?->habilitado) }}" id="habilitado" placeholder="Habilitado">
            {!! $errors->first('habilitado', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>