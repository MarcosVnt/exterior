<?php

use App\Presupuesto;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PresupuestosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for ($i=0; $i < 185; $i++) { 
            DB::table('presupuestos')->insert([
               'idusuario' => 1,
               'trabajo_descripcion' => str_random(100),
               'fecha_presupuesto'=>date('Y-m-d H:i:s'),
   
           ]);
       }
        

    }
}
