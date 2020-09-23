<?php

  namespace App\Http\Controllers\Aplicacao;

  use App\Http\Controllers\Controller;
  use App\Http\Requests\AcademiaRequest;
  use App\Models\Academia;
  use App\Models\Cidade;
  use Illuminate\Database\QueryException;

  class AcademiaController extends Controller
  {

    private $academia;

    public function __construct(Academia $academia)
    {
      $this->academia = $academia;
    }


    public function index()
    {
      $academias = $this->academia->getAcademia();

      return view('app.academia.index', compact('academias'));
    }


    public function create()
    {
      $cidades = Cidade::pluck('nome_cidd', 'id');
      return view('app.academia.create-edit', compact('cidades'));
    }


    public function store(AcademiaRequest $request)
    {
      $dataForm = $request->all();
      if ($dataForm) {
        $this->academia->create($dataForm);
        return redirect()->route('academia.index');
      } else {
        return redirect()->back();
      }
    }


    public function show($id)
    {
      //
    }


    public function edit($id)
    {
      $cidades = Cidade::pluck('nome_cidd', 'id')->prepend('Selecione');
      $academia = $this->academia->find($id);
      if ($academia) {
        return view('app.academia.create-edit', compact('academia', 'cidades'));
      } else {
        return redirect()->back();
      }
    }


    public function update(AcademiaRequest $request, $id)
    {
      $academia = $this->academia->find($id);
      if (!$academia) {
        return redirect()->back();
      }

      if ($academia->update($request->all())) {
        return redirect()->route('academia.index');
      } else {
        return redirect()->back();
      }
    }

    public function destroy($id)
    {
      try {
        $academia = $this->academia->find($id);
        $academia->delete();
        flash()->overlay('Registro removido com sucesso!', 'Atenção');
        return redirect()->route('academia.index');
      } catch (QueryException $e) {
        flash()->overlay('Este registro não pode ser excluido, pois está sendo usado!', 'Atenção');
        return redirect()->back();
      }
    }
  }