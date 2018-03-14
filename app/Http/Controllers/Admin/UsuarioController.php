<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Auth;

class UsuarioController extends Controller{

    // CHAMA O FORMULÁRIO COM A LISTAGEM DOS USUÁRIOS ADMINISTRADORES
    public function index(){

        $usuarios = Usuario::where('permissao', '=', 2)->get();

        return view('admin.usuarios.index', compact('usuarios'));
    }

    // CHAMA A VIEW DE ADICIONAR UM NOVO ADMINISTRADOR
    public function create(){
        return view('admin.usuarios.create');
    }

    // INSERI UM NOVO ADMINISTRADOR
    public function store(Request $request){

        $this->validate($request, [
            'nome' => 'required|string|max:100',
            'email' => 'required|string|email|max:100|unique:usuarios',
            'password' => 'required|string|min:6',
            'cpf' => 'required|min:11|max:11|unique:usuarios'
        ]);

        Usuario::create([
            'nome' => strtoupper($request->nome),
            'email' => $request->email,
            'cpf' => $request->cpf,
            'password' => bcrypt($request->password),
            'permissao' => 2
        ]);

        return redirect()->route('admin.usuarios.home')->with('success', 'Administrador cadastrado com sucesso!');
    }

    // EXCLUI UM ADMINISTRADOR CONTANTO QUE NÃO HAJA SOMENTE UM ADMINISTRADOR CADASTRADO OU SE O ADMINISTRADOR EXCLUÍDO SEJA O PRÓPRIO USUÁRIO LOGADO QUE ESTEJA TENTANDO EXCLUIR
    public function destroy($id){

        $admins = Usuario::where('permissao', '=', 2)->count();

        if($admins > 1){

            if(Auth::user()->id != $id){

                $usuario = Usuario::find($id);
                $usuario->delete();

                return redirect()->back()->with('success', 'Administrador excluído com sucesso!');
            }else{
                return redirect()->back()->with('danger', 'Você não pode excluir seu próprio usuário!');
            }
        }else{
            return redirect()->back()->with('danger', 'É necessário ter pelo menos um administrador cadastrado no sistema!');
        }
    }
}
