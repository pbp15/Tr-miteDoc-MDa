<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserExpedientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_expedientes', function (Blueprint $table) {
            $table->id();         
            $table->integer('iduser')->unsigned();
            $table->foreign('iduser')->references('id')->on('users');

            $table->integer('idoficina')->unsigned();
            $table->foreign('idoficina')->references('id')->on('oficinas');
            
            $table->integer('idexpediente')->unsigned();
            $table->foreign('idexpediente')->references('id')->on('expedientes');


            $table->string('estado',45);
            $table->dateTime('fecha');
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
        Schema::dropIfExists('user_expedientes');
    }
}
