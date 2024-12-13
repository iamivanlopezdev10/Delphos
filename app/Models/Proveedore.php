<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Proveedore
 *
 * @property $id
 * @property $clave_proveedor
 * @property $nombre
 * @property $rfc
 * @property $codigo_postal
 * @property $estado
 * @property $correo_ordenes
 * @property $correo_pagos
 * @property $banco
 * @property $numero_cuenta
 * @property $cuenta_interbancaria
 * @property $telefono
 * @property $habilitado
 * @property $created_at
 * @property $updated_at
 *
 * @property Ordencompra[] $ordencompras
 * @property Producto[] $productos
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Proveedore extends Model
{
    

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['clave_proveedor', 'nombre', 'rfc', 'codigo_postal', 'estado', 'correo_ordenes', 'correo_pagos', 'banco', 'numero_cuenta', 'cuenta_interbancaria', 'telefono', 'habilitado'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ordencompras()
    {
        return $this->hasMany(\App\Models\Ordencompra::class, 'id', 'proveedor_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productos()
    {
        return $this->hasMany(\App\Models\Producto::class, 'id', 'proveedor_id');
    }
    

}
