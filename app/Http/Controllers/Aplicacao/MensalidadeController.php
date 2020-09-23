<?php

namespace App\Http\Controllers\Aplicacao;

use App\Models\FormaPagamento;
use App\Models\Mensalidade;
use App\Models\Pagamento;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MensalidadeController extends Controller
{

    private $mensalidade;

    public function __construct(Mensalidade $mensalidade)
    {
        $this->mensalidade = $mensalidade;
    }


    public function index(Request $request)
    {
        $filtro = $request->get('filtro');

        $mensalidades = $this->mensalidade->listaMensalidades($filtro);

        return view('app.mensalidade.index', compact('mensalidades'));
    }


    public function show($codigo)
    {
        $formas = FormaPagamento::pluck('nome_fopg','id');

        $aluno = $this->mensalidade->listaNomeAluno($codigo);

        $mensalidades = $this->mensalidade->listaParcelas($codigo);

        return view('app.mensalidade.show', compact('mensalidades','formas','aluno'));
    }



    public function receber(Request $request){

        $data = $request->all();

        if ($data){
            $id    = $data['idMensalidade'];
            $saldo = $data['saldo_mensa'];
            $forma = $data['forma_pagamento_id'];

            $codigo = $this->mensalidade->getCodigoControle();

            Pagamento::create([
                'codg_pagt'          => $codigo,
                'data_pagt'          => \Carbon\Carbon::now(),
                'valr_pagt'          => $saldo,
                'mensalidade_id'     => $id,
                'forma_pagamento_id' => $forma
            ]);
        }
        flash()->overlay('Mensalidade recebida com sucesso!','Sucesso!');
        return redirect()->back();

    }


}
