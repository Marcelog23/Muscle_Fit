<?php

use App\Models\FormaPagamento;
use Illuminate\Database\Seeder;

/**
 * Created by PhpStorm.
 * User: Marcelo G
 * Date: 30/03/2018
 * Time: 17:12
 */
class FormaPagamentoTableSeeder extends Seeder
{

    public function run()
    {
        FormaPagamento::create([
            'nome_fopg' => 'DINHEIRO',
            'sigl_fopg' => 'DIN',
        ]);
        FormaPagamento::create([
            'nome_fopg' => 'CARTAO DEBITO',
            'sigl_fopg' => 'CAD',
        ]);
        FormaPagamento::create([
            'nome_fopg' => 'CARTAO CREDITO',
            'sigl_fopg' => 'CAC',
        ]);


    }


}