<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Detalleordencompra
 *
 * @property $id
 * @property $orden_id
 * @property $producto_id
 * @property $cantidad
 * @property $cantidad_recibida
 * @property $total
 * @property $recibido
 * @property $created_at
 * @property $updated_at
 *
 * @property Ordencompra $ordencompra
 * @property Producto $producto
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
// En el modelo Detalleordencompra


class Detalleordencompra extends Model
{
    protected $perPage = 20;

    protected $fillable = ['orden_id', 'producto_id', 'cantidad', 'cantidad_recibida', 'total', 'recibido'];

    /**
     * Relación pertenece a Ordencompra.
     */
    public function ordencompra()
    {
        return $this->belongsTo(Ordencompra::class, 'orden_id');
    }

    /**
     * Relación pertenece a Producto.
     */
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }

    /**
     * Relación con el proveedor a través de Ordencompra.
     */
    public function proveedore()
    {
        // Relación con Proveedore a través de la Ordencompra
        return $this->hasOneThrough(Proveedore::class, Ordencompra::class, 'id', 'id', 'orden_id', 'proveedor_id');
    }
}


