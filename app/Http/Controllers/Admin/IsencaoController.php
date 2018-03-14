<?php

namespace App\Http\Controllers\Admin;

use App\Models\Inscricao;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PedidoIsencaoRepository;

class IsencaoController extends Controller{

    public function showFormLancarRespostaRecurso($id){
        return view('admin.isencao.form-lancar-resposta-recurso', ['inscricao' => Inscricao::find($id)]);
    }

    /**
     * @param $id da inscrição
     * @param $tipo (indeferidos/deferidos)
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function lancarRespostaRecurso($id, $tipo, Request $request){
        $lancamento = PedidoIsencaoRepository::lancarRespostaRecurso($request, Inscricao::find($id));
        $redirect = redirect()->route('admin.isencao.candidatos', $tipo);
        return ($lancamento) ? $redirect->with('success', 'Resposta ao recurso enviada com sucesso!') : $redirect->with('danger', 'Ocorreu um erro, tente novamente!');
    }

    /**
     * @param $tipo (indeferidos/deferidos)
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showCandidatos($tipo, Request $request){
        if($tipo === 'indeferidos'){
            $indeferidos = (empty($request->q)) ? PedidoIsencaoRepository::getCandidatos('indeferidos') : PedidoIsencaoRepository::getCandidatos('indeferidos', $request->q);
            return view('admin.isencao.indeferidos', compact('indeferidos'));
        }else{
            $deferidos = (empty($request->q)) ? PedidoIsencaoRepository::getCandidatos('deferidos') : PedidoIsencaoRepository::getCandidatos('deferidos', $request->q);
            return view('admin.isencao.deferidos', compact('deferidos'));
        }
    }

    public function index(Request $request){

        $pedidosIsencao = (empty($request->q)) ? PedidoIsencaoRepository::getPedidosIsencao(null) : PedidoIsencaoRepository::getPedidosIsencao($request->q);

        return view('admin.isencao.index', compact('pedidosIsencao'));
    }

    public function update(Request $request, $id){

        $inscricao = Inscricao::find($id);

        if((integer) $request->status_pedido_isencao === Inscricao::INDEFERIDO){
            return view('admin.isencao.motivo-indeferimento', compact('id'));
        }else{
            $inscricao->status_pedido_isencao = (integer) $request->status_pedido_isencao;
        }

        if($inscricao->save()){
            return redirect()->back()->with('success', 'Análise realizada com sucesso!');
        }

        return redirect()->back();
    }

    public function gerarResultado($tipo){

        if($tipo == 'preliminar'){
            $resultado = PedidoIsencaoRepository::gerarResultadoPedidoIsencao();
            $array = [
                'deferidos' => $resultado['deferidos'],
                'indeferidos' => $resultado['indeferidos'],
            ];
        }else{
            $resultado = PedidoIsencaoRepository::gerarResultadoPedidoIsencao('final');
            $array = [
                'deferidos' => $resultado['deferidos'],
            ];
        }

        $pdf = \PDF::loadView('admin.isencao.pfd-resultado-isencao', $array);

        return $pdf->stream("resultado_pedido_isencao");
    }
}
