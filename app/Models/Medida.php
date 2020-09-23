<?php

namespace App\Models;

use App\Scopes\TenantModels;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Medida extends Model
{
    use TenantModels;

    protected $fillable = [
        'codg_medd',
        'data_coleta',
        'peso_aluno',
        'altr_aluno',
        'cint_aluno',
        'qudr_aluno',
        'abdm_aluno',
        'coxa_dirt',
        'coxa_esqr',
        'bicp_dirt',
        'bicp_esqr',
        'ante_brco_dirt',
        'ante_brco_esqr',
        'pantr_esqr',
        'pantr_dirt',
        'personal_id',
        'matricula_id',
        'academia_id'
    ];

    public function matricula()
    {
        return $this->belongsTo(Matricula::class);
    }

    public function personal()
    {
        return $this->belongsTo(Personal::class);
    }

    public function listaMedidas($filtro)
    {
        if ($filtro == null){

         return DB::table('medidas as m')
                ->select('m.id','m.codg_medd','m.data_coleta','a.nome_aluno','p.nome_pers')
                ->join('matriculas as ma','m.matricula_id','ma.id')
                ->join('alunos as a','ma.aluno_id','a.id')
                ->join('personals as p','m.personal_id','p.id')
                ->where('m.academia_id',\Auth::user()->academia_id)
                ->groupBy('m.id','m.codg_medd','m.data_coleta','a.nome_aluno','p.nome_pers')
                ->paginate(15);


        }else{

            return  DB::table('medidas as m')
                ->select('m.id','m.codg_medd','m.data_coleta','a.nome_aluno','p.nome_pers')
                ->join('matriculas as ma','m.matricula_id','ma.id')
                ->join('alunos as a','ma.aluno_id','a.id')
                ->join('personals as p','m.personal_id','p.id')
                ->where([
                    ['m.codg_medd',$filtro],
                    ['m.academia_id',\Auth::user()->academia_id],
                ])
                ->orWhere([
                    ['a.nome_aluno','LIKE',"%{$filtro}%"],
                    ['m.academia_id',\Auth::user()->academia_id]
                ])
                ->orWhere([
                    ['p.nome_pers','LIKE',"%{$filtro}%"],
                    ['m.academia_id',\Auth::user()->academia_id],
                ])
                ->groupBy('m.id','m.codg_medd','m.data_coleta','a.nome_aluno','p.nome_pers')
                ->paginate(15);
        }

    }


    public function getCodigoControle()
    {
      $codigo = DB::table('medidas as m')->join('academias as a', 'm.academia_id', 'a.id')
            ->where('a.id', \Auth::user()->academia_id)
            ->max('codg_medd');

        if (!isset($codigo))
            $codigo = 1;
        else
            $codigo += 1;

        return $codigo;
    }
}


