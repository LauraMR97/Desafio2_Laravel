<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PreferenciasPersona extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preferencias_persona', function (Blueprint $table) {
            $table->string('correo');
            $table->unsignedBigInteger('id_preferencia');
            $table->primary(['correo', 'id_preferencia']);
            $table->foreign('id_preferencia')->references('id')->on('preferencias')->onDelete('cascade');
            $table->foreign('correo')->references('correo')->on('personas')->onDelete('cascade');
            $table->integer('intensidad');
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
