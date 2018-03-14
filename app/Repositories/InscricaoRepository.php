<?php

namespace App\Repositories;

use App\Models\Inscricao;
use App\Models\Usuario;
use Illuminate\Http\Request;

class InscricaoRepository extends Repository{

    public function __construct(){
        $this->setModel(Usuario::class);
    }

    public static function updateMotivoIndeferimentoTratamentoEspecial(Request $request, $inscricaoId)
    {
        $inscricao = Inscricao::find($inscricaoId);
        $inscricao->tratamento_especial = Inscricao::INDEFERIDO;
        $inscricao->motivo_indeferimento_tratamento_especial = $request->motivo_indeferimento_tratamento_especial;
        $inscricao->save();
    }

    public static function updateStatusTratamentoEspecial($request, $id)
    {
        $inscricao = Inscricao::find($id);
        $inscricao->tratamento_especial = (integer) $request->tratamento_especial;
        $inscricao->save();
    }

    public static function buscarPorResidenciaECidade($residenciaId, $cidadeId)
    {
        $query = app(Usuario::class)->newQuery();
        $query->join('inscricoes', 'inscricoes.usuario_id', '=', 'usuarios.id');
        $query->where(function($q) use($cidadeId, $residenciaId){
            $q->where('cidade_id', '=', $cidadeId)
                ->where('residencia_id', '=', $residenciaId);
        });
        $query->where(function($q){
            $q->where('status_pedido_isencao', '=', Inscricao::DEFERIDO)
            ->orWhere('status_dae', '=', 1);
        });
        $query->orderBy('usuarios.nome');
        $query->select('inscricoes.id', 'nome', 'cpf', 'cidade_id', 'residencia_id');

        return $query->paginate(30);
    }
}