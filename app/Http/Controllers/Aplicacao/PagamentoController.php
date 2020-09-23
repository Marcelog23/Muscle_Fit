<?php

namespace App\Http\Controllers\Aplicacao;

use App\Models\Pagamento;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class PagamentoController extends Controller
{
    private $pagamento;

    public function __construct(Pagamento $pagamento)
    {
        $this->pagamento = $pagamento;
    }

    public function index(Request $request)
    {
        $filtro = $request->get('filtro');

        $pagamentos = $this->pagamento->getPagamentos($filtro);

        return view('app.pagamento.index', compact('pagamentos'));
    }

    public function destroy($id)
    {
        $pagamento = $this->pagamento->find($id);

        if ($pagamento) {
            $pagamento->delete();
        }
        flash()->overlay('Pagamento estornado com sucesso!','Sucesso!');
        return redirect()->back();
    }


}
