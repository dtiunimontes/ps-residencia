<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Curso;
use DB;

class CursosController extends Controller{

    public function index(){
        $cursos = Curso::orderBy('nome')->simplePaginate(15);
        return view('admin.cursos.home', compact('cursos'));
    }

    // RETORNA UM CURSO/POLO PELO CÓDIGO DO CURSO/POLO - AJAX - PÁGINA DE INSCRIÇÃO
    public function getInfoCurso(Request $request){

        if(!empty($request->codigo)){

            $curso = DB::table('cursos_polos')
                            ->join('cursos', 'cursos.id', '=', 'cursos_polos.curso_id')
                            ->join('polos', 'polos.id', '=', 'cursos_polos.polo_id')
                            ->where('cursos_polos.id', '=', $request->codigo)
                            ->select(
                                'cursos.nome as nome_curso',
                                'polos.nome as polo_nome',
                                'cursos_polos.periodo',
                                'cursos_polos.turno'
                            )
                            ->get()->first();

            if(!empty($curso)){
                echo $curso->polo_nome .' - '. $curso->nome_curso .' - '. $curso->periodo .'º PERÍODO - '. strtoupper($curso->turno);
            }else{
                echo 'erro';
            }
        }else{
            echo 'erro';
        }
    }

    public function create(){
        return view('admin.cursos.adicionar');
    }

    public function store(Request $request){
        $this->validate($request, [
            'nome' => 'string|required',
        ]);
        $curso = Curso::create([
            'nome' => $request['nome']
        ]);
        if($curso){
            return redirect()->route('admin.cursos.home')->with('success', "Curso adicionado com sucesso!");
        }else{
            return redirect()->route('admin.cursos.home')->with('danger', "Ocorreu um erro, o curso não pôde ser adicionado!");
        }
    }

    public function show($id){
        return view('admin.cursos.ver_editar', ['curso' => Curso::findOrFail($id), 'ver' => 1, 'titulo' => 'Ver Curso']);
    }

    public function edit($id){
        return view('admin.cursos.ver_editar', ['curso' => Curso::findOrFail($id), 'ver' => 0, 'titulo' => 'Editar Curso']);
    }

    public function update(Request $request, $id){
        $curso = Curso::where('id', $id)
            ->update([
                'nome' => $request['nome'],
              ]);
        if($curso){
            return redirect()->route('admin.cursos.home')->with('success', "Curso editado com sucesso!");
        }else{
            return redirect()->route('admin.cursos.home')->with('danger', "Ocorreu um erro, o curso não pôde ser editado!");
        }
    }

    public function destroy($id){
        $curso = Curso::find($id)->delete();
        if($curso){
            return redirect()->route('admin.cursos.home')->with('success', "Curso excluído com sucesso!");
        }else{
            return redirect()->route('admin.cursos.home')->with('danger', "Ocorreu um erro, o curso não pôde ser excluído!");
        }
    }
}
