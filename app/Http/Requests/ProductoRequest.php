<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductoRequest extends FormRequest
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
			'clave_producto' => 'required|string',
			'descripcion' => 'required|string',
			'procedencia' => 'required|string',
			'tipo' => 'required|string',
			'clasificacion' => 'required|string',
			'stock' => 'required',
			'precio_unitario' => 'required',
			'habilitado' => 'required',
			'proveedor_id' => 'required',
        ];
    }
}
