<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class CreateHorariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('horarios', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')
                  ->on('users')->onDelete('cascade');

                  $table->time('hora_inicio');
                  $table->time('hora_fin');   

                  $table->longText('descripcion')->nullable();
                  $table->string('observaciones')->nullable();
                  
                
                  $table->boolean('condicion')->default(1); 
      
      
            
            $table->timestamps();

        });

       DB::table('horarios')->insert(array('user_id'=>'1','hora_inicio'=>'080000', 'hora_fin'=>'150000'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('horarios');
    }
}
