<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('codg_pers');
            $table->string('nome_pers',250);
            $table->date('data_nasc');
            $table->enum('genr_pers',['M','F']);
            $table->string('endr_pers');
            $table->integer('numr_endr');
            $table->string('email_pers');
            $table->string('telf_pers');
            $table->string('cep_pers');
            $table->string('cpf_pers');
            $table->string('rg_pers');
            $table->text('forma_acad');
            $table->text('obsr_pers')->nullable();
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
        Schema::dropIfExists('personals');
    }
}
