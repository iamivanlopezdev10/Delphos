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

    public static function boot()
    {
        parent::boot();

        static::creating(function ($ordenCompra) {
            // Generamos la clave_orden antes de crear la orden
            $ultimo = self::latest('id')->first(); // Obtenemos la última orden creada
            $numeroOrden = $ultimo ? intval(substr($ultimo->clave_orden, 1)) + 1 : 1; // Si no hay orden, empezamos desde 1

            // Formateamos la clave con 6 dígitos
            $ordenCompra->clave_orden = str_pad($numeroOrden, 6, '0', STR_PAD_LEFT);
        });
    }
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

