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
        Schema::create('articulos', function (Blueprint $table) {
            $table->id();
            $table->integer('id_categoria');
            $table->string('nombre_categoria');
            $table->integer('id_ubicacion');
            $table->string('nombre_ubicacion');
            $table->integer('id_encargado');
            $table->string('nombre_encargado');
            $table->string('numero_de_serie')->nullable();
            $table->string('codigoqr')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articulos');
    }
};
