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
        Schema::create('ordencompras', function (Blueprint $table) {
            $table->id(); // ID de la orden
            $table->string('clave_orden', 20)->unique(); // Clave única, se generará con el formato de 6 dígitos
            $table->date('fecha'); // Fecha
            $table->enum('estado', ['pendiente', 'completa', 'cancelada', 'finalizado'])->default('pendiente');
            $table->foreignId('proveedor_id')->constrained('proveedores')->onDelete('cascade'); // Relación con proveedores
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ordencompras');
    }
};
