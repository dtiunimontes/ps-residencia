<?php

namespace App\Http\Controllers\Candidato;

use App\Repositories\CandidatosRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartaoInscricaoController extends Controller
{

    public function gerarPdf(){
        $inscricao = CandidatosRepository::get(\Auth::id());
        $pdf = \PDF::loadView('candidato.pdfs.cartao-inscricao', compact('inscricao'));
        return $pdf->stream("cartao_inscricao.pdf");
    }

}
