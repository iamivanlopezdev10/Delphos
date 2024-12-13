<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Cliente
 *
 * @property $id
 * @property $clave
 * @property $tipo_persona
 * @property $razon_social
 * @property $rfc
 * @property $regimen_fiscal
 * @property $codigo_postal
 * @property $direccion
 * @property $estado
 * @property $ciudad
 * @property $correo
 * @property $telefono
 * @property $representante
 * @property $vendedor
 * @property $banco
 * @property $numero_cuenta
 * @property $cuenta_interbancaria
 * @property $telefono_contacto
 * @property $activo
 * @property $created_at
 * @property $updated_at
 *
 * @property Venta[] $ventas
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Cliente extends Model
{
    

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['clave', 'tipo_persona', 'razon_social', 'rfc', 'regimen_fiscal', 'codigo_postal', 'direccion', 'estado', 'ciudad', 'correo', 'telefono', 'representante', 'vendedor', 'banco', 'numero_cuenta', 'cuenta_interbancaria', 'telefono_contacto', 'activo'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ventas()
    {
        return $this->hasMany(\App\Models\Venta::class, 'id', 'cliente_id');
    }
    

}
