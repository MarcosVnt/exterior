<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AnadirUsersCampos extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('users', function ($table) {
            if (!Schema::hasColumn('users', 'avatar')) {
                $table->string('avatar')->nullable()->after('email')->default('users/default.png');
            }
            $table->integer('rol_id')->nullable()->after('id')->default(5);
            $table->boolean('condicion')->default(1);

        });

        DB::table('users')->insert(array(
            'name'           => 'Administrador',
            'email'          => 'administrador@rotuleon.com',
            'password'       => bcrypt('12345678'),
            'remember_token' => str_random(60),
            'rol_id'        => 1));
    }

    /*
     * Reverse the migrations.
     */
    public function down()
    {
        if (Schema::hasColumn('users', 'avatar')) {
            Schema::table('users', function ($table) {
                $table->dropColumn('avatar');
            });
        }
        if (Schema::hasColumn('users', 'role_id')) {
            Schema::table('users', function ($table) {
                $table->dropColumn('role_id');
            });
        }
    }
}
