<?php

namespace App\Http\Controllers\Candidato;

use App\Models\CondicaoIsencao;
use App\Models\Config;
use App\Models\Inscricao;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class IsencaoController extends Controller{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){

        $condicoesIsencao = CondicaoIsencao::all();
        $inscricao = Inscricao::where('usuario_id', '=', \Auth::id())->first();
        $config = Config::all()->first();

        return view('candidato.pedido-isencao.index', compact('condicoesIsencao', 'inscricao', 'config'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $inscricao_id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $inscricao_id){

        $validator = Validator::make($request->all(), [
            'condicao_isencao' => 'required|exists:condicoes_isencao,id'
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $inscricao = (new \App\Models\Inscricao)->find($inscricao_id);

        $inscricao->pediu_isencao = 1;
        $inscricao->data_pediu_isencao = date('Y-m-d');
        $inscricao->condicao_isencao_id = $request->get('condicao_isencao');

        if(!$inscricao->save()){
            return redirect()->route('candidato.isencao.index')->with('error', 'Ocorreu um erro, tente novamente!');
        }

        return redirect()->route('candidato.isencao.index')->with('success', 'Pedido de isenção realizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
