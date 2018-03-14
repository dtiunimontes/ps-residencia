<?php

namespace App\Http\Controllers\Admin;

use App\Models\Inscricao;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\InscricaoRepository;
use App\Repositories\CandidatosRepository;
use App\Repositories\TratamentoEspecialRepository;

class TratamentoEspecialController extends Controller
{
    public function index(Request $request)
    {
        $atributo = !empty($request->get('atributo')) ? $request->get('atributo') : 'cpf';
        $valorDoAtributo = !empty($request->get('q')) ? $request->get('q') : '';

        $candidatos = CandidatosRepository::getCandidatos([
            'atributo' => $atributo,
            'valor' => $valorDoAtributo,
        ], 'tratamento_especial');

        return view('admin.tratamento_especial.index', compact('candidatos'));
    }

    public function update(Request $request, $id)
    {
        if((integer) $request->tratamento_especial === Inscricao::INDEFERIDO){
            return view('admin.tratamento_especial.motivo-indeferimento', compact('id'));
        }

        InscricaoRepository::updateStatusTratamentoEspecial($request, $id);

        return redirect()->back()->with('success', 'Análise realizada com sucesso!');
    }

    public function gerarResultado($tipo)
    {
        if($tipo == 'preliminar'){
            $resultado = TratamentoEspecialRepository::gerarResultado();
            $array = [
                'deferidos' => $resultado['deferidos'],
                'indeferidos' => $resultado['indeferidos'],
            ];
        }elseif($tipo == 'final'){
            $resultado = TratamentoEspecialRepository::gerarResultado('final');
            $array = [
                'deferidos' => $resultado['deferidos'],
            ];
        }

        $pdf = \PDF::loadView('admin.tratamento_especial.pfd-resultado', $array);

        return $pdf->stream("resultado_tratamento_especial");
    }

    public function showCandidatos($tipo, Request $request)
    {
        if($tipo === 'indeferidos'){
            $indeferidos = (empty($request->q)) ? TratamentoEspecialRepository::getCandidatos('indeferidos') : TratamentoEspecialRepository::getCandidatos('indeferidos', $request->q);
            return view('admin.tratamento_especial.indeferidos', compact('indeferidos'));
        }else{
            $deferidos = (empty($request->q)) ? TratamentoEspecialRepository::getCandidatos('deferidos') : TratamentoEspecialRepository::getCandidatos('deferidos', $request->q);
            return view('admin.tratamento_especial.deferidos', compact('deferidos'));
        }
    }

    public function showFormLancarRespostaRecurso($id)
    {
        return view('admin.tratamento_especial.form-lancar-resposta-recurso', ['inscricao' => Inscricao::find($id)]);
    }

    public function lancarRespostaRecurso($id, $tipo, Request $request)
    {
        $lancamento = TratamentoEspecialRepository::lancarRespostaRecurso($request, Inscricao::find($id));
        $redirect = redirect()->route('admin.tratamento_especial.candidatos', $tipo);
        return ($lancamento) ? $redirect->with('success', 'Resposta ao recurso enviada com sucesso!') : $redirect->with('danger', 'Ocorreu um erro, tente novamente!');
    }
}
