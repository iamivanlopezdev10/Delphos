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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id(); // ID
            $table->string('clave', 255)->unique(); // Clave
            $table->boolean('tipo_persona'); // Tipo de persona
            $table->string('razon_social', 255); // Razón social
            $table->string('rfc', 13)->unique(); // RFC
            $table->string('regimen_fiscal', 255); // Régimen fiscal
            $table->string('codigo_postal', 5); // Código postal
            $table->string('direccion', 255); // Dirección
            $table->string('estado', 255); // Estado
            $table->string('ciudad', 255); // Ciudad
            $table->string('correo', 255); // Correo
            $table->string('telefono', 15); // Teléfono
            $table->string('representante', 255); // Representante
            $table->string('vendedor', 255); // Vendedor
            $table->string('banco', 255); // Banco
            $table->string('numero_cuenta', 20); // Número cuenta
            $table->string('cuenta_interbancaria', 20); // CLABE
            $table->string('telefono_contacto', 15); // Teléfono contacto
            $table->boolean('activo')->default(true); // Estado
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
