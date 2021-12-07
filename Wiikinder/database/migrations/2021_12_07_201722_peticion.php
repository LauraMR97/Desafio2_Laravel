<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Peticion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peticiones', function (Blueprint $table) {
            $table->string('correo_origen');
            $table->string('correo_destino');
            $table->primary(['correo_origen', 'correo_destino']);
            $table->foreign('correo_origen')->references('correo')->on('personas')->onDelete('cascade');
            $table->foreign('correo_destino')->references('correo')->on('personas')->onDelete('cascade');
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
