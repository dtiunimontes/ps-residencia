<?php

namespace App\Http\Controllers\Admin;

use App\Models\Residencia;
use App\Repositories\CandidatosRepository;
use App\Repositories\CidadesRepository;
use App\Repositories\ResidenciasRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\UpdateCandidatoRequest;
use App\Http\Controllers\Controller;

class CandidatosController extends Controller{

    /*
     * Separa candidatos por local de prova e depois por residência
     */
    /*public function gerarListaAptosRealizarProva()
    {
        $candidatosAptos = CandidatosRepository::gerarListaAptosRealizarProva();

        $cidades = CidadesRepository::getAll();

        $candidatosCidades = $this->separarCollectionAptosPorCidade($candidatosAptos, $cidades);
        $candidatosPorCidadeEResidencia = $this->separarPorResidencia($candidatosCidades);
    }

    private function separarCollectionAptosPorCidade(Collection $candidatosAptos, Collection $cidades)
    {
        foreach($cidades as $cidade){
            $candidatos[$cidade->nome] = $candidatosAptos->where('cidade', $cidade->nome);
        }

        return $candidatos;
    }

    private function separarPorResidencia(array $cadidatosAptosPorCidade)
    {
        $residenciasCollection = ResidenciasRepository::getAll();
        $residencia = [];
        foreach($cadidatosAptosPorCidade as $chave => $candidatosAptos){
            foreach($candidatosAptos as $candidatoApto){
                dd($candidatoApto);
                foreach($residenciasCollection as $residencia){
                    $residencia[$residencia->id] = $candidatoApto->where('residencia', $residencia->id);
                }
            }
        }
        dd($residencia);
        dd($cadidatosAptosPorCidade);
    }*/

    public function gerarListaAptosRealizarProva(){

        $cidades = CidadesRepository::getAll();
        $residencias = Residencia::all();
        $aptosRealizarProva = [];

        foreach($cidades as $cidade){
            $listaCandidatosAptosPorCidade[$cidade->nome] = CandidatosRepository::getAptosRealizarProvaPorCidade($cidade->id);
        }

        foreach($listaCandidatosAptosPorCidade as $chave => $candidatos){
            foreach($residencias as $residencia){

                $aptosRealizarProva[$chave][$residencia->id] = $candidatos->filter(function($candidato) use($residencia){
                    return $candidato->residencia === $residencia->id;
                });
            }
        }

        $pdf = \PDF::loadView('admin.candidatos.pdf_aptos_realizar_prova', compact('aptosRealizarProva'));

        return $pdf->stream("pfd_aptos_realizar_prova.pdf");
    }

    public function index(Request $request)
    {

        $atributo = !empty($request->get('atributo')) ? $request->get('atributo') : 'cpf';
        $valorDoAtributo = !empty($request->get('q')) ? $request->get('q') : '';

        $candidatos = CandidatosRepository::getCandidatos([
            'atributo' => $atributo,
            'valor' => $valorDoAtributo,
        ]);

        return view('admin.candidatos.index', compact('candidatos'));
    }

    public function edit($id)
    {
        return view('admin.candidatos.edit', ['candidato' => CandidatosRepository::edit($id)]);
    }

    public function update(UpdateCandidatoRequest $request, $id)
    {

        CandidatosRepository::updateCpfAndResidencia($request->only(['cpf', 'residencia_id']), $id);

        return redirect()->route('admin.candidatos.edit', $id)->with('success', 'Informações atualizadas!');
    }
}
