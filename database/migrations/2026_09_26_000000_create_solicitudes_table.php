<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('solicitudes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 120);
            $table->string('correo', 160);
            $table->string('whatsapp', 20);
            $table->string('punto', 20);
            // Fecha en que la persona autorizó el tratamiento de datos (Ley 1581 de 2012)
            $table->timestamp('consentimiento_at');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('solicitudes');
    }
};
