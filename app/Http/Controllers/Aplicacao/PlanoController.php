<?php

namespace App\Http\Controllers\Aplicacao;

use App\Http\Requests\PlanoRequest;
use App\Models\Plano;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class PlanoController extends Controller
{
    private $plano;


    public function __construct(Plano $plano)
    {
        $this->plano = $plano;
    }

    public function index(Request $request)
    {
        $filtro = $request->get('filtro');
        if ($filtro == null) {

            $codigo = $this->plano->getCodigoControle();
            $planos = $this->plano->all();

            return view('app.plano.index', compact('planos', 'codigo'));
        }else{
            $codigo = $this->plano->getCodigoControle();

            $planos = $this->plano->where('codg_plan', 'like', '%'.$filtro.'%')
                                    ->orWhere('nome_plan','like', '%'.$filtro.'%')
                                    ->orderBy('nome_plan')->paginate(10);

            return view('app.plano.index', compact('planos', 'codigo'));
        }
    }

    public function create()
    {
        $codigo = $this->plano->getCodigoControle();

        return view('app.plano.create-edit',compact('codigo'));
    }

    public function store(PlanoRequest $request)
    {
        $dataForm = $request->all();

        if($dataForm){
            $this->plano->create($dataForm);
            return redirect()->route('plano');
        }else{
            return redirect()->back();
        }
    }


    public function edit($id)
    {
        $planos = $this->plano->all();
        $plano = $this->plano->find($id);
        return view('app.plano.index',compact('plano','planos'));
    }

    public function update(PlanoRequest $request, $id)
    {
        $plano = $this->plano->find($id);
        if(!$plano){
            return redirect()->back();
        }

        if ($plano->update($request->all())){
            return redirect()->route('plano');
        }else{
            return redirect()->back();
        }
    }

    public function destroy($id)
    {

        try{
            $plano = $this->plano->find($id);
            $plano->delete();
            flash()->overlay('Registro removido com sucesso!','Sucesso');
            return redirect()->route('plano');
        }catch (QueryException $e){
            flash()->overlay('Este registro não pode ser excluido, pois está sendo usado!','Sucesso!');
             return redirect()->back();
        }

    }
}
