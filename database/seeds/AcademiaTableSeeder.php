<?php

use App\Models\Academia;
use Illuminate\Database\Seeder;

/**
 * Created by PhpStorm.
 * User: Marcelo G
 * Date: 17/03/2018
 * Time: 17:43
 */

class AcademiaTableSeeder extends Seeder
{
    public function run()
    {

        Academia::create([
            'razao_social' => 'RONALDO NAVARINI',
            'nome_fant' => 'ACM FITNES',
            'endr_acade' => 'SALZANO DA CUNHA',
            'compl_endr' => 'GALERIA CENTRAL',
            'telf_acade' => '5433432020',
            'email_acade' => 'acm@gmail.com',
            'numr_acade' => 10,
            'cep_acade' => 99840000,
            'cnpj_acade' => 28856869000151 ,
            'cidade_id' => 1,
        ]);

        Academia::create([
            'razao_social' => 'BRUNA SOUZA',
            'nome_fant' => 'ACADEMIA DA BRUNA',
            'endr_acade' => 'SALZANO DA CUNHA',
            'compl_endr' => 'N',
            'telf_acade' => '5433431010',
            'email_acade' => 'manu@gmail.com',
            'numr_acade' => 10,
            'cep_acade' => 99840000,
            'cnpj_acade' => 28856869000151 ,
            'cidade_id' => 1,
        ]);
    }

}