<!-- Modal Edit -->
<div class="modal fade" id="editModal{{ $cliente->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">{{ __('Edit Cliente') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('clientes.update', $cliente->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="clave">{{ __('Clave') }}</label>
                        <input type="text" name="clave" id="clave" class="form-control form-control-sm" value="{{ $cliente->clave }}" required>
                    </div>
                    <div class="form-group">
                        <label for="tipo_persona">{{ __('Tipo Persona') }}</label>
                        <input type="text" name="tipo_persona" id="tipo_persona" class="form-control form-control-sm" value="{{ $cliente->tipo_persona }}" required>
                    </div>
                    <div class="form-group">
                        <label for="razon_social">{{ __('Razon Social') }}</label>
                        <input type="text" name="razon_social" id="razon_social" class="form-control form-control-sm" value="{{ $cliente->razon_social }}" required>
                    </div>
                    <div class="form-group">
                        <label for="rfc">{{ __('RFC') }}</label>
                        <input type="text" name="rfc" id="rfc" class="form-control form-control-sm" value="{{ $cliente->rfc }}" required>
                    </div>
                    <div class="form-group">
                        <label for="regimen_fiscal">{{ __('Regimen Fiscal') }}</label>
                        <input type="text" name="regimen_fiscal" id="regimen_fiscal" class="form-control form-control-sm" value="{{ $cliente->regimen_fiscal }}" required>
                    </div>
                    <div class="form-group">
                        <label for="codigo_postal">{{ __('Codigo Postal') }}</label>
                        <input type="text" name="codigo_postal" id="codigo_postal" class="form-control form-control-sm" value="{{ $cliente->codigo_postal }}" required>
                    </div>
                    <div class="form-group">
                        <label for="direccion">{{ __('Direccion') }}</label>
                        <input type="text" name="direccion" id="direccion" class="form-control form-control-sm" value="{{ $cliente->direccion }}" required>
                    </div>
                    <div class="form-group">
                        <label for="estado">{{ __('Estado') }}</label>
                        <input type="text" name="estado" id="estado" class="form-control form-control-sm" value="{{ $cliente->estado }}" required>
                    </div>
                    <div class="form-group">
                        <label for="ciudad">{{ __('Ciudad') }}</label>
                        <input type="text" name="ciudad" id="ciudad" class="form-control form-control-sm" value="{{ $cliente->ciudad }}" required>
                    </div>
                    <div class="form-group">
                        <label for="correo">{{ __('Correo') }}</label>
                        <input type="email" name="correo" id="correo" class="form-control form-control-sm" value="{{ $cliente->correo }}" required>
                    </div>
                    <div class="form-group">
                        <label for="telefono">{{ __('Telefono') }}</label>
                        <input type="text" name="telefono" id="telefono" class="form-control form-control-sm" value="{{ $cliente->telefono }}" required>
                    </div>
                    <div class="form-group">
                        <label for="representante">{{ __('Representante') }}</label>
                        <input type="text" name="representante" id="representante" class="form-control form-control-sm" value="{{ $cliente->representante }}" required>
                    </div>
                    <div class="form-group">
                        <label for="vendedor">{{ __('Vendedor') }}</label>
                        <input type="text" name="vendedor" id="vendedor" class="form-control form-control-sm" value="{{ $cliente->vendedor }}" required>
                    </div>
                    <div class="form-group">
                        <label for="banco">{{ __('Banco') }}</label>
                        <input type="text" name="banco" id="banco" class="form-control form-control-sm" value="{{ $cliente->banco }}" required>
                    </div>
                    <div class="form-group">
                        <label for="numero_cuenta">{{ __('Numero Cuenta') }}</label>
                        <input type="text" name="numero_cuenta" id="numero_cuenta" class="form-control form-control-sm" value="{{ $cliente->numero_cuenta }}" required>
                    </div>
                    <div class="form-group">
                        <label for="cuenta_interbancaria">{{ __('Cuenta Interbancaria') }}</label>
                        <input type="text" name="cuenta_interbancaria" id="cuenta_interbancaria" class="form-control form-control-sm" value="{{ $cliente->cuenta_interbancaria }}" required>
                    </div>
                    <div class="form-group">
                        <label for="telefono_contacto">{{ __('Telefono Contacto') }}</label>
                        <input type="text" name="telefono_contacto" id="telefono_contacto" class="form-control form-control-sm" value="{{ $cliente->telefono_contacto }}" required>
                    </div>
                    <div class="form-group">
                        <label for="activo">{{ __('Activo') }}</label>
                        <select name="activo" id="activo" class="form-control form-control-sm">
                            <option value="1" {{ $cliente->activo ? 'selected' : '' }}>{{ __('Yes') }}</option>
                            <option value="0" {{ !$cliente->activo ? 'selected' : '' }}>{{ __('No') }}</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                    <button type="submit" class="btn btn-primary">{{ __('Save changes') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
