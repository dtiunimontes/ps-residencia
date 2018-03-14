<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inscricao extends Model{

    const DEFERIDO = 2;
    const INDEFERIDO = 1;

    protected $table = 'inscricoes';

    protected $fillable = [
        'pediu_isencao',
        'status_pedido_isencao',
        'nota_primeira_etapa',
        'nota_segunda_etapa',
        'status_segunda_etapa',
        'usuario_id',
        'residencia_id',
        'cidade_id',
        'status_dae',
        'num_dae',
        'vencimento',
        'mes_referencia',
    ];

    public function cidade(){
        return $this->belongsTo(Cidades::class, 'cidade_id');
    }

    public function residencia(){
        return $this->belongsTo(Residencia::class, 'residencia_id');
    }

    public function usuario(){
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }
}
