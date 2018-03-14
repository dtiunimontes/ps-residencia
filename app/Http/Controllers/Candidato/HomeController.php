<?php

namespace App\Http\Controllers\Candidato;

use App\Http\Controllers\Controller;
use App\Models\Inscricao;
use App\Models\Config;
use Auth;

class HomeController extends Controller{

    public function index(){

        $inscricao = Inscricao::where('usuario_id', '=', Auth::id())->first();
        $config = Config::all()->first();

        return view('candidato.index', compact('inscricao', 'config'));
    }
}
