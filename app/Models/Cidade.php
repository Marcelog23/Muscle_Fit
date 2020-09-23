<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cidade extends Model
{

    protected $fillable = [
        'nome_cidd',
        'estado_id'
    ];

    public function alunos()
    {
        return $this->hasMany('App\Models\Aluno');
    }

    public function academia()
    {
        return $this->hasMany(Academia::class);
    }


    public function perosnal()
    {
        return $this->hasMany('App\Models\Personal');
    }

    
}
