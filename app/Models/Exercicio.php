<?php

namespace App\Models;

use App\Scopes\TenantModels;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Exercicio extends Model
{
    use TenantModels;

    protected $fillable = [
        'academia_id',
        'codg_exrc',
        'nome_exrc'
    ];

    public function treinos(){
        return $this->belongsToMany('App\Models\Treino','treino_exercicios');
    }

    public function getCodigoControle()
    {
        $codigo = DB::table('exercicios as ex')
        ->join('academias as a', 'ex.academia_id', 'a.id')
        ->where('a.id', \Auth::user()->academia_id)
        ->max('codg_exrc');

        if (!isset($codigo))
            $codigo = 1;
        else
            $codigo += 1;

        return $codigo;
    }

    public function setCodgExrcAttribute($value){
      if($value == 0 || $value == ''){
        $codigo = DB::table('exercicios as ex')
        ->join('academias as a', 'ex.academia_id', 'a.id')
        ->where('a.id', \Auth::user()->academia_id)
        ->max('codg_exrc');
        if (!isset($codigo)){
            $codigo = 1;
        }
        else{
            $codigo += 1;
        }
          $this->attributes['codg_exrc'] = $codigo;
      }
    }


}
