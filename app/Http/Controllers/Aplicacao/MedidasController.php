<?php

namespace App\Http\Controllers\Aplicacao;

use App\Http\Requests\MedidasRequest;
use App\Models\Aluno;

use App\Models\Cidade;

use App\Models\Matricula;
use App\Models\Medida;
use App\Models\Personal;
use function foo\func;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class MedidasController extends Controller
{

    private $medidas;

    public function __construct(Medida $medidas)
    {
        $this->medidas = $medidas;
    }


    public function index(Request $request)
    {
        $filtro = $request->get('filtro');

        $medidas = $this->medidas->listaMedidas($filtro);

        return view('app.medidas.index', compact('medidas'));
    }



    public function create()
    {
        $codigo = $this->medidas->getCodigoControle();

        $matricula = matricula::select(DB::raw("CONCAT(id, ' - ', (select nome_aluno from alunos where id = aluno_id)) as descr, id"))->pluck('descr', 'id');

        $personal = Personal::pluck('nome_pers','id');

        return view('app.medidas.create-edit', compact('codigo','matricula','personal'));
    }


    public function store(MedidasRequest $request)
    {
        $dataForm = $request->all();

        if ($dataForm){
            $this->medidas->create($dataForm);
            return redirect()->route('medida');
        }else{
            return redirect()->back();
        }
    }


    public function edit($id)
    {
        $personal = Personal::pluck('nome_pers','id');

        $matricula = matricula::select(DB::raw("CONCAT(id, ' - ', (select nome_aluno from alunos where id = aluno_id)) as descr, id"))->pluck('descr', 'id');

        $medidas  = $this->medidas->find($id);

        if($medidas){
            return view('app.medidas.create-edit', compact('medidas','matricula','personal'));
        }else{
            return redirect()->back();
        }
    }


    public function update(MedidasRequest $request, $id)
    {
        $medidas = $this->medidas->find($id);

        if(!$medidas){
            return redirect()->back();
        }

        if ($medidas->update($request->all())){
            return redirect()->route('medida');
        }else{
            return redirect()->back();
        }
    }


    public function destroy($id)
    {
        try{
            $medidas = $this->medidas->find($id);
            $medidas->delete();
            flash()->overlay('Registro removido com sucesso!','Atenção');
            return redirect()->route('medida');
        }catch (QueryException $e){
            flash()->overlay('Este registro não pode ser excluido, pois está sendo usado!','Atenção');
            return redirect()->back();
        }
    }


    public function listaMedidas($id)
    {
        $medidas = DB::table('medidas as m')
            ->select('m.*','a.nome_aluno','p.nome_pers')
            ->join('personals as p','m.personal_id','p.id')
            ->join('matriculas as ma','m.matricula_id','ma.id')
            ->join('alunos as a','ma.aluno_id','a.id')
            ->where([
                ['m.id', $id],
                ['m.academia_id', \Auth::user()->academia_id]
            ])
            ->get();

        //dd($medidas);

        foreach ($medidas as $medida) {
            $aluno = $medida->nome_aluno;
            $personal = $medida->nome_pers;

        }

        // DADOS DA ACADEMIA
        $academia = DB::table('academias as a')
            ->select('a.nome_fant','a.endr_acade','a.telf_acade','a.email_acade','a.cnpj_acade')
            ->where('a.id', \Auth::user()->academia_id)
            ->get();

        return \PDF::loadView('app.medidas.listaMedidas', compact('medidas','aluno', 'personal', 'academia'))
            ->stream($aluno.'.pdf');
    }
}
