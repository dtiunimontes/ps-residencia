<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Polo;

class PolosController extends Controller{

    public function index(){

        $polos = Polo::orderBy('nome')->simplePaginate(15);

        return view('admin.polos.home', compact('polos'));
    }

    public function create(){
        return view('admin.polos.adicionar');
    }

    public function store(Request $request){

        $this->validate($request, [
            'nome' => 'string|required',
        ]);

        $polo = Polo::create([
            'nome' => $request['nome']
        ]);

        if($polo){
            return redirect()->route('admin.polos.home')->with('success', "Polo adicionado com sucesso!");
        }else{
            return redirect()->route('admin.polos.home')->with('danger', "Ocorreu um erro, o polo não pôde ser adicionado!");
        }
    }

    public function show($id){
        return view('admin.polos.ver_editar', ['polo' => Polo::findOrFail($id), 'ver' => 1, 'titulo' => 'Ver Campus']);
    }

    public function edit($id){
        return view('admin.polos.ver_editar', ['polo' => Polo::findOrFail($id), 'ver' => 0, 'titulo' => 'Editar Campus']);
    }

    public function update(Request $request, $id){

        $polo = Polo::where('id', $id)->update([
            'nome' => $request['nome'],
        ]);

        if($polo){
            return redirect()->route('admin.polos.home')->with('success', "Campus editado com sucesso!");
        }else{
            return redirect()->route('admin.polos.home')->with('danger', "Ocorreu um erro, o campus não pôde ser editado!");
        }
    }

    public function destroy($id){

        $polo = Polo::find($id)->delete();
        
        if($polo){
            return redirect()->route('admin.polos.home')->with('success', "Campus excluído com sucesso!");
        }else{
            return redirect()->route('admin.polos.home')->with('danger', "Ocorreu um erro, o campus não pôde ser excluído!");
        }
    }
}
