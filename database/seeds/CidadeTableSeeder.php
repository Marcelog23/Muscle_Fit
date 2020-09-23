<?php

use App\Models\Cidade;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

/**
 * Created by PhpStorm.
 * User: Marcelo G
 * Date: 17/03/2018
 * Time: 17:25
 */
class CidadeTableSeeder extends Seeder
{

    public function run()
    {
       \Illuminate\Support\Facades\DB::table('cidades')->insert([
           ['nome_cidd' => 'SANANDUVA'],
           ['nome_cidd' => 'PASSO FUNDO'],
           ['nome_cidd' => 'TAPEJARA'],
           ['nome_cidd' => 'IBIACA'],
           ['nome_cidd' => 'MARAU'],
           ['nome_cidd' => 'JOACABA'],
           ['nome_cidd' => 'CHAPECO'],
           ['nome_cidd' => 'CAXIAS DO SUL'],
       ]);


    }


}