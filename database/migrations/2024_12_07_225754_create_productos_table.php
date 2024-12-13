<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id(); // ID del producto
            $table->string('clave_producto', 20)->unique(); // Clave única
            $table->string('descripcion', 255); // Descripción
            $table->string('procedencia', 50); // Procedencia
            $table->string('tipo', 50); // Tipo
            $table->string('clasificacion', 50); // Clasificación
            $table->integer('stock')->default(0); // Stock
            $table->decimal('precio_unitario', 10, 2); // Precio
            $table->boolean('habilitado')->default(true); // Estado
            $table->foreignId('proveedor_id')->constrained('proveedores')->onDelete('cascade'); // Relación con proveedores
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
