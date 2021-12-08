<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class GustoGenero extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gusto_genero', function (Blueprint $table) {
            $table->unsignedBigInteger('id');
            $table->string('correo');
            $table->primary(['correo', 'id']);
            $table->foreign('id')->references('id')->on('generos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('correo')->references('correo')->on('personas')->onDelete('cascade')->onUpdate('cascade');
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
