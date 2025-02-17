<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFichaUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ficha_users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')
                  ->on('users')->onDelete('cascade');

                 
                  $table->integer('codigoVisual')->unique();
                  $table->integer('codigoTeclado')->unique()->nullable();


                  $table->longText('descripcion')->nullable();
                  $table->string('observaciones')->nullable();
                  
                
                  $table->boolean('condicion')->default(1); 

            $table->timestamps();
        });
        DB::table('ficha_users')->insert(array('user_id'=>'1','codigoVisual'=>'1', 'codigoTeclado'=>'1234', 'descripcion'=>'1234'));

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ficha_users');
    }
}
