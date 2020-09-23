<?php

namespace App\Http\Controllers\Aplicacao;


use App\Http\Requests\UserRequest;
use App\Models\UserTenant;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class UsuarioController extends Controller
{
    private $user;

    public function __construct(UserTenant $user)
    {
        $this->user = $user;
    }

    public function index(Request $request)
    {
        $filtro = $request->get('filtro');

        if ($filtro == null)
        {
            $users =  $this->user->where('academia_id', \Auth::user()->academia_id)->get();
            return view('app.usuario.index', compact('users'));
        }else{

            $users = $this->user->getUsers($filtro);
            return view('app.usuario.index', compact('users'));
        }

    }

    public function create()
    {
        $codigo = $this->user->getCodigoControle();
        $tipoUser = $this->user->tipo();
        return view('app.usuario.create-edit', compact('tipoUser','codigo'));
    }

    
    public function store(UserRequest $request)
    {
        $dataForm = $request->all();
        if ($dataForm){
            $this->user->create($dataForm);
            return redirect()->route('usuario');
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
        $tipoUser = $this->user->tipo();
        $usuario = $this->user->find($id);

        if($usuario){
            return view('app.usuario.create-edit', compact('tipoUser','usuario'));
        }else{
            return redirect()->back();
        }
    }


    public function update(Request $request, $id)
    {
        $user = $this->user->find($id);
        if(!$user){
            return redirect()->back();
        }

        if ($user->update($request->all())){
            return redirect()->route('usuario');
        }else{
            return redirect()->back();
        }
    }


    public function destroy($id)
    {
        try{
            $user = $this->user->find($id);
            $user->delete();
            flash()->overlay('usuário excluído com sucesso.', 'Sucesso!');
            return redirect()->route('usuario');
        }catch (QueryException $e){
            flash()->overlay('Este usuário não pode ser excluído', 'Atenção!');
            return redirect()->back();
        }
    }

    public function resetUser($id)
    {
        $user = $this->user->find($id);
        if($this->user->resetPasswordUser($user)){
            flash()->overlay('E-mail para recuperação de conta enviado com sucesso', 'Sucesso!');
            return redirect()->back();
        } else{
            flash()->overlay('Falha ao enviar, tente novamente', 'Atenção!');
            return redirect()->back();
        }
    }


}
