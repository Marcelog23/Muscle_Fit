<?php

namespace App\Models;

use App\Scopes\TenantModels;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Academia extends Model
{

    protected $fillable = [
        'razao_social',
        'nome_fant',
        'endr_acade',
        'compl_endr',
        'telf_acade',
        'email_acade',
        'numr_acade',
        'cep_acade',
        'cnpj_acade',
        'cidade_id',
    ];

    public function cidade()
    {
        return $this->belongsTo(Cidade::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function setCnpjAcadeAttribute($value)
    {
        $this->attributes['cnpj_acade'] = preg_replace('/[^0-9]/', "", $value);
    }

    public function setCepAcadeAttribute($value)
    {
        $this->attributes['cep_acade'] = preg_replace('/[^0-9]/', "", $value);
    }

    public function setTelfAcadeAttribute($value)
    {
        $this->attributes['telf_acade'] = preg_replace('/[^0-9]/', "", $value);
    }


    public function getTelfAcadeFormattedAttribute()
    {
        $value = $this->telf_acade;
        if (strlen($value) == 10 ){
            $value = preg_replace('/(\d{2})(\d{4})(\d{4})/','($1) $2-$3',$value);
            return $value;
        }elseif (strlen($value) == 11 ){
            $value = preg_replace('/(\d{2})(\d{1})(\d{4})(\d{4})/','($1) $2.$3-$4',$value);
            return $value;
        }
    }

    public function getCnpjAcadeFormattedAttribute()
    {
        $value = $this->cnpj_acade;
        if (!empty($value)) {
            $value = preg_replace('/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/', '$1.$2.$3.$4-$5', $value);
            return $value;
        }
    }

    public function getAcademia()
    {
        return DB::table('academias as a')->select('a.id','a.razao_social','a.nome_fant','a.endr_acade','a.compl_endr','a.telf_acade','a.email_acade','a.cnpj_acade')
            ->join('users as u','a.id','u.academia_id')
            ->where('a.id',\Auth::user()->academia_id)->get();
    }

}
