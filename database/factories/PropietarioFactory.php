<?php

use App\Propietario;
use Faker\Generator as Faker;

$factory->define(Propietario::class, function (Faker $faker) {
    return [
        'dni' => $this->faker->name, 
        'nombre' => $faker->name, 
        'direccion' => $faker->address, 
        'poblacion' => $faker->country, 
        'postal' => $faker->countryCode, 
        'provincia' => $faker->country, 
        'telefono' => $faker->phoneNumber,
        'email' => $faker->unique()->safeEmail, 
      'factura' => 1, 
      
       'observaciones' => $faker->name,
              
            
       'baja' => 1, 
    ];
});
