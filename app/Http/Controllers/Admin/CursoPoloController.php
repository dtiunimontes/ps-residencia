<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Curso;
use App\Models\Polo;
use App\Models\CursoPolo;
use DB;

class CursoPoloController extends Controller{

    public function index(){
        
        $cursos_polos = DB::table('cursos_polos')
        ->select(
            'cursos_polos.id as codigo',
            'polos.nome as polo',
            'cursos.nome as curso',
            'periodo',
            'vagas',
            'turno'
        )
        ->join('polos', 'polo_id', '=', 'polos.id')
        ->join('cursos', 'curso_id', '=', 'cursos.id')
        ->where('cursos_polos.deleted_at', NULL)
        ->orderBy('codigo')
        ->simplePaginate(15);

        return view('admin.curso_polo.home', compact('cursos_polos'));
    }

    public function create(){

        $cursos = Curso::orderBy('nome')->get();
        $polos = Polo::orderBy('nome')->get();

        return view('admin.curso_polo.adicionar', compact('polos', 'cursos'));
    }

    public function store(Request $request){

        $curso = Curso::find($request['curso_id']);
        $polo = Polo::find($request['polo_id']);

        $curso_polo = CursoPolo::create([
            'id'       => $request['codigo'],
            'polo_id'  => $request['polo_id'],
            'curso_id' => $request['curso_id'],
            'vagas'    => $request['vagas'],
            'periodo'  => $request['periodo'],
            'turno'    => $request['turno'],
          ]);

        if($curso_polo){
            return redirect()->route('admin.curso_polo.home')->with('success', "Campus vinculado ao curso com sucesso!");
        }else{
            return redirect()->route('admin.curso_polo.home')->with('danger', "Ocorreu um erro, o campus não pôde ser vinculado ao curso!");
        }
    }

    public function show($id){

        $curso_polo = CursoPolo::find($id);
        $cursos = Curso::orderBy('nome')->get();
        $polos = Polo::orderBy('nome')->get();

        $ver = 1;

        return view('admin.curso_polo.ver_editar', compact('curso_polo', 'polos', 'cursos', 'ver'));
    }

    public function edit($id){

        $curso_polo = CursoPolo::find($id);
        $cursos = Curso::orderBy('nome')->get();
        $polos = Polo::orderBy('nome')->get();

        $ver = 0;

        return view('admin.curso_polo.ver_editar', compact('curso_polo', 'polos', 'cursos', 'ver'));
    }

    public function update(Request $request, $id){

        $curso_polo = CursoPolo::where('id', $id)
            ->update([
                'polo_id'  => $request['polo_id'],
                'curso_id' => $request['curso_id'],
                'vagas'    => $request['vagas'],
                'periodo'  => $request['periodo'],
                'turno'    => $request['turno'],
              ]);

        if($curso_polo){
            return redirect()->route('admin.curso_polo.home')->with('success', "Edição de vinculação do campus ao curso realizada com sucesso!");
        }else{
            return redirect()->route('admin.curso_polo.home')->with('danger', "Ocorreu um erro, a edição não pôde ser realizada!");
        }
    }

    public function destroy($id){

        $curso_polo = CursoPolo::find($id)->delete();

        if($curso_polo){
            return redirect()->route('admin.curso_polo.home')->with('success', "Curso excluído com sucesso!");
        }else{
            return redirect()->route('admin.curso_polo.home')->with('danger', "Ocorreu um erro, o curso não pôde ser excluído!");
        }
    }
}
