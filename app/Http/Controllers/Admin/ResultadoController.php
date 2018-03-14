<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CursoPolo;
use DB;
use App\Models\Indeferido;
use App\Models\ResultadoPreliminar;
use App\Models\Retificacao;

class ResultadoController extends Controller{

    // Chama o form que gera o Resultado Preliminar
    public function index(){
        return view('admin.resultado.preliminar');
    }

    /**
     * Gera a lista com o resultado preliminar de todos os campus_curso
     * Gera a lista com os indeferidos de todos os campus_curso
     **/
    public function gerarResultadoPreliminar(){

        $campus_cursos = CursoPolo::all();

        $count_resultado_preliminar = ResultadoPreliminar::count();

        if(count($count_resultado_preliminar) > 0){
            ResultadoPreliminar::truncate();
            Indeferido::truncate();
        }

        $candidatos_deferidos = [];

        // Pega os candidatos aprovados em cada campus_curso
        foreach($campus_cursos as $cc){
            $candidatos_deferidos[] = DB::table('usuarios')
                ->join('inscricoes', 'inscricoes.usuarios_id', '=', 'usuarios.id')
                ->join('cursos_polos', 'cursos_polos.id', '=', 'inscricoes.cursos_polos_id')
                ->where('inscricoes.status_dae', '=', 1)
                ->where('inscricoes.status_envelope1', '=', 2)
                ->where('inscricoes.status_envelope2', '=', 1)
                ->where('cursos_polos.id', '=', $cc->id)
                ->orderBy('usuarios.media', 'desc')
                ->orderBy('usuarios.qtd_disc_falta', 'asc')
                ->orderBy('usuarios.data_nasc', 'asc')
                ->select('usuarios.id as candidato_id', 'cursos_polos.id as cursos_polos_id')
                ->get();

            $candidatos_indeferidos[] = DB::table('usuarios')
                ->join('inscricoes', 'inscricoes.usuarios_id', '=', 'usuarios.id')
                ->join('recursos', 'recursos.inscricoes_id', '=', 'inscricoes.id')
                ->join('cursos_polos', 'cursos_polos.id', '=', 'inscricoes.cursos_polos_id')
                ->where('inscricoes.status_dae', '=', 1)
                ->where('inscricoes.status_envelope1', '=', 3)
                ->where('inscricoes.status_envelope2', '=', 1)
                ->whereNotNull('recursos.motivo_indeferimento_etapa1')
                ->where('cursos_polos.id', '=', $cc->id)
                ->orderBy('usuarios.nome', 'asc')
                ->select('usuarios.id as candidato_id', 'cursos_polos.id as cursos_polos_id')
                ->get();
        }

        // Insere os candidatos aprovados na tabela de resultado_preliminar
        foreach($candidatos_deferidos as $candidatos){
            foreach($candidatos as $candidato){
                ResultadoPreliminar::create([
                    'cursos_polos_id' => $candidato->cursos_polos_id,
                    'usuarios_id' => $candidato->candidato_id
                ]);
            }
        }

        // Insere os candidatos aprovados na tabela de resultado_preliminar
        foreach($candidatos_indeferidos as $candidatos){
            foreach($candidatos as $candidato){
                Indeferido::create([
                    'cursos_polos_id' => $candidato->cursos_polos_id,
                    'usuarios_id' => $candidato->candidato_id
                ]);
            }
        }

        return redirect()->route('admin.resultado.preliminar.home')->with('success', 'Resultado Preliminar gerado com sucesso!');
    }

    public function showFormRetificacaoResultadoPreliminar(){

        $retificacoes = Retificacao::where('tipo', 1)->orderBy('created_at', 'desc')->get();

        return view('admin.resultado.retificacoes.preliminar', compact('retificacoes'));
    }

    public function showFormRetificacaoResultadoFinal(){

        $retificacoes = Retificacao::where('tipo', 2)->orderBy('created_at', 'desc')->get();

        return view('admin.resultado.retificacoes.final', compact('retificacoes'));
    }

    public function criarRetificacaoResultado(Request $request){

        if($request->resultado == 1){

            Retificacao::create([
                'cursos_polos_id' => $request->cursos_polos_id,
                'tipo' => 1
            ]);

            return redirect()->route('admin.resultado.preliminar.form')->with('success', 'Retificação criada com sucesso!');
        }

        elseif($request->resultado == 2){

            Retificacao::create([
                'cursos_polos_id' => $request->cursos_polos_id,
                'tipo' => 2
            ]);

            return redirect()->route('admin.resultado.final.form')->with('success', 'Retificação criada com sucesso!');
        }
    }
}
