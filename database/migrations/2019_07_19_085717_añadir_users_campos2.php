<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AñadirUsersCampos2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    
         /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('users', function ($table) {
          
            $table->integer('visual_id')->nullable()->after('rol_id');
            $table->integer('teclado_id')->default(0);

        });
    }

    /*
     * Reverse the migrations.
     */
    public function down()
    {
        if (Schema::hasColumn('users', 'visual_id')) {
            Schema::table('users', function ($table) {
                $table->dropColumn('visual_id');
            });
        }
        if (Schema::hasColumn('users', 'teclado_id')) {
            Schema::table('users', function ($table) {
                $table->dropColumn('teclado_id');
            });
        }
    }
}
