<?php

namespace App\Http\Controllers\Aplicacao;

use App\Http\Requests\ExercicioRequest;
use App\Models\Exercicio;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ExercicioController extends Controller
{

    private $exercicio;

    public function __construct( Exercicio $exercicio)
    {
        $this->exercicio = $exercicio;
    }


    public function index(Request $filtro)
    {
        $filtragem = $filtro->get('filtro');

        if($filtragem == null) {

            $codigo = $this->exercicio->getCodigoControle();

            $exercicios = $this->exercicio->orderBy('nome_exrc')->paginate(10);

            return view('app.exercicio.index', compact('exercicios','codigo'));
        } else{

            $codigo = $this->exercicio->getCodigoControle();

            $exercicios = $this->exercicio->where('nome_exrc', 'like', '%'.$filtragem.'%')
                                          ->orWhere('codg_exrc','like', '%'.$filtragem.'%')
                                           ->orderBy('nome_exrc')->paginate(10);

            return view('app.exercicio.index', compact('exercicios','codigo'));
        }

    }

    public function create()
    {
        $codigo = $this->exercicio->getCodigoControle();

        return view('app.exercicio.create-edit');
    }



    public function store(ExercicioRequest $request)
    {
        $dataForm = $request->all();
        if ($this->exercicio->create($dataForm)){
            //return redirect()->route('exercicio');
            return response()->json(['success'=>'true']);
        }else{
            //return redirect()->back();
            return response()->json(['success'=>'false']);
        }
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
      /*
        $exercicios = $this->exercicio->paginate(10);

        $exer = $this->exercicio->find($id);
        if($exer){
            return view('app.exercicio.index', compact('exer','exercicios'));
        }else{
            return redirect()->back();
        }
        */
        $exer = $this->exercicio->findOrFail($id);

        return response()->json($exer);



    }


    public function update(ExercicioRequest $request, $id)
    {
        $exercicio = $this->exercicio->findOrFail($id);
        if ($exercicio->update($request->all())){
            //flash()->overlay('Registro alterado com sucesso!','Sucesso!');
            return response()->json(['success'=>'true']);
        }else{
            return response()->json(['success'=>'false']);
        }
    }


    public function destroy($id)
    {
        try{
            $exercicio = $this->exercicio->find($id);
            $exercicio->delete();
            flash()->overlay('Registro removido com sucesso!','Atenção');
            return redirect()->route('exercicio');
        }catch (QueryException $e){
            flash()->overlay('Este registro não pode ser excluido, pois está sendo usado!','Atenção');
            return redirect()->back();
        }
    }

    public function getExercicios()
    {
        $exercicios = $this->exercicio->paginate(10);
        return response()->json($exercicios);
    }
}
