<?php

use App\Terreno;
use Faker\Generator as Faker;

$factory->define(Terreno::class, function (Faker $faker) {
    return [
       /*  'propietario_id' => function(){
            return factory(App\Propietario::class)->create()->id;
        }, */
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
