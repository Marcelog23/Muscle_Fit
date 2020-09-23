<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlunosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alunos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('codg_aluno');
            $table->enum('genr_aluno',['M','F']);
            $table->enum('stts_aluno',['A','I'])->default('I');
            $table->string('nome_aluno',250);
            $table->date('data_nasc');
            $table->string('endr_aluno',250);
            $table->integer('numr_endr');
            $table->string('email_aluno');
            $table->string('telf_aluno');
            $table->string('cep_aluno');
            $table->string('cpf_aluno');
            $table->string('rg_aluno');
            $table->text('leso_aluno')->nullable();
            $table->text('remd_aluno')->nullable();
            $table->text('objt_aluno');
            $table->integer('cidade_id')->unsigned();
            $table->foreign('cidade_id')->references('id')->on('cidades');
            $table->integer('academia_id')->unsigned();
            $table->foreign('academia_id')->references('id')->on('academias');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alunos');
    }
}
