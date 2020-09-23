<?php

namespace App\Http\Controllers\Aplicacao;

use App\Models\Aluno;
use App\Models\Exercicio;
use App\Models\matricula;
use App\Models\Treino;
use App\Models\TreinoExercicio;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Validator;

class TreinoController extends Controller
{
    private $treino;

    public function __construct(Treino $treino)
    {
        $this->treino = $treino;
    }

    public function index(Request $request)
    {
        $filtro = $request->get('filtro');
        $treinos = $this->treino->getTreinos($filtro);

        return view('app.treino.index', compact('treinos'));
    }

    public function create()
    {
        $codigo = $this->treino->codigoControle();

        $listaExer = Exercicio::all();

        $matricula = Matricula::select(DB::raw("CONCAT(id, ' - ', (select nome_aluno from alunos where id = aluno_id)) as descr, id"))->where('ativada', 1)->pluck('descr', 'id');


        return view('app.treino.create-edit', compact('matricula', 'codigo', 'listaExer'));
    }

    public function store(Request $request)
    {
        $treino = $request->all();
        if ($treino['dia_sema'] == null){
            flash()->overlay('Você deve selecionar pelo menos um Dia da Semana!', 'Atenção!');
            return redirect()->back();
        }

        $treino = $this->treino->create($treino);

        //popula os exercicios
        $exercicio = $request->get('exercicios');
        $repeticao = $request->get('numr_rept');
        $serie     = $request->get('numr_sers');
        $intervalo = $request->get('temp_intr');


        if ($exercicio == null and $repeticao == null and $serie == null and $intervalo == null){
            flash()->overlay('Você deve selecionar pelo menos um Exercício e preencher os campos!', 'Atenção!');
            return redirect()->back();

        }


        foreach ($exercicio as $key => $value) {
            TreinoExercicio::create(['treino_id' => $treino->id, 'exercicio_id' => $exercicio[$key],
                'numr_rept' => $repeticao[$key], 'numr_sers' => $serie[$key], 'temp_intv' => $intervalo[$key]
            ]);
        }

        // return redirect()->route('treino');
        return redirect()->back();
    }

    // lista os treinos pelo dia da semana
    public function show($matricula_id)
    {
        $treinos = $this->treino->getTreinosAluno($matricula_id);

        foreach ($treinos as $treino) {
            $nome = $treino->nome_aluno;
        }
        return view('app.treino.show', compact('treinos', 'nome'));
    }

    public function edit($id)
    {
        $diaSemana = $this->treino->diaSemana();

        $listaExer = Exercicio::all();

        $matricula = matricula::select(DB::raw("CONCAT(id, ' - ', (select nome_aluno from alunos where id = aluno_id)) as descr, id"))->pluck('descr', 'id');

        $treino = $this->treino->find($id);

        $exerEdit = $treino->exercicios;

        //usada para bloquear o campo da matricula/aluno
        $edit = true;
        return view('app.treino.create-edit', compact('treino', 'exerEdit', 'matricula', 'diaSemana', 'listaExer', 'edit'));
    }

    public function update(Request $request, $id)
    {
        $treino = $this->treino->find($id);
        $treino->update($request->all());

        $exercicio = $request->get('exercicios');
        $repeticao = $request->get('numr_rept');
        $serie = $request->get('numr_sers');
        $intervalo = $request->get('temp_intr');


        DB::table('treino_exercicios')->where('treino_id', $treino['id'])->delete();

        foreach ($exercicio as $key => $value) {

            TreinoExercicio::create(['treino_id' => $treino->id, 'exercicio_id' => $exercicio[$key],
                'numr_rept' => $repeticao[$key], 'numr_sers' => $serie[$key], 'temp_intv' => $intervalo[$key]
            ]);

        }
        flash()->overlay('Registro atualizado com sucesso!', 'Sucesso!');
        return redirect()->route('treino');
    }

    public function destroy($id)
    {
        try {
            $treino = $this->treino->find($id);
            $treino->delete();
            flash()->overlay('Registro removido com sucesso!', 'Sucesso!');
            return redirect()->back();
        } catch (QueryException $e) {
            flash()->overlay('Este registro não pode ser removido pois está sendo usado!', 'Atenção!')->error();
            return redirect()->back();
        }
    }


    // metodo traz os dias das semanas referente a matricula
    public function getDiaSemana($matricula_id)
    {
         $diaSemana = DB::table('treinos as t')
             ->select('dia_sema')
            ->join('treino_exercicios as te', 't.id', 'te.treino_id')
            ->where([
                ['t.matricula_id', $matricula_id],
                ['t.academia_id', \Auth::user()->academia_id]
            ])->distinct()
             ->get();

        return $diaSemana;
    }




    //gera o pdf
    public function listaTreino($matricula_id)
    {
      $treinos = DB::table('treinos as t')
            ->select('t.id', 't.codg_trno', 't.matricula_id', 't.dia_sema', 'te.numr_rept', 'te.numr_sers', 'te.temp_intv', 'e.nome_exrc', 'a.nome_aluno')
            ->join('treino_exercicios as te', 't.id', 'te.treino_id')
            ->join('exercicios as e', 'te.exercicio_id', 'e.id')
            ->join('matriculas as m', 't.matricula_id', 'm.id')
            ->join('alunos as a', 'm.aluno_id', 'a.id')
            ->where([
                ['t.matricula_id', $matricula_id],
                ['t.academia_id', \Auth::user()->academia_id]
            ])
          ->groupBy('t.id', 't.codg_trno', 't.matricula_id', 't.dia_sema', 'te.numr_rept', 'te.numr_sers', 'te.temp_intv', 'e.nome_exrc', 'a.nome_aluno')
          ->orderBy('t.dia_sema')
          ->get();

        foreach ($treinos as $treino) {
            $aluno = $treino->nome_aluno;
        }

        // DADOS DA ACADEMIA
        $academia = DB::table('academias as a')
            ->select('a.nome_fant','a.endr_acade','a.telf_acade','a.email_acade','a.cnpj_acade')
            ->where('a.id', \Auth::user()->academia_id)->get();


        return \PDF::loadView('app.treino.listaTreino', compact('treinos','aluno','academia'))
            ->setPaper('a4','landscape')
            ->stream($aluno.'.pdf');

    }


}
