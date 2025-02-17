<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VallasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('propietarios')->insert([

            'dni' => '11', 
            'nombre' => 'NOMBRE', 
            'direccion' => 'Direccion', 
            'poblacion' => 'poblacion', 
            'postal' => 'postal p ', 
            'provincia' => 'provincia p', 
            'telefono' => '111 p',
            'email' => '111 p', 
          'factura' => 1, 
          
           'observaciones' => 'observa',
                  
                
           'baja' => 1, 

        ]);

        DB::table('terrenos')->insert([

            'propietario_id' => 1,
            'dni' => '11', 
            'nombre' => 'NOMBRE', 
            'direccion' => 'Direccion', 
            'poblacion' => 'poblacion', 
            'postal' => 'postal p ', 
            'provincia' => 'provincia p', 
            'telefono' => '111 p',
            'email' => '111 p', 
          'factura' => 1, 
          
           'observaciones' => 'observa',
                  
                
           'baja' => 1, 

        ]);

        DB::table('terrenos')->insert([

            'propietario_id' => 1,
            'dni' => '11', 
            'nombre' => 'NOMBRE', 
            'direccion' => 'Direccion', 
            'poblacion' => 'poblacion', 
            'postal' => 'postal p ', 
            'provincia' => 'provincia p', 
            'telefono' => '111 p',
            'email' => '111 p', 
          'factura' => 1, 
          
           'observaciones' => 'observa',
                  
                
           'baja' => 1, 

        ]);

        DB::table('vallas')->insert([

            'terreno_id' => 1,
            'dni' => '11', 
            'nombre' => 'NOMBRE', 
            'direccion' => 'Direccion', 
            'poblacion' => 'poblacion', 
            'postal' => 'postal p ', 
            'provincia' => 'provincia p', 
            'telefono' => '111 p',
            'email' => '111 p', 
          'factura' => 1, 
          
           'observaciones' => 'observa',

           'latitud' => 41.333344, 
            'longitud' => 40.232323, 
            'ancho' => 2,
            'alto' => 3, 
          'm2' => 6, 
          'tipo' => 'valla', 
          'elemento' => 'lona', 
          'estado' => 'libre',
    
                  
                
           'baja' => 1, 

        ]);
        DB::table('vallas')->insert([

            'terreno_id' => 1,
            'dni' => '11', 
            'nombre' => 'NOMBRE', 
            'direccion' => 'Direccion', 
            'poblacion' => 'poblacion', 
            'postal' => 'postal p ', 
            'provincia' => 'provincia p', 
            'telefono' => '111 p',
            'email' => '111 p', 
          'factura' => 1, 
          
           'observaciones' => 'observa',

           'latitud' => 41.003344, 
            'longitud' => 40.002323, 
            'ancho' => 2,
            'alto' => 3, 
          'm2' => 6, 
          'tipo' => 'valla', 
          'elemento' => 'lona', 
          'estado' => 'libre',
    
                  
                
           'baja' => 1, 

        ]);

        DB::table('vallas')->insert([

            'terreno_id' => 2,
            'dni' => '11', 
            'nombre' => 'NOMBRE', 
            'direccion' => 'Direccion', 
            'poblacion' => 'poblacion', 
            'postal' => 'postal p ', 
            'provincia' => 'provincia p', 
            'telefono' => '111 p',
            'email' => '111 p', 
          'factura' => 1, 
          
           'observaciones' => 'observa',

           'latitud' => 41.333344, 
            'longitud' => 40.232323, 
            'ancho' => 2,
            'alto' => 3, 
          'm2' => 6, 
          'tipo' => 'valla', 
          'elemento' => 'lona', 
          'estado' => 'libre',
    
                  
                
           'baja' => 1, 

        ]);



    }
}
