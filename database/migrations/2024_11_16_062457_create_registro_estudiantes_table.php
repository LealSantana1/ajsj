<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistroEstudiantesTable extends Migration
{
    public function up()
    {
        Schema::create('registro_estudiantes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_completo');
            $table->string('direccion')->nullable();
            $table->string('telefono')->nullable();
            $table->string('correo_electronico')->nullable();
            $table->string('grado');
            $table->string('seccion');
            $table->date('fecha_ingreso');

            $table->string('nombre_padre')->nullable();
            $table->string('nombre_madre')->nullable();
            $table->string('telefono_padre')->nullable();
            $table->string('telefono_madre')->nullable();
            $table->string('documento_tipo');  // Tipo de documento
            $table->string('documento_numero');  // Número de documento
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('registro_estudiantes');
    }
}
