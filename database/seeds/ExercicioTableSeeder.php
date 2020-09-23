<?php

use App\Models\Exercicio;
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
class ExercicioTableSeeder extends Seeder
{

    public function run()
    {

        DB::table('exercicios')->insert([
            ['codg_exrc' => 1, 'nome_exrc' => 'ABDOMINAL APLITUDE MAXIMA', 'academia_id' => 1],
            ['codg_exrc' => 2, 'nome_exrc' => 'ABDOMINAL NO APARELHO', 'academia_id' => 1],
            ['codg_exrc' => 3, 'nome_exrc' => 'ABDOMINAL OBLIQUO', 'academia_id' => 1],
            ['codg_exrc' => 4, 'nome_exrc' => 'AGACHAMENTO EM PE', 'academia_id' => 1],
            ['codg_exrc' => 5, 'nome_exrc' => 'AGACHAMENTO INCLINADO', 'academia_id' => 1],
            ['codg_exrc' => 6, 'nome_exrc' => 'CRUCIFIXO', 'academia_id' => 1],
            ['codg_exrc' => 7, 'nome_exrc' => 'CRUCIFIXO INVERSO', 'academia_id' => 1],
            ['codg_exrc' => 8, 'nome_exrc' => 'CRUCIFIXO INVERSO NO CROSS OVER', 'academia_id' => 1],
            ['codg_exrc' => 9, 'nome_exrc' => 'CRUCIFIXO NO VOADOR', 'academia_id' => 1],
            ['codg_exrc' => 10, 'nome_exrc' => 'DESENVOLVIMENTO ALTERNADO', 'academia_id' => 1],
            ['codg_exrc' => 11, 'nome_exrc' => 'PUXADA NA BARRA FIXA', 'academia_id' => 1],
            ['codg_exrc' => 12, 'nome_exrc' => 'REMADA ALTA COM HALTERES', 'academia_id' => 1],
            ['codg_exrc' => 13, 'nome_exrc' => 'REMADA NA POLIA', 'academia_id' => 1],
            ['codg_exrc' => 14, 'nome_exrc' => 'ROSCA ALTERANDA', 'academia_id' => 1],
            ['codg_exrc' => 15, 'nome_exrc' => 'ROSCA DIRETA', 'academia_id' => 1],
            ['codg_exrc' => 16, 'nome_exrc' => 'ROSCA SCOTH', 'academia_id' => 1],
            ['codg_exrc' => 17, 'nome_exrc' => 'SUPINO ARTICULADO', 'academia_id' => 1],
            ['codg_exrc' => 18, 'nome_exrc' => 'SUPINO DECLINADO', 'academia_id' => 1],
            ['codg_exrc' => 19, 'nome_exrc' => 'SUPINO RETO COM HALTERES', 'academia_id' => 1],
            ['codg_exrc' => 20, 'nome_exrc' => 'TRICEPS BANCO', 'academia_id' => 1],
            ['codg_exrc' => 21, 'nome_exrc' => 'TRICEPS FRANCES', 'academia_id' => 1],
            ['codg_exrc' => 22, 'nome_exrc' => 'TRICEPS TESTA', 'academia_id' => 1],
            ['codg_exrc' => 23, 'nome_exrc' => 'TRICEPS PULLEY', 'academia_id' => 1],

        ]);

        DB::table('exercicios')->insert([
            ['codg_exrc' => 1, 'nome_exrc' => 'ABDOMINAL APLITUDE MAXIMA', 'academia_id' => 2],
            ['codg_exrc' => 2, 'nome_exrc' => 'ABDOMINAL NO APARELHO', 'academia_id' => 2],
            ['codg_exrc' => 3, 'nome_exrc' => 'ABDOMINAL OBLIQUO', 'academia_id' => 2],
            ['codg_exrc' => 4, 'nome_exrc' => 'AGACHAMENTO EM PE', 'academia_id' => 2],
            ['codg_exrc' => 5, 'nome_exrc' => 'AGACHAMENTO INCLINADO', 'academia_id' => 2],
            ['codg_exrc' => 6, 'nome_exrc' => 'CRUCIFIXO', 'academia_id' => 2],
            ['codg_exrc' => 7, 'nome_exrc' => 'CRUCIFIXO INVERSO', 'academia_id' => 2],
            ['codg_exrc' => 8, 'nome_exrc' => 'CRUCIFIXO INVERSO NO CROSS OVER', 'academia_id' => 2],
            ['codg_exrc' => 9, 'nome_exrc' => 'CRUCIFIXO NO VOADOR', 'academia_id' => 2],
            ['codg_exrc' => 10, 'nome_exrc' => 'DESENVOLVIMENTO ALTERNADO', 'academia_id' => 2],
            ['codg_exrc' => 11, 'nome_exrc' => 'PUXADA NA BARRA FIXA', 'academia_id' => 2],
            ['codg_exrc' => 12, 'nome_exrc' => 'REMADA ALTA COM HALTERES', 'academia_id' => 2],
            ['codg_exrc' => 13, 'nome_exrc' => 'REMADA NA POLIA', 'academia_id' => 2],
            ['codg_exrc' => 14, 'nome_exrc' => 'ROSCA ALTERANDA', 'academia_id' => 2],
            ['codg_exrc' => 15, 'nome_exrc' => 'ROSCA DIRETA', 'academia_id' => 2],
            ['codg_exrc' => 16, 'nome_exrc' => 'ROSCA SCOTH', 'academia_id' => 2],
            ['codg_exrc' => 17, 'nome_exrc' => 'SUPINO ARTICULADO', 'academia_id' => 2],
            ['codg_exrc' => 18, 'nome_exrc' => 'SUPINO DECLINADO', 'academia_id' => 2],
            ['codg_exrc' => 19, 'nome_exrc' => 'SUPINO RETO COM HALTERES', 'academia_id' => 2],
            ['codg_exrc' => 20, 'nome_exrc' => 'TRICEPS BANCO', 'academia_id' => 2],
            ['codg_exrc' => 21, 'nome_exrc' => 'TRICEPS FRANCES', 'academia_id' => 2],
            ['codg_exrc' => 22, 'nome_exrc' => 'TRICEPS TESTA', 'academia_id' => 2],
            ['codg_exrc' => 23, 'nome_exrc' => 'TRICEPS PULLEY', 'academia_id' => 2],

        ]);

    }

}