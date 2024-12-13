<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProveedoreRequest extends FormRequest
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
			'clave_proveedor' => 'required|string',
			'nombre' => 'required|string',
			'rfc' => 'required|string',
			'codigo_postal' => 'required|string',
			'estado' => 'required|string',
			'correo_ordenes' => 'required|string',
			'correo_pagos' => 'required|string',
			'banco' => 'required|string',
			'numero_cuenta' => 'required|string',
			'cuenta_interbancaria' => 'required|string',
			'telefono' => 'required|string',
			'habilitado' => 'required',
        ];
    }
}
