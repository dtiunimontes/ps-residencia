<?php

namespace App\Repositories;

use App\Models\Inscricao;
use App\Models\Usuario;
use Illuminate\Http\Request;

class TratamentoEspecialRepository
{
    public static function gerarResultado($tipo = 'preliminar')
    {
        $resultados = [];

        $query = app(Usuario::class)->newQuery();
        $query->join('inscricoes', 'inscricoes.usuario_id', '=', 'usuarios.id');
        $query->where('inscricoes.tratamento_especial', '=', Inscricao::DEFERIDO);
        $query->select('inscricoes.id as id', 'nome', 'rg');
        $query->orderBy('usuarios.nome');

        $resultados['deferidos'] = $query->get();

        if($tipo === 'preliminar'){

            $query = app(Usuario::class)->newQuery();
            $query->join('inscricoes', 'inscricoes.usuario_id', '=', 'usuarios.id');
            $query->where('inscricoes.tratamento_especial', '=', Inscricao::INDEFERIDO);
            $query->select('inscricoes.id as id', 'nome', 'rg', 'motivo_indeferimento_tratamento_especial');
            $query->orderBy('usuarios.nome');

            $resultados['indeferidos'] = $query->get();
        }

        return $resultados;
    }

    public static function getCandidatos($tipo = 'indeferidos', $inscricao_id = NULL)
    {

        $query = app(Usuario::class)->newQuery();
        $query->join('inscricoes', 'inscricoes.usuario_id', '=', 'usuarios.id');
        $query->join('residencias', 'inscricoes.residencia_id', '=', 'residencias.id');
        $query->join('programas', 'programas.id', '=', 'residencias.programa_id');
        $query->join('cidades_polos', 'cidades_polos.id', '=', 'residencias.cidade_polo_id');
        $query->join('categorias_profissionais', 'categorias_profissionais.id', '=', 'residencias.categoria_profissional_id');

        if($tipo === 'indeferidos'){
            $query->where('inscricoes.tratamento_especial', '=', Inscricao::INDEFERIDO);
        }else{
            $query->where('inscricoes.tratamento_especial', '=', Inscricao::DEFERIDO);
        }

        $query->select(
            'inscricoes.id as inscricao',
            'usuarios.nome as candidato_nome',
            'usuarios.cpf as candidato_cpf',
            'residencias.id as residencia_codigo',
            'programas.nome as programa',
            'categorias_profissionais.nome as categoria_profissional',
            'cidades_polos.nome as cidade_polo',
            'tratamento_especial',
            'resposta_recurso_tratamento_especial'
        );
        $query->orderBy('usuarios.nome');

        if(!is_null($inscricao_id)){
            $query->where('inscricoes.id', $inscricao_id);
        }

        return $query->get();
    }

    public static function lancarRespostaRecurso(Request $request, $inscricao)
    {
        $inscricao->resposta_recurso_tratamento_especial = $request->resposta_recurso_tratamento_especial;
        if($request->deferido == "on"){
            $inscricao->tratamento_especial = Inscricao::DEFERIDO;
        }else{
            if($inscricao->tratamento_especial = Inscricao::DEFERIDO){
                $inscricao->tratamento_especial = Inscricao::INDEFERIDO;
            }
        }
        return $inscricao->save() || false;
    }
}