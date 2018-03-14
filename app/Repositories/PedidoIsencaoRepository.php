<?php

namespace App\Repositories;

use App\Models\Inscricao;
use App\Models\Usuario;
use Illuminate\Http\Request;

class PedidoIsencaoRepository extends Repository{

    public function __construct(){
        $this->setModel(Inscricao::class);
    }

    public static function lancarRespostaRecurso(Request $request, $inscricao){
        $inscricao->resposta_recurso_isencao = $request->resposta_recurso_isencao;
        if($request->deferido == "on"){
            $inscricao->status_pedido_isencao = Inscricao::DEFERIDO;
        }else{
            if($inscricao->status_pedido_isencao = Inscricao::DEFERIDO){
                $inscricao->status_pedido_isencao = Inscricao::INDEFERIDO;
            }
        }
        return $inscricao->save() || false;
    }

    public static function getCandidatos($tipo = 'indeferidos', $inscricao_id = NULL){
        $query = app(Usuario::class)->newQuery();
        $query->join('inscricoes', 'inscricoes.usuario_id', '=', 'usuarios.id');
        $query->join('residencias', 'inscricoes.residencia_id', '=', 'residencias.id');
        $query->join('programas', 'programas.id', '=', 'residencias.programa_id');
        $query->join('cidades_polos', 'cidades_polos.id', '=', 'residencias.cidade_polo_id');
        $query->join('categorias_profissionais', 'categorias_profissionais.id', '=', 'residencias.categoria_profissional_id');

        if($tipo === 'indeferidos'){
            $query->where('inscricoes.status_pedido_isencao', '=', Inscricao::INDEFERIDO);
        }else{
            $query->where('inscricoes.status_pedido_isencao', '=', Inscricao::DEFERIDO);
        }

        $query->select(
            'inscricoes.id as inscricao',
            'usuarios.nome as candidato_nome',
            'usuarios.cpf as candidato_cpf',
            'residencias.id as residencia_codigo',
            'programas.nome as programa',
            'categorias_profissionais.nome as categoria_profissional',
            'cidades_polos.nome as cidade_polo',
            'status_pedido_isencao',
            'resposta_recurso_isencao'
        );
        $query->orderBy('usuarios.nome');

        if(!is_null($inscricao_id)){
            $query->where('inscricoes.id', $inscricao_id);
        }

        return $query->get();
    }

    public static function gerarResultadoPedidoIsencao($tipo = 'preliminar'){

        $resultados = [];

        $query = app(Usuario::class)->newQuery();
        $query->join('inscricoes', 'inscricoes.usuario_id', '=', 'usuarios.id');
        $query->where('inscricoes.status_pedido_isencao', '=', Inscricao::DEFERIDO);
        $query->select('inscricoes.id as id', 'nome', 'rg');
        $query->orderBy('usuarios.nome');
        $resultados['deferidos'] = $query->get();

        if($tipo === 'preliminar'){
            $query = app(Usuario::class)->newQuery();
            $query->join('inscricoes', 'inscricoes.usuario_id', '=', 'usuarios.id');
            $query->where('inscricoes.status_pedido_isencao', '=', Inscricao::INDEFERIDO);
            $query->select('inscricoes.id as id', 'nome', 'rg', 'motivo_indeferimento_isencao');
            $query->orderBy('usuarios.nome');
            $resultados['indeferidos'] = $query->get();
        }

        return $resultados;
    }

    public static function getPedidosIsencao($inscricao_id = null){

        $query = app(Usuario::class)->newQuery();
        $query->join('inscricoes', 'inscricoes.usuario_id', '=', 'usuarios.id');
        $query->join('residencias', 'inscricoes.residencia_id', '=', 'residencias.id');
        $query->join('programas', 'programas.id', '=', 'residencias.programa_id');
        $query->join('cidades_polos', 'cidades_polos.id', '=', 'residencias.cidade_polo_id');
        $query->join('categorias_profissionais', 'categorias_profissionais.id', '=', 'residencias.categoria_profissional_id');
        $query->where('inscricoes.pediu_isencao', '=', 1);

        if(!is_null($inscricao_id)){
            $query->where('inscricoes.id', '=', $inscricao_id);
        }

        $query->select(
            'inscricoes.id as inscricao',
            'usuarios.nome as candidato_nome',
            'usuarios.cpf as candidato_cpf',
            'residencias.id as residencia_codigo',
            'programas.nome as programa',
            'categorias_profissionais.nome as categoria_profissional',
            'cidades_polos.nome as cidade_polo',
            'inscricoes.status_pedido_isencao',
	    'data_nasc',
            'telefone'
        );
        $query->orderBy('candidato_nome');

        return $query->get();
    }
}