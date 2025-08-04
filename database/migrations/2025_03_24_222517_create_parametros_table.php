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
        Schema::create('parametros', function (Blueprint $table) {
            $table->id();
            $table->date('fecha')->comment('Fecha del registro de parámetros');
            $table->time('hora')->comment('Hora del registro de parámetros');
            $table->double('nota1')->nullable()->comment('Primera nota');
            $table->double('nota2')->nullable()->comment('Segunda nota');
            $table->double('nota3')->nullable()->comment('Tercera nota');
            $table->double('promedio_predicho')->nullable()->comment('Promedio predicho por el modelo');
        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parametros');
    }
};
