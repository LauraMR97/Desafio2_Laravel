<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Conjunto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conjuntos', function (Blueprint $table) {
            $table->string('correo');
            $table->unsignedBigInteger('id_rol');
            $table->primary(['correo', 'id_rol']);
            $table->foreign('correo')->references('correo')->on('personas')->onDelete('cascade');
            $table->foreign('id_rol')->references('id')->on('rol')->onDelete('cascade');
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
