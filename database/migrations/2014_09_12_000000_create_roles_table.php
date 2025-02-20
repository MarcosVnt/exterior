<?php

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
        DB::table('roles')->insert(array('id'=>'1','nombre'=>'Administrador', 'descripcion'=>'Administradores de área'));
        DB::table('roles')->insert(array('id'=>'2','nombre'=>'Oficina', 'descripcion'=>'Area de Oficina'));
        DB::table('roles')->insert(array('id'=>'3','nombre'=>'Taller', 'descripcion'=>'Area de taller'));
        DB::table('roles')->insert(array('id'=>'4','nombre'=>'Externo', 'descripcion'=>'Personal '));
        DB::table('roles')->insert(array('id'=>'5','nombre'=>'Demo', 'descripcion'=>'Demo '));
        DB::table('roles')->insert(array('id'=>'6','nombre'=>'Tablet', 'descripcion'=>'Demo '));

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
