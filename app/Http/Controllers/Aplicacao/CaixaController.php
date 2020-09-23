<?php

namespace App\Http\Controllers\Aplicacao;

use App\Models\Caixa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class CaixaController extends Controller
{

    private $caixa;

    public function __construct(Caixa $caixa)
    {
        $this->caixa = $caixa;
    }

    public function index(){
        $caixa = $this->caixa->paginate(10);

        $total = DB::table('caixas as c')->join('academias as a', 'c.academia_id','a.id')
            ->where('a.id',\Auth::user()->academia_id)
            ->sum('c.valr_pagt');

        return view('app.Caixa.index', compact('caixa','total'));
    }

    public function store(Request $request){
        $data = $request->all();
        $this->caixa->create($data);
        //return view('app.caixa.index');
        return redirect()->back();
    }

}
