<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Persona extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->string('correo')->primary();
            $table->string('nombre');
            $table->string('nick');
            $table->string('password');
            $table->integer('edad');
            $table->string('ciudad');
            $table->string('descripcion');
            $table->string('tema');
            $table->string('foto');
            $table->string('activo');
            $table->string('conectado');
            $table->unsignedBigInteger('id_genero')->index();
            $table->foreign('id_genero')->references('id')->on('generos')->onDelete('cascade');
            $table->boolean('quiereHijos');
            $table->string('tipoRelaccion');
            $table->integer('hijosDeseados');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
