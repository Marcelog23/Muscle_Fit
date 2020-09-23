<?php

namespace App\Models;

use App\Scopes\TenantModels;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Mensalidade extends Model
{

    use TenantModels;

    protected $fillable = [
        'codg_mensa',
        'data_venc',
        'valr_pagt',
        'quitada',
        'carne_id',
    ];

    public function carne()
    {
        return $this->belongsTo(Carne::class);
    }


    public function listaMensalidades($filtro)
    {
        if ($filtro == null) {
            // lista só as mensalidades dos alunos e matriculas ativados
            return DB::table('mensalidades as m')
                ->select('m.codg_mensa', 'a.nome_aluno', 'p.nome_plan')
                ->join('carnes as c', 'm.carne_id', 'c.id')
                ->join('matriculas as ma', 'c.matricula_id', 'ma.id')
                ->join('planos as p', 'ma.plano_id', 'p.id')
                ->join('alunos as a', 'ma.aluno_id', 'a.id')
                ->where([
                    ['m.academia_id', \Auth::user()->academia_id],
                    ['a.stts_aluno', 'A'],
                    ['ma.ativada', 1]
                ])->groupBy('m.codg_mensa', 'a.nome_aluno', 'p.nome_plan')
                ->paginate(15);

        } else {
            // lista só as mensalidades dos alunos e matriculas ativados
            return DB::table('mensalidades as m')
                ->select('m.codg_mensa', 'a.nome_aluno', 'p.nome_plan')
                ->join('carnes as c', 'm.carne_id', 'c.id')
                ->join('matriculas as ma', 'c.matricula_id', 'ma.id')
                ->join('planos as p', 'ma.plano_id', 'p.id')
                ->join('alunos as a', 'ma.aluno_id', 'a.id')
                ->where([
                    ['m.codg_mensa',$filtro],
                    ['m.academia_id', \Auth::user()->academia_id],
                    ['a.stts_aluno', 'A'],
                    ['ma.ativada', 1]
                ])
                ->orWhere([
                    ['a.nome_aluno', 'LIKE', "%{$filtro}%"],
                    ['m.academia_id', \Auth::user()->academia_id],
                    ['a.stts_aluno', 'A'],
                    ['ma.ativada', 1]
                ])
                ->orWhere([
                    ['p.nome_plan', 'LIKE', "%{$filtro}%"],
                    ['m.academia_id', \Auth::user()->academia_id],
                    ['a.stts_aluno', 'A'],
                    ['ma.ativada', 1]
                ])
                ->groupBy('m.codg_mensa', 'a.nome_aluno', 'p.nome_plan')
                ->paginate(15);
        }

    }


    public function listaParcelas($codigo)
    {
        return DB::table('mensalidades as m')->select('m.id', 'm.codg_mensa', 'm.quitada', 'm.data_venc', 'm.valr_mensa', 'm.saldo_mensa')
            ->join('academias as a', 'm.academia_id', 'a.id')
            ->where([
                ['m.codg_mensa', '=', $codigo],
                ['quitada', '=', 0],
                ['a.id', '=', \Auth::user()->academia_id]
            ])->paginate(10);
    }


    public function listaNomeAluno($codigo)
    {
        return DB::table('alunos as a')->select('a.nome_aluno')
            ->join('academias', 'a.academia_id', 'academias.id')
            ->join('matriculas as ma', 'a.id', 'ma.aluno_id')
            ->join('carnes as c', 'ma.id', 'c.matricula_id')
            ->join('mensalidades as m', 'c.id', 'm.carne_id')
            ->where([
                ['academias.id', '=', \Auth::user()->academia_id],
                ['m.codg_mensa', '=', $codigo]
            ])->groupBy('a.nome_aluno')->get();
    }


    public function getCodigoControle()
    {
        $codigo = DB::table('pagamentos as p')->join('academias as a', 'p.academia_id', 'a.id')
            ->where('a.id', \Auth::user()->academia_id)->max('codg_pagt');

        if (!isset($codigo))
            $codigo = 1;
        else
            $codigo += 1;

        return $codigo;

    }


    public function getQuitadaFormattedAttribute()
    {
        $value = $this->quitada;
        return $value == false ? 'Pendente' : 'Paga';
    }

    public function getDataVencFormattedAttribute()
    {
        $value = $this->data_venc;
        return formatDateAndTime($value, 'd/m/Y');
    }
}
