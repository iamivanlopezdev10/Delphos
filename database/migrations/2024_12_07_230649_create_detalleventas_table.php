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
        Schema::create('detalleventas', function (Blueprint $table) {
            $table->id(); // ID
            $table->foreignId('venta_id')->constrained('ventas')->onDelete('cascade'); // Relación con ventas
            $table->foreignId('producto_id')->constrained('productos')->onDelete('cascade'); // Relación con productos
            $table->integer('cantidad'); // Cantidad
            $table->decimal('precio_unitario', 10, 2); // Precio unitario
            $table->decimal('subtotal', 10, 2); // Subtotal
            $table->decimal('iva', 10, 2); // IVA
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalleventas');
    }
};
