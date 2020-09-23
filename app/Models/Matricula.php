<?php

namespace App\Models;

use App\Scopes\TenantModels;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Matricula extends Model
{
    use TenantModels;

    protected $fillable = [
        'codg_matr',
        'aluno_id',
        'plano_id',

    ];

    public function academia()
    {
        return $this->belongsTo('App\Models\Academia');
    }

    public function aluno()
    {
        return $this->belongsTo(Aluno::class);
    }

    public function plano()
    {
        return $this->belongsTo(Plano::class);
    }


    public function listaMatricula($filtro){

     return $this->where([
            ['ativada',1],
            ['codg_matr', $filtro]
            ])
            ->orWhereHas('aluno', function ($query) use ($filtro){
                $query->where('alunos.nome_aluno', 'LIKE', "%{$filtro}%");
                $query->where('ativada', 1);
            })
            ->orWhereHas('plano', function ($query) use ($filtro){
                $query->where('planos.nome_plan', 'LIKE', "%{$filtro}%");
                $query->where('ativada', 1);
            })->paginate(15);
    }


    public function getCodigoControle()
    {
        $codigo = DB::table('matriculas as m')
            ->join('academias as a', 'm.academia_id', 'a.id')
            ->where('a.id', \Auth::user()->academia_id)
            ->max('codg_matr');

        if (!isset($codigo))
            $codigo = 1;
        else
            $codigo += 1;

        return $codigo;
    }
}
