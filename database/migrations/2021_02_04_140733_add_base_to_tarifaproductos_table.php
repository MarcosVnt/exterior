<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBaseToTarifaproductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tarifaproductos', function (Blueprint $table) {
            //

                //
                $table->decimal('base', 11, 2)->nullable();
    
    
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tarifaproductos', function (Blueprint $table) {
            //
            $table->dropColumn('base');

        });
    }
}

