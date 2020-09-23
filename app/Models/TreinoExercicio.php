<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TreinoExercicio extends Model
{
    public $timestamps = false;

    protected $fillable = [

        'treino_id',
        'exercicio_id',
        'numr_rept',
        'numr_sers',
        'temp_intv',

    ];

}
