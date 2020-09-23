<?php

namespace App\Models;

use App\Scopes\TenantModels;
use Illuminate\Database\Eloquent\Model;

class FormaPagamento extends Model
{

    protected $fillable = [

        'nome_fopg',
        'sigl_fopg',
        'academia_id'
    ];


    public function academia()
    {
        return $this->hasOne('App\Models\Academia');
    }

    public function pagamentos()
    {
        return $this->hasMany('App\Models\Pagamento');
    }

}
