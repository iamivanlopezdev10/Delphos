<!-- Modal Show -->
<div class="modal fade" id="showModal{{ $cliente->id }}" tabindex="-1" role="dialog" aria-labelledby="showModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showModalLabel">{{ __('Client Details') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="clave">{{ __('Clave') }}</label>
                    <input type="text" value="{{ $cliente->clave }}" class="form-control form-control-sm" readonly>
                </div>
                <div class="form-group">
                    <label for="tipo_persona">{{ __('Tipo Persona') }}</label>
                    <input type="text" value="{{ $cliente->tipo_persona }}" class="form-control form-control-sm" readonly>
                </div>
                <div class="form-group">
                    <label for="razon_social">{{ __('Razon Social') }}</label>
                    <input type="text" value="{{ $cliente->razon_social }}" class="form-control form-control-sm" readonly>
                </div>
                <div class="form-group">
                    <label for="rfc">{{ __('RFC') }}</label>
                    <input type="text" value="{{ $cliente->rfc }}" class="form-control form-control-sm" readonly>
                </div>
                <div class="form-group">
                    <label for="regimen_fiscal">{{ __('Regimen Fiscal') }}</label>
                    <input type="text" value="{{ $cliente->regimen_fiscal }}" class="form-control form-control-sm" readonly>
                </div>
                <div class="form-group">
                    <label for="codigo_postal">{{ __('Codigo Postal') }}</label>
                    <input type="text" value="{{ $cliente->codigo_postal }}" class="form-control form-control-sm" readonly>
                </div>
                <div class="form-group">
                    <label for="direccion">{{ __('Direccion') }}</label>
                    <input type="text" value="{{ $cliente->direccion }}" class="form-control form-control-sm" readonly>
                </div>
                <div class="form-group">
                    <label for="estado">{{ __('Estado') }}</label>
                    <input type="text" value="{{ $cliente->estado }}" class="form-control form-control-sm" readonly>
                </div>
                <div class="form-group">
                    <label for="ciudad">{{ __('Ciudad') }}</label>
                    <input type="text" value="{{ $cliente->ciudad }}" class="form-control form-control-sm" readonly>
                </div>
                <div class="form-group">
                    <label for="correo">{{ __('Correo') }}</label>
                    <input type="email" value="{{ $cliente->correo }}" class="form-control form-control-sm" readonly>
                </div>
                <div class="form-group">
                    <label for="telefono">{{ __('Telefono') }}</label>
                    <input type="text" value="{{ $cliente->telefono }}" class="form-control form-control-sm" readonly>
                </div>
                <div class="form-group">
                    <label for="representante">{{ __('Representante') }}</label>
                    <input type="text" value="{{ $cliente->representante }}" class="form-control form-control-sm" readonly>
                </div>
                <div class="form-group">
                    <label for="vendedor">{{ __('Vendedor') }}</label>
                    <input type="text" value="{{ $cliente->vendedor }}" class="form-control form-control-sm" readonly>
                </div>
                <div class="form-group">
                    <label for="banco">{{ __('Banco') }}</label>
                    <input type="text" value="{{ $cliente->banco }}" class="form-control form-control-sm" readonly>
                </div>
                <div class="form-group">
                    <label for="numero_cuenta">{{ __('Numero Cuenta') }}</label>
                    <input type="text" value="{{ $cliente->numero_cuenta }}" class="form-control form-control-sm" readonly>
                </div>
                <div class="form-group">
                    <label for="cuenta_interbancaria">{{ __('Cuenta Interbancaria') }}</label>
                    <input type="text" value="{{ $cliente->cuenta_interbancaria }}" class="form-control form-control-sm" readonly>
                </div>
                <div class="form-group">
                    <label for="telefono_contacto">{{ __('Telefono Contacto') }}</label>
                    <input type="text" value="{{ $cliente->telefono_contacto }}" class="form-control form-control-sm" readonly>
                </div>
                <div class="form-group">
                    <label for="activo">{{ __('Activo') }}</label>
                    <input type="text" value="{{ $cliente->activo ? 'Yes' : 'No' }}" class="form-control form-control-sm" readonly>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
            </div>
        </div>
    </div>
</div>
