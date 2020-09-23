<?php

namespace App\Models;

use App\Scopes\TenantModels;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Plano extends Model
{
    use TenantModels;

    protected $fillable = [
        'codg_plan',
        'nome_plan',
        'valr_plan',
        'peri_plan',
        'academia_id'
    ];


    public function matricula()
    {
        return $this->hasMany('App\Models\matricula');
    }


    public function getCodigoControle()
    {
        $codigo = DB::table('planos as p')->join('academias as a', 'p.academia_id', 'a.id')
            ->where('a.id', \Auth::user()->academia_id)
            ->max('codg_plan');

        if (!isset($codigo))
            $codigo = 1;
        else
            $codigo += 1;

        return $codigo;
    }


    public function setNomePlanAttibute($value)
    {
        $this->attributes['nome_plan'] = strtolower($value);
    }

    public function getNomePlanAttibute($value)
    {
        return ucwords($value);
    }

}
