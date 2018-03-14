<?php

namespace App\Repositories;

use App\Models\Inscricao;
use App\Models\Usuario;

class CandidatosRepository
{

    public static function get($candidato_id)
    {
        $query = app(Usuario::class)->newQuery();
        $query->join('inscricoes', 'inscricoes.usuario_id', '=', 'usuarios.id');
        $query->join('residencias', 'inscricoes.residencia_id', '=', 'residencias.id');
        $query->join('cidades', 'inscricoes.cidade_id', '=', 'cidades.id');
        $query->join('programas', 'programas.id', '=', 'residencias.programa_id');
        $query->join('cidades_polos', 'cidades_polos.id', '=', 'residencias.cidade_polo_id');
        $query->join('categorias_profissionais', 'categorias_profissionais.id', '=', 'residencias.categoria_profissional_id');
        $query->where('usuarios.id', '=', $candidato_id);
        $query->where(function($q){
            $q->where('status_pedido_isencao', '=', Inscricao::DEFERIDO)
                ->orWhere('status_dae', '=', 1);
        });
        $query->select('inscricoes.id as inscricao', 'usuarios.nome as candidato_nome', 'residencias.id as residencia_id', 'programas.nome as programa', 'cidades_polos.nome as cidade_polo', 'categorias_profissionais.nome as categoria_profissional', 'local_prova', 'sala_prova', 'endereco_prova');

        return $query->first();
    }

    public static function getAptosRealizarProvaPorCidade($cidade_id)
    {
        $query = app(Usuario::class)->newQuery();
        $query->join('inscricoes', 'inscricoes.usuario_id', '=', 'usuarios.id');
        $query->join('residencias', 'inscricoes.residencia_id', '=', 'residencias.id');
        $query->join('cidades', 'inscricoes.cidade_id', '=', 'cidades.id');
        $query->join('programas', 'programas.id', '=', 'residencias.programa_id');
        $query->join('cidades_polos', 'cidades_polos.id', '=', 'residencias.cidade_polo_id');
        $query->join('categorias_profissionais', 'categorias_profissionais.id', '=', 'residencias.categoria_profissional_id');
        $query->where('status_pedido_isencao', '=', Inscricao::DEFERIDO);
        $query->orWhere('status_dae', '=', 1);
        $query->select('inscricoes.id', 'usuarios.nome', 'usuarios.cpf', 'cidades.id as cidade_id', 'cidades.nome as cidade', 'residencias.id as residencia', 'programas.nome as programa', 'cidades_polos.nome as cidade_polo', 'categorias_profissionais.nome as categoria_profissional');

        return $query->orderBy('usuarios.nome')->get()->where('cidade_id', '=', $cidade_id);
    }

    public static function getCandidatos($atributoEValor = [], $tipo = null){

        $query = app(Usuario::class)->newQuery();
        $query->where('permissao', Usuario::CANDIDATO);

        if(strcmp($atributoEValor['atributo'], 'inscricao_id') == 0){
            $id = $atributoEValor['valor'];
            $query->whereHas('inscricao', function($query) use ($id){
                $query->where('id', '=', $id);
            });
        }else{
            $query->where($atributoEValor['atributo'], 'LIKE', "%{$atributoEValor['valor']}%");
        }

        if(!is_null($tipo))
            $query->with('inscricao');

        return $query->paginate(20);
    }

    public static function edit($candidato_id){

        $usuario = Usuario::find($candidato_id);

        return [
            'id' => $candidato_id,
            'nome' => $usuario->nome,
            'cpf' => $usuario->cpf,
            'residencia_id' => $usuario->inscricao->residencia_id
        ];
    }

    public static function updateCpfAndResidencia($update = [], $candidato_id){

        $usuario = Usuario::find($candidato_id);
        $usuario->cpf = $update['cpf'];
        $usuario->save();
        $usuario->inscricao()->update(['residencia_id' => $update['residencia_id']]);
    }
}