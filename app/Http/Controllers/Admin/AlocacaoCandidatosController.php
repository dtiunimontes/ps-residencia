<?php

namespace App\Http\Controllers\Admin;

use App\Models\Inscricao;
use App\Repositories\InscricaoRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AlocacaoCandidatosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $residenciaId = $request->residenciaId ? $request->residenciaId : 1;
        $cidadeId = $request->cidadeId ? $request->cidadeId : 1;

        $inscricoes = InscricaoRepository::buscarPorResidenciaECidade($residenciaId, $cidadeId);
        return view('admin.alocacao.index', compact('inscricoes'));
    }

    public function alocar(Request $request)
    {
        $inscricoesParaAlocar = $request->get('inscricoes');

        if(empty($inscricoesParaAlocar))
            return redirect()->back()->with('danger', 'Por favor, selecione os candidatos que deseja alocar para este local de prova!')->withInput();

        Inscricao::whereIn('id', $inscricoesParaAlocar)
            ->update([
                'local_prova' => $request->get('local'),
                'sala_prova' => $request->get('sala'),
                'endereco_prova' => $request->get('endereco')
            ]);

        return redirect()->back()->with('success', 'Alocação realizada com sucesso!');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
