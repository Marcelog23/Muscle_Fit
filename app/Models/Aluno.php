<?php

namespace App\Models;

use App\Scopes\TenantModels;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Aluno extends Model
{

    use TenantModels;

    protected $fillable = [
        'codg_aluno',
        'genr_aluno',
        'stts_aluno',
        'nome_aluno',
        'data_nasc',
        'endr_aluno',
        'email_aluno',
        'cep_aluno',
        'numr_endr',
        'telf_aluno',
        'cpf_aluno',
        'rg_aluno',
        'leso_aluno',
        'remd_aluno',
        'objt_aluno',
        'cidade_id',

    ];

    public function getAlunos($filtro)
    {
        if ($filtro == null) {

            return $this->paginate(15);

        } else {
            return $this->where('codg_aluno', '=', $filtro)
                ->orWhere('nome_aluno', 'LIKE', '%' . $filtro . '%')
                ->orWhere('cpf_aluno', 'LIKE', '%' . $filtro . '%')
                ->paginate(15);

        }
    }


    public function cidade()
    {
        return $this->belongsTo('App\Models\Cidade');
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

    public function setCpfAlunoAttribute($value)
    {
        $this->attributes['cpf_aluno'] = preg_replace('/[^0-9]/', "", $value);
    }

    public function setRgAlunoAttribute($value)
    {
        $this->attributes['rg_aluno'] = preg_replace('/[^0-9]/', "", $value);
    }

    public function setCepAlunoAttribute($value)
    {
        $this->attributes['cep_aluno'] = preg_replace('/[^0-9]/', "", $value);
    }

    public function setTelfAlunoAttribute($value)
    {
        $this->attributes['telf_aluno'] = preg_replace('/[^0-9]/', "", $value);
    }

    public function getCpfAlunoFormattedAttribute()
    {
        $value = $this->cpf_aluno;
        if (!empty($value)) {
            $value = preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $value);
            return $value;
        }
    }

    public function getTelfAlunoFormattedAttribute()
    {
        $value = $this->telf_aluno;
        if (strlen($value) == 10 ){
            $value = preg_replace('/(\d{2})(\d{4})(\d{4})/','($1) $2-$3',$value);
            return $value;
        }elseif (strlen($value) == 11 ){
            $value = preg_replace('/(\d{2})(\d{1})(\d{4})(\d{4})/','($1) $2.$3-$4',$value);
            return $value;
        }
    }

    public function getGenrAlunoFormattedAttribute()
    {
        $value = $this->genr_aluno;
        return $value == 'M' ? 'MASCULINO' : 'FEMININO';
    }

    public function getCodigoControle()
    {
        $codigo = DB::table('alunos as al')->join('academias as a', 'al.academia_id', 'a.id')->where('a.id', \Auth::user()->academia_id)->max('codg_aluno');

        if (!isset($codigo))
            $codigo = 1;
        else
            $codigo += 1;

        return $codigo;
    }

}
