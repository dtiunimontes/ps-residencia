<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\InscricaoRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndeferimentoTratamentoEspecialController extends Controller{
    public function update(Request $request, $id){
        InscricaoRepository::updateMotivoIndeferimentoTratamentoEspecial($request, $id);
        return redirect()->route('admin.tratamento_especial.index')->with('success', 'Análise realizada com sucesso!');
    }
}
