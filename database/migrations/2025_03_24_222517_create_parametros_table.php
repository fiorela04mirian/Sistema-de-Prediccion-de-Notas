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
            $table->double('ce')->nullable()->comment('Conductividad Eléctrica en dS/m');
            $table->double('ph')->nullable()->comment('pH de la Solución Nutritiva');
            $table->double('temp_ambiente')->nullable()->comment('Temperatura Ambiental en °C');
            $table->double('temp_solucion')->nullable()->comment('Temperatura de la Solución Nutritiva en °C');
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
