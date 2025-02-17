<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObraUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('obra_user', function (Blueprint $table) {
            $table->increments('id');

           /*  $table->integer('obra_id')->unsigned()->nullable();
            $table->foreign('obra_id')->references('id')
                  ->on('obras')->onDelete('cascade');

            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')
                  ->on('users')->onDelete('cascade'); */

                  $table->integer('obra_id')->unsigned()->nullable();
                  $table->foreign('obra_id')->references('id')
                        ->on('obras')->onUpdate('cascade')->onDelete('set null');
                  $table->integer('user_id')->unsigned()->nullable();
                  $table->foreign('user_id')->references('id')
                      ->on('users')->onUpdate('cascade')->onDelete('set null');



            $table->boolean('condicion')->default(1);          

            $table->timestamps();
        });
       /*  DB::table('obra_user')->insert(array('obra_id'=>'1','user_id'=>'1'));
        DB::table('obra_user')->insert(array('obra_id'=>'1','user_id'=>'2'));
 */
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
