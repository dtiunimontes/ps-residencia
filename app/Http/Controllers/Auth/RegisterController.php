<?php

namespace App\Http\Controllers\Auth;

use App\Models\Cidades;
use App\Models\Config;
use App\Models\CursoPolo;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RegisterController extends Controller{

    use RegistersUsers;

    protected $redirectTo = '/candidato';

    public function __construct(){
        $this->middleware('guest');
    }

    public function showRegistrationForm(){

        $config = Config::all()->first();
        $cidades = Cidades::all();

        return view('auth.register', compact('cidades', 'config'));
    }

    protected function validator(array $data){
        return Validator::make($data, [
            'nome' => 'required|string|max:100',
            'email' => 'required|string|email|max:100|unique:usuarios',
            'password' => 'required|string|min:6|confirmed',
            'cpf' => 'required|min:11|max:11|unique:usuarios|cpf',
            'rg' => 'required|string|max:20|unique:usuarios',
            'org_exped' => 'required|string|max:20',
            'data_nasc' => 'required',
            'telefone' => 'required|string|max:20',
            'cep' => 'required|max:8',
            'logradouro' => 'required|string|max:80',
            'numero' => 'required|string',
            'cidade' => 'required|string|max:100',
            'bairro' => 'required|string|max:100',
            'estado' => 'required|string|max:2',
            'codigo' => 'required|numeric|min:1|exists:residencias,id',
            'cidade_prova' => 'required|exists:cidades,id',
            'tipo_candidato' => [
                'required',
                Rule::in(['nao_se_aplica', 'estrangeiro', 'br_instituicao_ensino_estrangeira', 'estrangeiro_instituicao_ensino_br']),
            ],
        ]);
    }

    protected function create(array $data){

        list($dia, $mes, $ano) = explode('/', $data['data_nasc']);

        $usuario = (new \App\Models\Usuario)->create([
            'nome' => strtoupper($data['nome']),
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'cpf' => $data['cpf'],
            'rg' => $data['rg'],
            'org_exped' => strtoupper($data['org_exped']),
            'data_nasc' => $ano.'-'.$mes.'-'.$dia,
            'telefone' => $data['telefone'],
            'cep' => $data['cep'],
            'logradouro' => strtoupper($data['logradouro']),
            'numero' => strtoupper($data['numero']),
            'complemento' => strtoupper($data['complemento']),
            'cidade' => strtoupper($data['cidade']),
            'bairro' => strtoupper($data['bairro']),
            'estado' => strtoupper($data['estado']),
            'tipo_candidato' => $data['tipo_candidato'],
        ]);

        (new \App\Models\Inscricao)->create([
            'residencia_id' => $data['codigo'],
            'cidade_id' => $data['cidade_prova'],
            'usuario_id' => $usuario->id,
        ]);

        return $usuario;
    }
}
