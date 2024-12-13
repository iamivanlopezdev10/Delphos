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
        Schema::create('detalleordencompras', function (Blueprint $table) {
            $table->id(); // ID del detalle
            $table->foreignId('orden_id')->constrained('ordencompras')->onDelete('cascade'); // Relación con ordenes
            $table->foreignId('producto_id')->constrained('productos')->onDelete('cascade'); // Relación con productos
            $table->integer('cantidad'); // Cantidad
            $table->integer('cantidad_recibida')->default(0); // Cantidad recibida
            $table->decimal('total', 10, 2); // Subtotal
            $table->boolean('recibido')->default(false); // Estado recibido
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalleordencompras');
    }
};
