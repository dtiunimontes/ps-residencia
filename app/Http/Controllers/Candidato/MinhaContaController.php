<?php

namespace App\Http\Controllers\Candidato;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Auth;
use Hash;

class MinhaContaController extends Controller{

    public function index(){
        $usuario = Usuario::find(Auth::id());
        return view('candidato.minhaconta.dados', compact('usuario'));
    }

    public function formAlterarSenha(){
        return view('candidato.minhaconta.alterar_senha');
    }

    // ALTERA A SENHA DO USUÁRIO LOGADO
    public function alterarSenha(Request $request){

        $usuario_logado = Auth::user();

        if((strlen($request->nova_senha) < 6) OR (strlen($request->confirm_nova_senha) < 6)){
            return redirect()->route('candidato.minhaconta.form.alterar.senha')->with('danger', 'Ooops. A senha deve ter no mínimo 6 caracteres!');
        }

        // VERIFICA SE A SENHA ATUAL INFORMADA PELO CANDIDATO É VÁLIDA
        if(Hash::check($request->senha_atual, $usuario_logado->password)){

            // VERIFICA SE A SENHA E A CONFIRMAÇÃO SÃO IGUAIS
            if(($request->nova_senha == $request->confirm_nova_senha)){

                $usuario = Usuario::find($usuario_logado->id);
                $usuario->password = bcrypt($request->nova_senha);
                $usuario->save();

                return redirect()->route('candidato.minhaconta.form.alterar.senha')->with('success', 'Senha alterada com sucesso!');
            }else{
                return redirect()->route('candidato.minhaconta.form.alterar.senha')->with('danger', 'Ooops. As senhas não correspondem, tente novamente!');
            }
        }else{
            return redirect()->route('candidato.minhaconta.form.alterar.senha')->with('danger', 'Ooops. Essa não é sua senha atual, tente novamente!');
        }
    }

    public function create(){

    }

    public function store(Request $request){
        list($dia, $mes, $ano) = explode('/', $request['data_nasc']);
        $request['data_nasc'] = $ano.'-'.$mes.'-'.$dia;

        $this->validate($request, [
            'nome' => 'required|string|max:80',
            'email' => 'required|string|email|max:45|unique:usuarios,email,'.$request['id'],
            'rg' => 'required|string|max:20|unique:usuarios,rg,'.$request['id'],
            'org_exped' => 'required|string|max:20',
            'data_nasc' => 'required|date',
            'telefone' => 'required|string|max:20',
            'cep' => 'required|max:8',
            'logradouro' => 'required|string|max:100',
            'numero' => 'required|string',
            'cidade' => 'required|string|max:50',
            'bairro' => 'required|string|max:50',
            'estado' => 'required|string|max:2',
        ]);

        $usuario = Usuario::find($request['id']);
        $usuario->nome = strtoupper($request['nome']);
        $usuario->email = $request['email'];
        $usuario->rg = strtoupper($request['rg']);
        $usuario->org_exped = strtoupper($request['org_exped']);
        $usuario->data_nasc = $request['data_nasc'];
        $usuario->telefone = $request['telefone'];
        $usuario->cep = $request['cep'];
        $usuario->logradouro = strtoupper($request['logradouro']);
        $usuario->numero = strtoupper($request['numero']);
        $usuario->complemento = strtoupper($request['complemento']);
        $usuario->cidade = strtoupper($request['cidade']);
        $usuario->bairro = strtoupper($request['bairro']);
        $usuario->estado = strtoupper($request['estado']);
        $usuario->save();

        return redirect()->route('candidato.home')->with('success', 'Dados Salvos com sucesso!');
    }

    public function show($id){

    }

    public function edit($id){

    }

    public function update(Request $request, $id){

    }

    public function destroy($id){

    }
}
