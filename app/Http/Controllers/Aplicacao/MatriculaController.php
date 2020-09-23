<?php

namespace App\Http\Controllers\Aplicacao;

use App\Http\Requests\MatriculaRequest;
use App\Models\Aluno;
use App\Models\Carne;
use App\Models\Matricula;
use App\Models\Mensalidade;
use App\Models\Plano;
use App\Models\Treino;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class MatriculaController extends Controller
{
    private $matricula;

    public function __construct(Matricula $matricula)
    {
        $this->matricula = $matricula;
    }

    public function index(Request $request)
    {
        $filtro = $request->get('filtro');

        if ($filtro == null){
            $codigo = $this->matricula->getCodigoControle();

            $planos = Plano::pluck('nome_plan', 'id');
            $alunos = Aluno::where('stts_aluno', 'I')->pluck('nome_aluno', 'id');

            // listando somente as matriculas ativas
            $matriculas = $this->matricula->where('ativada',1)->paginate(15);

            return view('app.matricula.index', compact('matriculas', 'alunos', 'planos', 'codigo'));

        }else{
            $codigo = $this->matricula->getCodigoControle();

            $planos = Plano::pluck('nome_plan', 'id');
            $alunos = Aluno::where('stts_aluno', 'I')->pluck('nome_aluno', 'id');

            $matriculas = $this->matricula->listaMatricula($filtro);

            return view('app.matricula.index', compact('matriculas', 'alunos', 'planos', 'codigo'));
        }

    }

    public function create()
    {
        $codigo = $this->matricula->getCodigoControle();

        $planos = Plano::pluck('nome_plan', 'id');
        $alunos = Aluno::where('stts_aluno', 'I')->pluck('nome_aluno', 'id');

        return view('app.matricula.create-edit', compact('planos', 'alunos', 'codigo'));
    }

    public function store(MatriculaRequest $request)
    {
        try {
            $dataForm = $request->all();
            if ($dataForm) {
                $a_id = $request->aluno_id;

                if ($return = $this->matricula->create($dataForm)) {

                    // pegando o ultimo id inserido
                    $m_id = $return['id'];

                    // ativa o aluno apos criar
                    DB::table('alunos as a')->where('a.id', $a_id)->update(['stts_aluno' => 'A']);

                    // ativando a matricula
                    DB::table('matriculas as m')->where('m.id', $m_id)->update(['ativada' => 1]);
                }
                flash()->overlay('Matricula gerada com Sucesso. Aluno foi Ativado', 'Sucesso!');
                return redirect()->route('matricula');
            }
        } catch (Exception $exception) {
            flash()->overlay('Falha a o gerar a matrícula ' . $exception, 'Atenção!');
            return redirect()->back();
        }
    }

    /*
     *  NÃO FAÇO MAIS A EDIÇÃO
    public function edit($id)
    {
        $matricula = $this->matricula->find($id);

        $matriculas = $this->matricula->paginate(15);

        $planos = Plano::pluck('nome_plan', 'id');

        $alunos = Aluno::pluck('nome_aluno', 'id');
        return view('app.matricula.index', compact('matricula', 'alunos', 'planos', 'matriculas'));
    }
    */

    public function update(MatriculaRequest $request, $id)
    {
        $matricula = $this->matricula->find($id);
        if (!$matricula) {
            return redirect()->back();
        } elseif ($matricula->update($request->all())) {
            return redirect()->route('matricula');
        } else {
            return redirect()->back();
        }
    }

    public function remove(Request $request)
    {
        $data = $request->all();

        if ($data) {

            $idMatricula = $data['Matricula_id'];
             $idAluno    = $data['aluno_id'];

            //PEGANDO O ID DO CARNE
            $carne = DB::table('matriculas as m')->select('c.id')
                    ->join('carnes as c', 'm.id','=' ,'c.matricula_id')
                    ->where([
                        ['m.id', $idMatricula],
                        ['m.academia_id', \Auth::user()->academia_id]
                    ])->get();

            //FOREACH PARA SEPARAR O ID DO ARRAY
            foreach ($carne as $c) {
                $idcarne = $c->id;
            }

            // SELECIONANDO AS MENSALIDADES QUE NÃO FORAM PAGAS AINDA E APOS REMOVENDO.
            Mensalidade::where([
                ['carne_id', $idcarne],
                ['quitada','0'],
            ])->delete();

            // REMOVENDO OS TREINOS DESTA MATRICULA
            Treino::where([
                ['matricula_id', $idMatricula],
            ])->delete();

            //INATIVANO O ALUNO
            DB::table('alunos as a')->where('a.id', $idAluno)->update(['stts_aluno' => 'I']);

            //INATIVANDO A MATRICULA
            DB::table('matriculas as m')->where('m.id',$idMatricula)->update(['ativada' => 0]);

            flash()->overlay('Matricula removida com sucesso Aluno foi Desativado!', 'Atenção');
            return redirect()->route('matricula');
        } else {
            flash()->overlay('Este registro não pode ser removido pois está sendo usado!', 'Atenção!')->error();
            return redirect()->back();
        }

    }


}
