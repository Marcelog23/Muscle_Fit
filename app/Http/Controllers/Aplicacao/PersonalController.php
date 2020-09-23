<?php

namespace App\Http\Controllers\Aplicacao;

use App\Http\Requests\PersonalRequest;
use App\Models\Cidade;
use App\Models\Personal;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class PersonalController extends Controller
{
    private $personal;

    public function __construct(Personal $personal)
    {
        $this->personal = $personal;
    }


    public function index(Request $request)
    {
        $filtro = $request->get('filtro');
        if ($filtro == null){

            $personal = $this->personal->all();
            return view('app.personal.index', compact('personal'));

        }else{
            $personal = $this->personal->where('codg_pers', 'LIKE', '%'.$filtro.'%')
                ->orWhere('nome_pers', 'LIKE', '%'.$filtro.'%')
                ->orWhere('cpf_pers', 'LIKE', '%'.$filtro.'%')
                ->paginate(15);

            return view('app.personal.index', compact('personal'));
        }
    }

    public function create()
    {

        $codigo = $this->personal->getCodigoControle();

        $genero = $this->personal->genero();
        $cidades = Cidade::pluck('nome_cidd','id')->prepend('Selecione');

        return view('app.personal.create-edit', compact('cidades','codigo','genero'));
    }

    public function store(PersonalRequest $request)
    {
        $dataForm = $request->all();

        if ($dataForm) {
            $this->personal->create($dataForm);
            return redirect()->route('personal');
        }else{
            return redirect()->back();
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $genero = $this->personal->genero();
        $cidades = Cidade::pluck('nome_cidd','id')->prepend('Selecione');
        $personal = $this->personal->find($id);
        if($personal){
            return view('app.personal.create-edit', compact('personal','cidades','genero'));
        }else{
            return redirect()->back();
        }
    }


    public function update(PersonalRequest $request, $id)
    {
        $personal = $this->personal->find($id);
        if(!$personal){
            return redirect()->back();
        }

        if ($personal->update($request->all())){
            return redirect()->route('personal');
        }else{
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        try{
            $personal = $this->personal->findOrFail($id);
            $personal->delete();
            flash()->overlay('Registro removido com sucesso!','Atenção');
            return redirect()->route('personal');
        }catch (QueryException $e){
            flash()->overlay('Este registro não pode ser excluido, pois está sendo usado!','Atenção');
            return redirect()->back();
        }
    }
}
