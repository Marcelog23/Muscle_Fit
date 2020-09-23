<?php

namespace App\Http\Controllers\Aplicacao;

use App\Http\Controllers\Controller;
use App\Models\Matricula;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RelatorioController extends Controller
{
    public function index()
    {
        $matricula = Matricula::select(DB::raw("CONCAT(id, ' - ', (select nome_aluno from alunos where id = aluno_id)) as descr, id"))->pluck('descr', 'id');

        return view('app.relatorio.index', compact('matricula'));
    }

    public function mensalidadesPagas(Request $request)
    {
        // DADOS DA ACADEMIA
        $academia = DB::table('academias as a')
            ->select('a.nome_fant','a.endr_acade','a.telf_acade','a.email_acade','a.cnpj_acade')
            ->where('a.id', \Auth::user()->academia_id)->get();

        $matricula = $request->get('matricula_id');
        $dataIni  = $request->get('dataIni');
        $dataFim   = $request->get('dataFim');

        if (isset($matricula) && $dataIni == null && $dataFim == null){

            $aluno = DB::table('alunos as a')
                ->select('a.nome_aluno')
                ->join('matriculas as m','a.id', 'm.aluno_id')
                ->where('m.id', $matricula)
                ->get();


            $result = DB::table('mensalidades as m')
                ->select('m.data_venc','m.valr_mensa','p.data_pagt')
                ->join('pagamentos as p','p.mensalidade_id','m.id')
                ->join('carnes as c','m.carne_id','c.id')
                ->join('matriculas as ma','c.matricula_id','ma.id')
                ->where([
                    ['m.quitada',1],
                    ['ma.id',$matricula]
                ])->get();


            return \PDF::loadView('app.relatorio.mensalidades.pagas', compact('result','academia','aluno'))->stream($matricula.'.pdf');

        } elseif (isset($matricula) && isset($dataIni) && isset($dataFim)){

            $aluno = DB::table('alunos as a')
                ->select('a.nome_aluno')
                ->join('matriculas as m','a.id', 'm.aluno_id')
                ->where('m.id', $matricula)
                ->get();

            $result = DB::table('mensalidades as m')
                ->select('m.data_venc','m.valr_mensa','p.data_pagt')
                ->join('pagamentos as p','p.mensalidade_id','m.id')
                ->join('carnes as c','m.carne_id','c.id')
                ->join('matriculas as ma','c.matricula_id','ma.id')
                ->where([
                    ['m.quitada',1],
                    ['ma.id',$matricula],
                ])
                ->whereBetween('p.data_pagt',[$dataIni,$dataFim])
                ->get();

            return \PDF::loadView('app.relatorio.mensalidades.pagas', compact('result','academia','aluno','dataIni','dataFim'))->stream($matricula.'.pdf');

        }elseif (isset($dataIni) && isset($dataFim) && $matricula == null){


            $result = DB::table('mensalidades as m')
                ->select('a.id','a.nome_aluno','m.data_venc','m.valr_mensa','p.data_pagt')
                ->join('pagamentos as p','p.mensalidade_id','m.id')
                ->join('carnes as c','m.carne_id','c.id')
                ->join('matriculas as ma','c.matricula_id','ma.id')
                ->join('alunos as a','ma.aluno_id','a.id')
                ->where([
                    ['m.quitada',1],
                    ['m.academia_id',\Auth::user()->academia_id]
                ])
                ->whereBetween('p.data_pagt',[$dataIni,$dataFim])
                ->groupBy('a.id','a.nome_aluno','m.data_venc','m.valr_mensa','p.data_pagt')
                ->orderBy('a.nome_aluno')
                ->get();

           // dd($result);

            return \PDF::loadView('app.relatorio.mensalidades.todas', compact('result','academia','dataIni','dataFim'))->stream('mensalidades'.'.pdf');
        }


    }


    public function mensalidadesAVencer(Request $request)
    {
        // DADOS DA ACADEMIA
        $academia = DB::table('academias as a')
            ->select('a.nome_fant','a.endr_acade','a.telf_acade','a.email_acade','a.cnpj_acade')
            ->where('a.id', \Auth::user()->academia_id)->get();

        $matricula = $request->get('matricula_id');
        $dataiIni   = $request->get('dataIni');
        $dataFim   = $request->get('dataFim');

        if (isset($matricula) && ($dataiIni == null ) && ($dataFim == null)){

        $aluno = DB::table('alunos as a')
            ->select('a.nome_aluno')
            ->join('matriculas as m','a.id', 'm.aluno_id')
            ->where('m.id', $matricula)
            ->get();


        $result = DB::table('mensalidades as m')
            ->select('m.data_venc','m.valr_mensa','m.saldo_mensa')
            ->join('carnes as c','m.carne_id','c.id')
            ->join('matriculas as ma','c.matricula_id','ma.id')
            ->where([
                ['m.quitada',0],
                ['ma.id',$matricula]
            ])->get();

            return \PDF::loadView('app.relatorio.mensalidades.apagar', compact('result','academia','aluno'))->stream($matricula.'.pdf');


        } elseif (isset($matricula) && isset($dataiIni) && isset($dataFim)) {

            $aluno = DB::table('alunos as a')
                ->select('a.nome_aluno')
                ->join('matriculas as m','a.id', 'm.aluno_id')
                ->where('m.id', $matricula)
                ->get();

            $result = DB::table('mensalidades as m')
                ->select('a.nome_aluno', 'm.data_venc', 'm.valr_mensa', 'm.saldo_mensa')
                ->join('carnes as c', 'm.carne_id', 'c.id')
                ->join('matriculas as ma', 'c.matricula_id', 'ma.id')
                ->join('alunos as a', 'ma.aluno_id', 'a.id')
                ->where([
                    ['m.quitada', 0],
                    ['ma.id', $matricula]
                ])
                ->whereBetween('m.data_venc', [$dataiIni, $dataFim])
                ->get();

            return \PDF::loadView('app.relatorio.mensalidades.apagar', compact('result', 'academia','aluno'))->stream($matricula . '.pdf');
        }
    }


    public function caixaPorData(Request $request)
    {
        // DADOS DA ACADEMIA
        $academia = DB::table('academias as a')
            ->select('a.nome_fant','a.endr_acade','a.telf_acade','a.email_acade','a.cnpj_acade')
            ->where('a.id', \Auth::user()->academia_id)->get();

        $data = $request->all();

        $data1 = $data['data1'];
        $data2 = $data['data2'];

        $result = DB::table('caixas as c')
            ->select('c.codg_caixa','c.desc_caixa','c.valr_pagt','c.data_pagt','c.tipo_lanc')
            ->where('c.academia_id',\Auth::user()->academia_id)
            ->whereBetween('c.data_pagt',[$data1, $data2])
            ->get();

        return \PDF::loadView('app.relatorio.caixa.caixa', compact('result','academia','data1','data2'))->stream('caixa'.'.pdf');
    }


}
