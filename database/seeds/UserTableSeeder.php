<?php

use App\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * Created by PhpStorm.
 * User: Marcelo G
 * Date: 17/03/2018
 * Time: 17:36
 */
class UserTableSeeder extends Seeder
{

    public function run()
    {
        $faker = Faker::create();


        DB::table('users')->truncate();

        User::create([
            'name' => 'MARCELO',
            'codg_user' => 1,
            'email' => 'm23granzoto@gmail.com',
            'password' => Hash::make('123456'),
            'academia_id' => 1,
            'tipo_user' => 'A'
        ]);

        User::create([
            'name' => 'LEANDRO',
            'codg_user' => 1,
            'email' => 'leca@gmail.com',
            'password' => Hash::make('123456'),
            'academia_id' => 2,
            'tipo_user' => 'A'
        ]);

    }

}