<?php

use App\Valla;
use Faker\Generator as Faker;

$factory->define(Valla::class, function (Faker $faker) {
    return [
        'dni' => $faker->name, 
        'nombre' => $faker->name, 
        'direccion' => $faker->address, 
        'poblacion' => $faker->country, 
        'postal' => $faker->countryCode, 
        'provincia' => $faker->country, 
        'telefono' => $faker->phoneNumber,
        'email' => $faker->unique()->safeEmail, 
      'factura' => 1, 
      
       'observaciones' => $faker->name,
      'latitud'=> $faker->numberBetween(0,10),
      'longitud'=> $faker->numberBetween(0,10),
      'ancho'=> $faker->numberBetween(0,10),
      'alto'=> $faker->numberBetween(0,10),
      'm2'=> $faker->numberBetween(0,10),
      'elemento'=>$faker->numberBetween(0,10),
      'estado' =>$faker->numberBetween(0,10),
    
            
       'baja' => 1, 
    ];
});
