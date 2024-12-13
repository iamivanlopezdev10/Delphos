<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
			'clave' => 'required|string',
			'tipo_persona' => 'required',
			'razon_social' => 'required|string',
			'rfc' => 'required|string',
			'regimen_fiscal' => 'required|string',
			'codigo_postal' => 'required|string',
			'direccion' => 'required|string',
			'estado' => 'required|string',
			'ciudad' => 'required|string',
			'correo' => 'required|string',
			'telefono' => 'required|string',
			'representante' => 'required|string',
			'vendedor' => 'required|string',
			'banco' => 'required|string',
			'numero_cuenta' => 'required|string',
			'cuenta_interbancaria' => 'required|string',
			'telefono_contacto' => 'required|string',
			'activo' => 'required',
        ];
    }
}
