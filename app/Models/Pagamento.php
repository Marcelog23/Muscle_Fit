<?php

namespace App\Models;

use App\Scopes\TenantModels;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pagamento extends Model
{

    use TenantModels;

    protected $fillable = [
        'codg_pagt',
        'data_pagt',
        'valr_pagt',
        'academia_id',
        'mensalidade_id',
        'forma_pagamento_id'
    ];


    public function academia()
    {
        return $this->hasOne('App\Models\Academia');
    }

    public function mensalidade()
    {
        return $this->belongsTo(Mensalidade::class);
    }

    public function formaPagamento()
    {
        return $this->belongsTo(FormaPagamento::class);
    }

    public function getPagamentos($filtro)
    {
        if ($filtro == null) {

            return DB::table('pagamentos as p')->select('p.id', 'p.codg_pagt', 'p.data_pagt', 'p.valr_pagt', 'a.nome_aluno', 'f.nome_fopg')
                ->join('forma_pagamentos as f', 'p.forma_pagamento_id', 'f.id')
                ->join('mensalidades as m', 'p.mensalidade_id', 'm.id')
                ->join('carnes as c', 'm.carne_id', 'c.id')
                ->join('matriculas as ma', 'c.matricula_id', 'ma.id')
                ->join('alunos as a', 'ma.aluno_id', 'a.id')
                ->where([
                    ['p.academia_id', \Auth::user()->academia_id]
                ])
                ->paginate();


        } else {
            return DB::table('pagamentos as p')->select('p.id', 'p.codg_pagt', 'p.data_pagt', 'p.valr_pagt', 'a.nome_aluno', 'f.nome_fopg')
                ->join('forma_pagamentos as f', 'p.forma_pagamento_id', 'f.id')
                ->join('mensalidades as m', 'p.mensalidade_id', 'm.id')
                ->join('carnes as c', 'm.carne_id', 'c.id')
                ->join('matriculas as ma', 'c.matricula_id', 'ma.id')
                ->join('alunos as a', 'ma.aluno_id', 'a.id')
                ->where([
                    ['p.academia_id', \Auth::user()->academia_id],
                    ['p.codg_pagt', $filtro]
                ])
                ->orWhere([
                    ['p.academia_id', \Auth::user()->academia_id],
                    ['a.nome_aluno', 'LIKE', "%{$filtro}%"]
                ])
                ->paginate();
        }
    }


    public function getDataPagtFormattedAttribute()
    {
        $value = $this->data_pagt;
        return formatDateAndTime($value, 'd/m/Y');
    }

}
