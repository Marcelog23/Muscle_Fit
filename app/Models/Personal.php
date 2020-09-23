<?php

namespace App\Models;

use App\Scopes\TenantModels;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Personal extends Model
{
    use TenantModels;

    protected $fillable = [
        'codg_pers',
        'nome_pers',
        'data_nasc',
        'endr_pers',
        'numr_endr',
        'telf_pers',
        'cpf_pers',
        'rg_pers',
        'cep_pers',
        'email_pers',
        'forma_acad',
        'obsr_pers',
        'cidade_id',
        'academia_id',
    ];

    public function cidade()
    {
        return $this->belongsTo('App\Models\Cidade');
    }

    public function academia()
    {
        return $this->belongsTo('App\Models\Academia');
    }


    public function genero($sexo = null)
    {
        $genero = [
            'M' => 'Masculino',
            'F' => 'Feminino'
        ];

        if (!$sexo)
            return $genero;
        return $genero[$sexo];
    }



    public function setCpfPersAttribute($value)
    {
        $this->attributes['cpf_pers'] = preg_replace('/[^0-9]/', '', $value);
    }
    public function setRgPersAttribute($value)
    {
        $this->attributes['rg_pers'] = preg_replace('/[^0-9]/', '', $value);
    }
    public function setCepPersAttribute($value)
    {
        $this->attributes['cep_pers'] = preg_replace('/[^0-9]/',"",$value);
    }
    public function setTelfPersAttribute($value)
    {
        $this->attributes['telf_pers'] = preg_replace('/[^0-9]/',"",$value);
    }
    public function getTelfPersFormattedAttribute(){
        $value = $this->telf_pers;
        if (strlen($value) == 10 ){
            $value = preg_replace('/(\d{2})(\d{4})(\d{4})/','($1) $2-$3',$value);
            return $value;
        }elseif (strlen($value) == 11 ){
            $value = preg_replace('/(\d{2})(\d{1})(\d{4})(\d{4})/','($1) $2.$3-$4',$value);
            return $value;
        }
    }


    public function getCpfPersFormattedAttribute(){
        $value = $this->cpf_pers;
        if(!empty($value)){
            $value = preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $value);
            return $value;
        }
    }

    public function getCodigoControle()
    {
        $codigo =  DB::table('personals as p')->join('academias as a', 'p.academia_id', 'a.id')->where('a.id', \Auth::user()->academia_id)->max('codg_pers');

        if (!isset($codigo))
            $codigo = 1;
        else
            $codigo += 1;

        return $codigo;
    }
}
