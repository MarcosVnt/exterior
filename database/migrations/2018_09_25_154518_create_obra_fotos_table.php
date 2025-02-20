<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObraFotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('obra_fotos', function (Blueprint $table) {
            $table->increments('id');


            $table->integer('obra_id')->unsigned()->nullable();
            $table->foreign('obra_id')->references('id')
                  ->on('obras')->onDelete('cascade');

            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')
                  ->on('users')->onDelete('cascade');
      
            $table->string('imagen')->nullable();
            $table->text('texto')->nullable();
            $table->string('slug')->unique();


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
        Schema::dropIfExists('obra_fotos');
    }
}
