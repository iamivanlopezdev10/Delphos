<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Producto
 *
 * @property $id
 * @property $clave_producto
 * @property $descripcion
 * @property $procedencia
 * @property $tipo
 * @property $clasificacion
 * @property $stock
 * @property $precio_unitario
 * @property $habilitado
 * @property $proveedor_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Proveedore $proveedore
 * @property Detalleordencompra[] $detalleordencompras
 * @property Detalleventa[] $detalleventas
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Producto extends Model
{
    

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['clave_producto', 'descripcion', 'procedencia', 'tipo', 'clasificacion', 'stock', 'precio_unitario', 'habilitado', 'proveedor_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function proveedore()
    {
        return $this->belongsTo(\App\Models\Proveedore::class, 'proveedor_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detalleordencompras()
    {
        return $this->hasMany(\App\Models\Detalleordencompra::class, 'id', 'producto_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
 
    public function detalleventas()
    {
        return $this->hasMany(\App\Models\Detalleventa::class, 'producto_id', 'id');
    }

}
