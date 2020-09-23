<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTreinoExerciciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('treino_exercicios', function (Blueprint $table) {
            $table->integer('numr_rept');
            $table->integer('numr_sers');
            $table->integer('temp_intv');

            $table->integer('treino_id')->unsigned();
            $table->foreign('treino_id')->references('id')->on('treinos')->onDelete('cascade');

            $table->integer('exercicio_id')->unsigned();
            $table->foreign('exercicio_id')->references('id')->on('exercicios');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('treino_exercicios');
    }
}
