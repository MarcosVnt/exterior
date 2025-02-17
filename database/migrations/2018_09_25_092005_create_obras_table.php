<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObrasTable extends Migration
{
    
    public function up()
    {
        Schema::create('obras', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo', 50)->unique();
            $table->string('nombre', 100)->unique();
            $table->text('descripcion')->nullable();
            $table->string('movil', 100)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('responsable', 100)->nullable();
            $table->string('cliente', 100)->nullable();
            $table->string('fecha_alta', 100)->nullable();
            $table->string('slug')->unique();

            $table->boolean('condicion')->default(1);



            $table->timestamps();
        });
    


        DB::table('obras')->insert(array('id'=>'1','codigo'=>'9997/2018', 'nombre'=>'CARGA MATERIAL', 'fecha_alta'=>'01/01/2000', 'cliente'=>'Nombre clientes', 'slug'=>'CARGA-MATERIAL'));
        DB::table('obras')->insert(array('id'=>'12','codigo'=>'9967/2018', 'nombre'=>'apertura tienda rotulo', 'fecha_alta'=>'01/01/2001', 'cliente'=>'Nombre clientes aaa', 'slug'=>'CARGA1-MATERIAL'));
        DB::table('obras')->insert(array('id'=>'13','codigo'=>'9957/2018', 'nombre'=>'rotuleon en fachada', 'fecha_alta'=>'01/01/2002', 'cliente'=>'Nombre clientes bbb', 'slug'=>'CARGA2-MATERIAL'));
        DB::table('obras')->insert(array('id'=>'14','codigo'=>'9947/2018', 'nombre'=>'limpieza rotulo', 'fecha_alta'=>'01/01/2003', 'cliente'=>'Nombre clientes  aaa bbb', 'slug'=>'CARGA3-MATERIAL'));
    } 
    
        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
            Schema::dropIfExists('obras');
        }
    

}
