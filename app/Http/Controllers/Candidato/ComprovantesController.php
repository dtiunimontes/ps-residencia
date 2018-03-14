<?php

namespace App\Http\Controllers\Candidato;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use PDF;

class ComprovantesController extends Controller{

    public function index(){

        $id_usuario = Auth::id();

        $inscricao = DB::table('inscricoes')
                        ->join('usuarios', 'usuarios.id', '=', 'inscricoes.usuarios_id')
                        ->join('cursos_polos', 'cursos_polos.id', '=', 'inscricoes.cursos_polos_id')
                        ->join('cursos', 'cursos.id', '=', 'cursos_polos.curso_id')
                        ->join('polos', 'polos.id', '=', 'cursos_polos.polo_id')
                        ->where('inscricoes.usuarios_id', '=', $id_usuario)
                        ->select(
                            'cursos.nome as nome_curso',
                            'polos.nome as nome_polo',
                            'cursos_polos.turno',
                            'cursos_polos.periodo',
                            'cursos_polos.id as codigo',
                            'usuarios.nome as nome_candidato',
                            'inscricoes.id as num_inscricao'
                        )->first();

        $pdf = PDF::loadView('candidato.comprovantes.index', compact('inscricao'));

        return $pdf->stream('comprovantes.pdf');
    }
}
