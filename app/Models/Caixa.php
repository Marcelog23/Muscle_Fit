<?php

namespace App\Models;

use App\Scopes\TenantModels;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Caixa extends Model
{
    use TenantModels;

    protected $fillable = [
        'codg_caixa',
        'desc_caixa',
        'valr_pagt',
        'data_pagt',
        'tipo_lanc',
        'academia_id',
    ];

    public function academia()
    {
        return $this->hasOne('App\Models\Academia');
    }


    public function getDataPagtFormattedAttribute()
    {
        $value = $this->data_pagt;
        return formatDateAndTime($value, 'd/m/Y');
    }

/*
    public function setDataPagtAttribute($value)
    {
        if ($value == '' || null)
            $value = \Carbon\carbon::now();
        $this->attributes['data_pagt'] = $value;
    }

    public function setTipoLancAttribute($value)
    {
        if ($value == '' || null)
            $value = 'S';
        $this->attributes['tipo_lanc'] = $value;
    }
*/

    public function setCodgCaixaAttribute()
    {
        $codigo = DB::table('caixas as cx')
            ->join('academias as a', 'cx.academia_id', 'a.id')
            ->where('a.id', \Auth::user()->academia_id)
            ->max('codg_caixa');

        if (!isset($codigo))
            $codigo = 1;
        else
            $codigo += 1;

        $this->attributes['codg_caixa'] = $codigo;
    }
/*
    public function setValrPagtAttribute($value)
    {
        $this->attributes['valr_pagt'] = preg_replace('/[^0-9]/',"",$value);
    }
*/
}
