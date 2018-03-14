<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Config;

class ConfigController extends Controller{

    // RECUPERA O ÚNICO REGISTRO DE CONFIGURAÇÕES DA TABELA E CHAMA A VIEW DE EDIÇÃO
    public function index(){

        $config = Config::all()->first();

        return view('admin.config.index', compact('config'));
    }

    // ATUALIZA AS CONFIGURAÇÕES DE DATA DO PROCESSO SELETIVO
    public function update(Request $request, $id){

        $config = Config::find($id);

        $config->inicio_inscricoes = formatarDataUSA($request->inicio_inscricoes);
        $config->termino_inscricoes = formatarDataUSA($request->termino_inscricoes);
        $config->inicio_resultado_preliminar = formatarDataUSA($request->inicio_resultado_preliminar);
        $config->termino_resultado_preliminar = formatarDataUSA($request->termino_resultado_preliminar);
        $config->inicio_resultado_final = formatarDataUSA($request->inicio_resultado_final);
        $config->termino_resultado_final = formatarDataUSA($request->termino_resultado_final);
        $config->inicio_recursos_etapa1 = formatarDataUSA($request->inicio_recursos_etapa1);
        $config->termino_recursos_etapa1 = formatarDataUSA($request->termino_recursos_etapa1);
        $config->inicio_recursos_etapa2 = formatarDataUSA($request->inicio_recursos_etapa2);
        $config->termino_recursos_etapa2 = formatarDataUSA($request->termino_recursos_etapa2);

        if($config->save()){
            return redirect()->route('admin.config.home')->with('success', 'Informações atualizadas com sucesso!');
        }
    }
}
