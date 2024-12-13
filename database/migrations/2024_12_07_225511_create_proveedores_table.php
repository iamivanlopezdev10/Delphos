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
        Schema::create('proveedores', function (Blueprint $table) {
            $table->id(); // ID del proveedor
            $table->string('clave_proveedor', 20)->unique(); // Clave única del proveedor
            $table->string('nombre', 100); // Nombre del proveedor
            $table->string('rfc', 13)->unique(); // RFC único
            $table->string('codigo_postal', 5); // Código postal
            $table->string('estado', 50); // Estado
            $table->string('correo_ordenes', 100); // Correo para órdenes
            $table->string('correo_pagos', 100); // Correo para pagos
            $table->string('banco', 50); // Banco
            $table->string('numero_cuenta', 20); // Número de cuenta
            $table->string('cuenta_interbancaria', 20); // CLABE interbancaria
            $table->string('telefono', 15); // Teléfono
            $table->boolean('habilitado')->default(true); // Estado habilitado
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proveedores');
    }
};
