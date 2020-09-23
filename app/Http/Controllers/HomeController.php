<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // NOME ACADEMIA
        $academia = DB::table('academias as ac')->select('ac.nome_fant')
            ->where('ac.id', \Auth::user()->academia_id)->get();

        foreach ($academia as $acade){
            $nome = $acade->nome_fant;
        }

        // TOTAL DE ALUNOS
        $alunos = DB::table('alunos as a')
                      ->where('a.academia_id', \Auth::user()->academia_id)
                      ->count('a.id');

        // TOTAL DE MATRICULAS
        $matriculas = DB::table('matriculas as m')->where([
            ['m.academia_id', \Auth::user()->academia_id],
            ['m.ativada', 1]
        ])->count('m.codg_matr');

        // TOTAL DE MATRICULAS
        $personal = DB::table('personals as p')
                        ->where('p.academia_id', \Auth::user()->academia_id)
                        ->count('p.id');

        $totalPagamentos = DB::table('caixas as c')->where([
            ['c.academia_id', \Auth::user()->academia_id]
        ])->count('c.codg_caixa');

        $totalCaixa =  DB::table('caixas as c')->where([
            ['c.academia_id', \Auth::user()->academia_id]
        ])->sum('c.valr_pagt');


        return view('home', compact('totalPagamentos','totalCaixa','alunos','matriculas','personal','nome'));
    }
}
