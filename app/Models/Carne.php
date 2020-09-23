<?php

namespace App\Models;

use App\Scopes\TenantModels;
use Illuminate\Database\Eloquent\Model;

class Carne extends Model
{
    use TenantModels;

    protected $fillable = [
        'valr_totl',
        'numr_parc',
        'matricula_id',
        'academia_id'

    ];

    public function matricula()
    {
        return $this->belongsTo(Matricula::class);
    }
}
