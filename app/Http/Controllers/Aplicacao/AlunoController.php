<?php

  namespace App\Http\Controllers\Aplicacao;

  use App\Http\Requests\AlunoRequest;
  use App\Models\Aluno;
  use App\Models\Cidade;
  use Illuminate\Database\QueryException;
  use Illuminate\Http\Request;
  use App\Http\Controllers\Controller;
  use Illuminate\Support\Facades\DB;

  class AlunoController extends Controller
  {
    private $aluno;

    public function __construct(Aluno $aluno)
    {
      $this->aluno = $aluno;
    }


    public function index(Request $request)
    {
      $filtro = $request->get('filtro');

      $alunos = $this->aluno->getAlunos($filtro);

      return view('app.aluno.index', compact('alunos'));
    }


    public function create()
    {
      $codigo = $this->aluno->getCodigoControle();
      $genero = $this->aluno->genero();
      $cidades = Cidade::pluck('nome_cidd', 'id')->prepend('Selecione');
      return view('app.aluno.create-edit', compact('cidades', 'codigo', 'genero'));
    }


    public function store(AlunoRequest $request)
    {
      $dataForm = $request->all();
      if ($dataForm) {
        $this->aluno->create($dataForm);
        $request->session()->flash('message', 'Usuário criado com sucesso');
        return redirect()->route('aluno');
      } else {
        return redirect()->back();
      }
    }


    public function edit($id)
    {
      $genero = $this->aluno->genero();
      $cidades = Cidade::pluck('nome_cidd', 'id')->prepend('Selecione');
      $aluno = $this->aluno->find($id);
      if ($aluno) {
        return view('app.aluno.create-edit', compact('aluno', 'cidades', 'genero'));
      } else {
        return redirect()->back();
      }
    }


    public function update(AlunoRequest $request, $id)
    {
      $aluno = $this->aluno->find($id);
      if (!$aluno) {
        return redirect()->back();
      }

      if ($aluno->update($request->all())) {
        return redirect()->route('aluno');
      } else {
        return redirect()->back();
      }
    }


    public function destroy($id)
    {
      try {
        $aluno = $this->aluno->find($id);
        $aluno->delete();
        flash()->overlay('Registro removido com sucesso!', 'Atenção');
        return redirect()->route('aluno');
      } catch (QueryException $e) {
        flash()->overlay('Este registro não pode ser excluido, pois está sendo usado!', 'Atenção');
        return redirect()->back();
      }
    }


  }
