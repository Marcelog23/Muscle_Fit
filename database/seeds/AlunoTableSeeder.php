<?php

use App\Models\Aluno;
use Illuminate\Database\Seeder;

class AlunoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Aluno::create([
            'id' => 1,
            'codg_aluno' => 1,
            'genr_aluno' => 'M',
            'stts_aluno' => 'I',
            'nome_aluno' => 'MARCELO GRANZOTO',
            'data_nasc' => '1988/05/23',
            'endr_aluno' => 'ARCISO CRESTANI ',
            'email_aluno' => 'm23granzoto@gmail.com',
            'cep_aluno' => '99840000',
            'numr_endr' => '37',
            'telf_aluno' => '999596122',
            'cpf_aluno' => '01531803075',
            'rg_aluno' => '01531803075',
            'objt_aluno' => 'MASSA MAGRA',
            'cidade_id' => 1,
            'academia_id' => 1
        ]);

        Aluno::create([
            'id' => 2,
            'codg_aluno' => 1,
            'genr_aluno' => 'M',
            'stts_aluno' => 'I',
            'nome_aluno' => 'LEANDRO CARBONERA',
            'data_nasc' => '1980/06/14',
            'endr_aluno' => 'RUA 894',
            'email_aluno' => 'leca@gmail.com',
            'cep_aluno' => '99840000',
            'numr_endr' => '99',
            'telf_aluno' => '999596122',
            'cpf_aluno' => '99535503075',
            'rg_aluno' => '66538903023',
            'objt_aluno' => 'MASSA MAGRA',
            'cidade_id' => 1,
            'academia_id' => 2
        ]);
    }
}
