<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlumnosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('_alumnos', function (Blueprint $table) {
            $table->Increments('id', true)->unsigned();
            $table->string('Rut', 10);
            $table->string('ApellidoP', 49);
            $table->string('ApellidoM', 49);
            $table->string('Nombre', 49);
            $table->string('Codigo_Carrera',10);
            $table->string('Correo_Electroninco', 100)->default('');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('_alumnos');
    }
}
