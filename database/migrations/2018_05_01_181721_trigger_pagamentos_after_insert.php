<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TriggerPagamentosAfterInsert extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared(
        "CREATE TRIGGER pagamentos_after_insert AFTER INSERT ON `pagamentos` FOR EACH ROW
            BEGIN
                declare saldo float;
                declare codg_aux integer;
                declare a_nome varchar(150);
                
                select saldo_mensa into saldo from mensalidades m 
                    where m.id = NEW.mensalidade_id and m.academia_id = NEW.academia_id;
                        
                    if(saldo - NEW.valr_pagt <= 0) then
                        update mensalidades as m set quitada = 1
                        where  m.id = NEW.mensalidade_id and m.academia_id = NEW.academia_id;
                   
                   elseif (NEW.valr_pagt < saldo) then  
                        update mensalidades as m set m.saldo_mensa = saldo - NEW.valr_pagt
                        where  m.id = NEW.mensalidade_id and m.academia_id = NEW.academia_id;
              
                    end if;
                    
                select max(codg_caixa) into codg_aux from caixas as c 
                inner join academias as a on c.academia_id = a.id where a.id = NEW.academia_id;
                
                    if codg_aux > 0 then
                        set codg_aux = codg_aux + 1;
                    else
                        set codg_aux = 1;
                    end if;
                    
                    
                select a.nome_aluno into a_nome from alunos as a 
                       inner join matriculas as m on a.id = m.aluno_id 
                       inner join carnes as c on m.id = c.matricula_id 
                       inner join mensalidades as ma on c.id = ma.carne_id
                       inner join pagamentos as p on ma.id = p.mensalidade_id
                       where ma.id = NEW.mensalidade_id
                       and ma.academia_id = NEW.academia_id limit 1;  
            
                insert into caixas (codg_caixa, desc_caixa, valr_pagt, data_pagt, tipo_lanc, academia_id) 
                            values (codg_aux, concat('(RC) , ',a_nome) , NEW.valr_pagt, sysdate(), '(C) Credito' , NEW.academia_id);             
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
        DB::unprepared('DROP TRIGGER `pagamentos_after_insert`');
    }
}
