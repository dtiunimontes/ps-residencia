<?php

namespace App\Http\Controllers\Candidato\Pdfs;

use App\Http\Controllers\Controller;

class IsencaoController extends Controller{

    public function gerarFolhaIdentificacao(){

        $candidatoId = \Auth::id();
        $inscricao = \DB::table('inscricoes')
                            ->join('usuarios', 'usuarios.id', '=', 'inscricoes.usuario_id')
                            ->join('residencias', 'residencias.id', '=', 'inscricoes.residencia_id')
                            ->join('cidades_polos', 'cidades_polos.id', '=', 'residencias.cidade_polo_id')
                            ->join('programas', 'programas.id', '=', 'residencias.programa_id')
                            ->join('categorias_profissionais', 'categorias_profissionais.id', '=', 'residencias.categoria_profissional_id')
                            ->where('inscricoes.usuario_id', '=', $candidatoId)
                            ->select(
                                '*',
                                'usuarios.nome as candidato_nome',
                                'inscricoes.id as inscricao_id',
                                'usuarios.id as candidato_id',
                                'cidades_polos.nome as cidade_polo_nome',
                                'programas.nome as programa_nome',
                                'categorias_profissionais.nome as categoria_profissional_nome',
                                'residencias.id as residencia_id'
                            )
                            ->first();

        $pdf = \PDF::loadView('candidato.pdfs.folha-identificacao', compact('inscricao'));

        return $pdf->stream("folha-identificacao-{$inscricao->nome}");
    }

    public function gerarFolhaIdentificacaoSegundaEtapa(){

        $candidatoId = \Auth::id();
        $inscricao = \DB::table('inscricoes')
            ->join('usuarios', 'usuarios.id', '=', 'inscricoes.usuario_id')
            ->join('residencias', 'residencias.id', '=', 'inscricoes.residencia_id')
            ->join('cidades_polos', 'cidades_polos.id', '=', 'residencias.cidade_polo_id')
            ->join('programas', 'programas.id', '=', 'residencias.programa_id')
            ->join('categorias_profissionais', 'categorias_profissionais.id', '=', 'residencias.categoria_profissional_id')
            ->where('inscricoes.usuario_id', '=', $candidatoId)
            ->select(
                '*',
                'usuarios.nome as candidato_nome',
                'inscricoes.id as inscricao_id',
                'usuarios.id as candidato_id',
                'cidades_polos.nome as cidade_polo_nome',
                'programas.nome as programa_nome',
                'categorias_profissionais.nome as categoria_profissional_nome',
                'residencias.id as residencia_id'
            )
            ->first();

        $pdf = \PDF::loadView('candidato.pdfs.folha-identificacao-segunda-etapa', compact('inscricao'));

        return $pdf->stream("folha-identificacao-{$inscricao->nome}");
    }

    public function gerarComprovantePreInscricaoPedidoIsencao(){

        $candidatoId = \Auth::id();
        $inscricao = \DB::table('inscricoes')
            ->join('usuarios', 'usuarios.id', '=', 'inscricoes.usuario_id')
            ->join('residencias', 'residencias.id', '=', 'inscricoes.residencia_id')
            ->join('cidades_polos', 'cidades_polos.id', '=', 'residencias.cidade_polo_id')
            ->join('programas', 'programas.id', '=', 'residencias.programa_id')
            ->join('categorias_profissionais', 'categorias_profissionais.id', '=', 'residencias.categoria_profissional_id')
            ->where('inscricoes.usuario_id', '=', $candidatoId)
            ->select(
                '*',
                'usuarios.nome as candidato_nome',
                'inscricoes.id as inscricao_id',
                'usuarios.id as candidato_id',
                'cidades_polos.nome as cidade_polo_nome',
                'programas.nome as programa_nome',
                'categorias_profissionais.nome as categoria_profissional_nome',
                'residencias.id as residencia_id'
            )
            ->first();

        $pdf = \PDF::loadView('candidato.pdfs.comprovante-pre-inscricao', compact('inscricao'));

        return $pdf->stream("comprovante-pre-inscricao-{$inscricao->nome}");
    }

    public function gerarFormularioPedidoIsencao(){

        $candidatoId = \Auth::id();
        $inscricao = \DB::table('inscricoes')
            ->join('usuarios', 'usuarios.id', '=', 'inscricoes.usuario_id')
            ->join('residencias', 'residencias.id', '=', 'inscricoes.residencia_id')
            ->join('cidades_polos', 'cidades_polos.id', '=', 'residencias.cidade_polo_id')
            ->join('programas', 'programas.id', '=', 'residencias.programa_id')
            ->join('categorias_profissionais', 'categorias_profissionais.id', '=', 'residencias.categoria_profissional_id')
            ->where('inscricoes.usuario_id', '=', $candidatoId)
            ->select(
                '*',
                'usuarios.nome as candidato_nome',
                'inscricoes.id as inscricao_id',
                'cidades_polos.nome as cidade_polo_nome',
                'programas.nome as programa_nome',
                'categorias_profissionais.nome as categoria_profissional_nome',
                'residencias.id as residencia_id'
            )
            ->first();

        $pdf = \PDF::loadView('candidato.pdfs.formulario-pedido-isencao', compact('inscricao'));

        return $pdf->stream("formulario-pedido-isencao-{$inscricao->nome}");
    }
}
