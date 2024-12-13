<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Ordencompra
 *
 * @property $id
 * @property $clave_orden
 * @property $fecha
 * @property $estado
 * @property $proveedor_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Proveedore $proveedore
 * @property Detalleordencompra[] $detalleordencompras
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Ordencompra extends Model
{
    protected $perPage = 20;

    protected $fillable = ['clave_orden', 'fecha', 'estado', 'proveedor_id'];

    /**
     * Relación uno a muchos con Detalleordencompra.
     */
    public function detalleordencompras()
    {
        return $this->hasMany(Detalleordencompra::class, 'orden_id');
    }

    /**
     * Relación pertenece a Proveedore.
     */
    public function proveedore()
    {
        return $this->belongsTo(Proveedore::class, 'proveedor_id');
    }
}

