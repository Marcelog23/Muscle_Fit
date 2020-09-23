<?php

namespace App\Http\Controllers;

use App\Http\Requests\AcademiaRequest;
use App\Models\Academia;
use App\Models\Cidade;
use App\Notifications\UserAcade;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class SiteController extends Controller
{


    public function index()
    {
        $cidades = Cidade::pluck('nome_cidd', 'id');
        return view('site.index', compact('cidades'));
    }

    public static function store(AcademiaRequest $request)
    {
        $data = $request->all();
        if ($data) {
            $email  = $data['email_acade'];
            $nome   = $data['razao_social'];
            $return =  Academia::create($data);
            $id = $return['id'];

            User::newUser($nome,$email,$id);

            flash()->overlay('Cadastro realizado com sucesso, enviaremos um e-mail com o link para registar um usuário. Obrigado','Sucesso!');
            return redirect()->back();
        }else{
            flash()->overlay('Falha ao realizar cadastro, tente novamente!');
            return redirect()->back();
        }

    }



}
