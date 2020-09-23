<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TriggerPagamentosAfterDelete extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared(
        "CREATE TRIGGER pagamentos_after_delete AFTER DELETE ON `pagamentos` FOR EACH ROW
            BEGIN
                declare codg_aux integer;

                update mensalidades set quitada = 0, saldo_mensa = saldo_mensa + OLD.valr_pagt where id = OLD.mensalidade_id and academia_id = OLD.academia_id;
                
                select max(codg_caixa) into codg_aux from caixas as c inner join academias as a on c.academia_id = a.id where a.id = OLD.academia_id;
            
                if codg_aux > 0 then
                    set codg_aux = codg_aux + 1;
                else
                    set codg_aux = 1;
                end if;
                
                insert into caixas (codg_caixa, desc_caixa, valr_pagt, data_pagt, tipo_lanc, academia_id) 
                        values (codg_aux, 'ESTORNO DE MENSALIDADE', OLD.valr_pagt, sysdate(), '(E) ESTORNO', OLD.academia_id);
            END"

        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER `pagamentos_after_delete`');
    }
}
