<?php

namespace App\Http\Controllers\Admin;

use App\Models\Inscricao;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndeferimentoIsencaoController extends Controller{

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){

        try{
            $inscricao = Inscricao::find($id);

            $inscricao->status_pedido_isencao = Inscricao::INDEFERIDO;
            $inscricao->motivo_indeferimento_isencao = $request->motivo_indeferimento_isencao;
            $inscricao->save();

            return redirect()->route('admin.isencao.index')->with('success', 'Análise realizada com sucesso!');
        }catch(\Exception $exception){
            return redirect()->route('admin.isencao.index')->with('danger', 'Ocorreu um erro, tente novamente!');
        }
    }
}
