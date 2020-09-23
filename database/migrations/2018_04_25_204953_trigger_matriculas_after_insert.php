<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TriggerMatriculasAfterInsert extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared(
            'CREATE TRIGGER matriculas_after_insert AFTER INSERT ON `matriculas` FOR EACH ROW
                BEGIN
                    declare parcela float;
                    declare periodo integer;
                    declare v_total float;
                    
                    select valr_plan into parcela from planos where planos.id = NEW.plano_id;
                    select peri_plan into periodo from planos where planos.id = NEW.plano_id;
                    set v_total = parcela * periodo;
                    
                    insert into carnes(valr_totl, numr_parc, matricula_id, academia_id)
                                       values
						              (v_total, periodo, NEW.id, NEW.academia_id);
                
                END'
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER `matriculas_after_insert`');
    }
}
