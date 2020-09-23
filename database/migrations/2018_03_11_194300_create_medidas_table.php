<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedidasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medidas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('codg_medd');
            $table->date('data_coleta');
            $table->float('peso_aluno');
            $table->float('altr_aluno');
            $table->float('cint_aluno');
            $table->float('qudr_aluno');
            $table->float('abdm_aluno');
            $table->float('coxa_dirt');
            $table->float('coxa_esqr');
            $table->float('bicp_dirt');
            $table->float('bicp_esqr');
            $table->float('ante_brco_dirt');
            $table->float('ante_brco_esqr');
            $table->float('pantr_esqr');
            $table->float('pantr_dirt');

            $table->integer('matricula_id')->unsigned();
            $table->foreign('matricula_id')->references('id')->on('matriculas');

            $table->integer('personal_id')->unsigned();
            $table->foreign('personal_id')->references('id')->on('personals');

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
        Schema::dropIfExists('medidas');
    }
}
