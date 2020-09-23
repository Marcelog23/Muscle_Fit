<?php

use Illuminate\Database\Seeder;

class EstadoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Estado::create([

            'nome_estd' => 'Rio Grande do Sul',
            'sigl_estd' => 'RS'

        ]);


    }
}
