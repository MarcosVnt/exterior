<?php

use Faker\Generator as Faker;

$factory->define(Contrato::class, function (Faker $faker) {
    return [


        'ejercicio' => '2022', 
        'numero' =>  1, 
        
        'agencia_id' => 1, 
        'cliente_id' => 1, 
        'valla_id' =>$faker->numberBetween(0,1000),
         
        'referencia' => $faker->name, 
        'descripcion' => $faker->country, 
        'observaciones' => $faker->countryCode, 
        'fecha_inicio' => $faker->dateTime(), 
        'fecha_final' => $faker->dateTime(),
        'duracion' => $faker->numberBetween(0,1000),
      'forma_pago' => 1, 
      'importe_periodo' => $faker->country, 
      'alquiler_anual' => $faker->country, 
      'baja' => 1, 

        //
    ];
});
