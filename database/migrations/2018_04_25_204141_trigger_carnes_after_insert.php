<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TriggerCarnesAfterInsert extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared(
                "CREATE TRIGGER carnes_after_update AFTER INSERT ON `carnes` FOR EACH ROW
                BEGIN
                    declare i int default 1;
                    declare mes int;
                    declare codg int;
                    declare datavenc varchar(20);
                    declare valor double;
                    declare ano, codg_aux int;
                    declare n_parcelas int;
                    declare v_total float;
                    declare v_parcela float;
                    
                    set v_total = NEW.valr_totl;
                    set n_parcelas = NEW.numr_parc;
                    set v_parcela = v_total / n_parcelas;
                    
                    SELECT YEAR(sysdate()), (month(sysdate())+1) into ano, mes;
                    
                    select max(codg_mensa) into codg_aux from mensalidades as m inner join academias as a on m.academia_id = a.id where a.id = NEW.academia_id;
                    
                    if codg_aux > 0 then
                        set codg_aux = codg_aux + 1;
                    else
                        set codg_aux = 1;
                     end if;   
                    
                    loopmatricula: LOOP
                        
                        if mes > 12 then
                            set ano = ano + 1;
                            set mes = 1;
                        end if;
                        
                        select concat(ano, '/', mes, '/05') into datavenc;
                        
                        insert into mensalidades(codg_mensa, quitada, data_venc, valr_mensa, saldo_mensa, carne_id, academia_id) 
                                                values 
                                                (codg_aux, false, STR_TO_DATE(datavenc, '%Y/%m/%d'),v_parcela, v_parcela, NEW.id, NEW.academia_id);
                        
                        if i >= n_parcelas
                        then 
                            leave loopmatricula;	
                        end if;
                        
                        set mes = mes +1;
                        
                        set i = i +1;
                    end loop;                                                       
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
        DB::unprepared('DROP TRIGGER `carnes_after_update`');
    }
}
