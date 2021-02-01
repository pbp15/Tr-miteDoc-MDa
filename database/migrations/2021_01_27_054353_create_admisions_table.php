<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdmisionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admisions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombres_apo',100)->nullable();
            $table->string('dni_apo',100)->nullable();
            $table->string('nombres_estud',100)->nullable();
            $table->string('dni_estud',100)->nullable();        
            $table->string('telefono',9)->nullable();
            $table->string('email',200)->nullable();
            $table->string('nivel',300)->nullable();  
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
        Schema::dropIfExists('admisions');
    }
}
