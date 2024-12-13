<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="clave" class="form-label">{{ __('Clave') }}</label>
            <input type="text" name="clave" class="form-control @error('clave') is-invalid @enderror" value="{{ old('clave', $cliente?->clave) }}" id="clave" placeholder="Clave">
            {!! $errors->first('clave', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="tipo_persona" class="form-label">{{ __('Tipo Persona') }}</label>
            <input type="text" name="tipo_persona" class="form-control @error('tipo_persona') is-invalid @enderror" value="{{ old('tipo_persona', $cliente?->tipo_persona) }}" id="tipo_persona" placeholder="Tipo Persona">
            {!! $errors->first('tipo_persona', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="razon_social" class="form-label">{{ __('Razon Social') }}</label>
            <input type="text" name="razon_social" class="form-control @error('razon_social') is-invalid @enderror" value="{{ old('razon_social', $cliente?->razon_social) }}" id="razon_social" placeholder="Razon Social">
            {!! $errors->first('razon_social', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="rfc" class="form-label">{{ __('Rfc') }}</label>
            <input type="text" name="rfc" class="form-control @error('rfc') is-invalid @enderror" value="{{ old('rfc', $cliente?->rfc) }}" id="rfc" placeholder="Rfc">
            {!! $errors->first('rfc', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="regimen_fiscal" class="form-label">{{ __('Regimen Fiscal') }}</label>
            <input type="text" name="regimen_fiscal" class="form-control @error('regimen_fiscal') is-invalid @enderror" value="{{ old('regimen_fiscal', $cliente?->regimen_fiscal) }}" id="regimen_fiscal" placeholder="Regimen Fiscal">
            {!! $errors->first('regimen_fiscal', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="codigo_postal" class="form-label">{{ __('Codigo Postal') }}</label>
            <input type="text" name="codigo_postal" class="form-control @error('codigo_postal') is-invalid @enderror" value="{{ old('codigo_postal', $cliente?->codigo_postal) }}" id="codigo_postal" placeholder="Codigo Postal">
            {!! $errors->first('codigo_postal', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="direccion" class="form-label">{{ __('Direccion') }}</label>
            <input type="text" name="direccion" class="form-control @error('direccion') is-invalid @enderror" value="{{ old('direccion', $cliente?->direccion) }}" id="direccion" placeholder="Direccion">
            {!! $errors->first('direccion', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="estado" class="form-label">{{ __('Estado') }}</label>
            <input type="text" name="estado" class="form-control @error('estado') is-invalid @enderror" value="{{ old('estado', $cliente?->estado) }}" id="estado" placeholder="Estado">
            {!! $errors->first('estado', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="ciudad" class="form-label">{{ __('Ciudad') }}</label>
            <input type="text" name="ciudad" class="form-control @error('ciudad') is-invalid @enderror" value="{{ old('ciudad', $cliente?->ciudad) }}" id="ciudad" placeholder="Ciudad">
            {!! $errors->first('ciudad', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="correo" class="form-label">{{ __('Correo') }}</label>
            <input type="text" name="correo" class="form-control @error('correo') is-invalid @enderror" value="{{ old('correo', $cliente?->correo) }}" id="correo" placeholder="Correo">
            {!! $errors->first('correo', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="telefono" class="form-label">{{ __('Telefono') }}</label>
            <input type="text" name="telefono" class="form-control @error('telefono') is-invalid @enderror" value="{{ old('telefono', $cliente?->telefono) }}" id="telefono" placeholder="Telefono">
            {!! $errors->first('telefono', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="representante" class="form-label">{{ __('Representante') }}</label>
            <input type="text" name="representante" class="form-control @error('representante') is-invalid @enderror" value="{{ old('representante', $cliente?->representante) }}" id="representante" placeholder="Representante">
            {!! $errors->first('representante', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="vendedor" class="form-label">{{ __('Vendedor') }}</label>
            <input type="text" name="vendedor" class="form-control @error('vendedor') is-invalid @enderror" value="{{ old('vendedor', $cliente?->vendedor) }}" id="vendedor" placeholder="Vendedor">
            {!! $errors->first('vendedor', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="banco" class="form-label">{{ __('Banco') }}</label>
            <input type="text" name="banco" class="form-control @error('banco') is-invalid @enderror" value="{{ old('banco', $cliente?->banco) }}" id="banco" placeholder="Banco">
            {!! $errors->first('banco', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="numero_cuenta" class="form-label">{{ __('Numero Cuenta') }}</label>
            <input type="text" name="numero_cuenta" class="form-control @error('numero_cuenta') is-invalid @enderror" value="{{ old('numero_cuenta', $cliente?->numero_cuenta) }}" id="numero_cuenta" placeholder="Numero Cuenta">
            {!! $errors->first('numero_cuenta', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="cuenta_interbancaria" class="form-label">{{ __('Cuenta Interbancaria') }}</label>
            <input type="text" name="cuenta_interbancaria" class="form-control @error('cuenta_interbancaria') is-invalid @enderror" value="{{ old('cuenta_interbancaria', $cliente?->cuenta_interbancaria) }}" id="cuenta_interbancaria" placeholder="Cuenta Interbancaria">
            {!! $errors->first('cuenta_interbancaria', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="telefono_contacto" class="form-label">{{ __('Telefono Contacto') }}</label>
            <input type="text" name="telefono_contacto" class="form-control @error('telefono_contacto') is-invalid @enderror" value="{{ old('telefono_contacto', $cliente?->telefono_contacto) }}" id="telefono_contacto" placeholder="Telefono Contacto">
            {!! $errors->first('telefono_contacto', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="activo" class="form-label">{{ __('Activo') }}</label>
            <input type="text" name="activo" class="form-control @error('activo') is-invalid @enderror" value="{{ old('activo', $cliente?->activo) }}" id="activo" placeholder="Activo">
            {!! $errors->first('activo', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>