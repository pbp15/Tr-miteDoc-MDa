<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 30)->unique();
            $table->string('descripcion', 100)->nullable();
            $table->boolean('condicion')->default(1);          
        });
        DB::table('roles')->insert(array('id'=>'1','nombre'=>'Administrador', 'descripcion'=>'Administrador del sistema'));
        DB::table('roles')->insert(array('id'=>'2','nombre'=>'Secretaria', 'descripcion'=>'secretaria de trámite documentario'));
        DB::table('roles')->insert(array('id'=>'3','nombre'=>'Gerente', 'descripcion'=>'Gerente  municipal'));
        DB::table('roles')->insert(array('id'=>'4','nombre'=>'Usuario', 'descripcion'=>'Usuario del sistema'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
