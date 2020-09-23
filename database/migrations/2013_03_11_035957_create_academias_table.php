<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAcademiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('academias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('razao_social',250);
            $table->string('nome_fant',250);
            $table->string('endr_acade',250);
            $table->string('compl_endr',200)->nullable();
            $table->string('telf_acade');
            $table->string('email_acade');
            $table->string('numr_acade');
            $table->string('cep_acade');
            $table->string('cnpj_acade');
            $table->integer('cidade_id')->unsigned();
            $table->foreign('cidade_id')->references('id')->on('cidades');


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
        Schema::dropIfExists('academias');
    }
}
