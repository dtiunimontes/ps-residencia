<?php

namespace App\Models;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable{

    use Notifiable;

    const CANDIDATO = 1;
    const ADMIN = 2;

    protected $table = 'usuarios';

    protected $fillable = [
        'nome', 'cpf', 'email', 'password', 'rg', 'org_exped', 'data_nasc','telefone', 'necessidade_especial', 'cep',
        'logradouro', 'numero', 'complemento', 'cidade', 'bairro', 'estado', 'permissao', 'tipo_candidato',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function inscricao()
    {
        return $this->hasOne(Inscricao::class, 'usuario_id');
    }

    public function scopeCantidato($query, $id)
    {
        return $query->where('id', $id);
    }
}
