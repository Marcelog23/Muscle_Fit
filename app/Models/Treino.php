<?php

namespace App\Models;

use App\Scopes\TenantModels;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Treino extends Model
{
    use TenantModels;

    protected $fillable = [
        'codg_trno',
        'matricula_id',
        'dia_sema',
        'academia_id'
    ];

    public function diaSemana($value = null)
    {
        $dia = [
            'SE' => 'SEGUNDA',
            'TE' => 'TERCA',
            'QA' => 'QUARTA',
            'QI' => 'QUINTA',
            'SX' => 'SEXTA',
            'SA' => 'SABADO'
        ];
        if (!$value)
            return $dia;
        return $dia[$value];
    }


    public function matricula()
    {
        return $this->belongsTo(matricula::class);
    }

    public function exercicios()
    {
        return $this->belongsToMany(Exercicio::class, 'treino_exercicios', 'treino_id', 'exercicio_id')
            ->withPivot(['numr_rept', 'numr_sers', 'temp_intv','treino_id','exercicio_id']);
    }

    public function codigoControle()
    {
        $codigo = DB::table('treinos as t')
            ->join('academias as a', 't.academia_id', 'a.id')
            ->where('a.id', \Auth::user()->academia_id)
            ->max('codg_trno');

        if (!isset($codigo))
            $codigo = 1;
        else
            $codigo += 1;

        return $codigo;
    }

    public function getTreinos($filtro)
    {
        if ($filtro == null){
            return DB::table('treinos as t')->select('t.matricula_id', 'a.nome_aluno')
                ->join('matriculas as m', 't.matricula_id', 'm.id')
                ->join('alunos as a', 'm.aluno_id', 'a.id')
                ->where('t.academia_id', \Auth::user()->academia_id)
                ->groupBy('t.matricula_id', 'a.nome_aluno')->get();
        }else{
            return DB::table('treinos as t')->select('t.matricula_id', 'a.nome_aluno')
                ->join('matriculas as m', 't.matricula_id', 'm.id')
                ->join('alunos as a', 'm.aluno_id', 'a.id')
                ->where([
                    ['m.id', $filtro],
                    ['t.academia_id', \Auth::user()->academia_id]
                ])
                ->orWhere([
                    ['a.nome_aluno', 'LIKE', "%{$filtro}%"],
                    ['t.academia_id', \Auth::user()->academia_id],
                ])
                ->groupBy('t.matricula_id', 'a.nome_aluno')->get();
        }
    }


    public function getTreinosAluno($matricula_id)
    {

        return DB::table('treinos as t')
            ->select('t.id', 't.codg_trno', 't.matricula_id', 't.dia_sema', 'te.numr_rept', 'te.numr_sers', 'te.temp_intv', 'e.nome_exrc', 'a.nome_aluno')
            ->join('treino_exercicios as te', 't.id', 'te.treino_id')
            ->join('exercicios as e', 'te.exercicio_id', 'e.id')
            ->join('matriculas as m', 't.matricula_id', 'm.id')
            ->join('alunos as a', 'm.aluno_id', 'a.id')
            ->where([
                ['t.matricula_id', $matricula_id],
                ['t.academia_id', \Auth::user()->academia_id]
            ])->groupBy('t.id', 't.codg_trno', 't.matricula_id', 't.dia_sema', 'te.numr_rept', 'te.numr_sers', 'te.temp_intv', 'e.nome_exrc', 'a.nome_aluno')->get();

    }

}
