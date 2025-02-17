<?php

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$now = Carbon::now()->toDateTimeString();

        User::insert([
           /*  [
            'name'           => 'Administrador',
            'email'          => 'administrador@rotuleon.com',
            'password'       => bcrypt(config('12345678')),
            'remember_token' => str_random(60),
            'rol_id'        => 1,
             ], */
              [
                'name'           => 'Oficina',
                'email'          => 'oficina@rotuleon.com',
                'password'       => bcrypt('123456'),
                'remember_token' => str_random(50),
                'rol_id'        => 2,
            ],

            [
                'name'           => 'Taller',
                'email'          => 'taller@rotuleon.com',
                'password'       => bcrypt('123456'),
                'remember_token' => str_random(40),
                'rol_id'        => 3,
            ],
            [
                'name'           => 'Externo',
                'email'          => 'externo@rotuleon.com',
                'password'       => bcrypt('123456'),
                'remember_token' => str_random(30),
                'rol_id'        => 4,
            ], 
           
        ]
    
    );

    }
}
