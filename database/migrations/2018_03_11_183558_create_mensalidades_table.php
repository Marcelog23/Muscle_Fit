<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMensalidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mensalidades', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('codg_mensa');
            $table->boolean('quitada')->default(false);
            $table->date('data_venc');
            $table->float('valr_mensa');
            $table->float('saldo_mensa')->nullable();

            $table->integer('carne_id')->unsigned();
            $table->foreign('carne_id')->references('id')->on('carnes')->onDelete('cascade');

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
        Schema::dropIfExists('mensalidades');
    }
}
