<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Recurso;
use App\Models\Inscricao;
use DB;

class RecursoController extends Controller{

    private $recurso;

    public function __construct(Recurso $recurso){
        $this->recurso = $recurso;
    }

    public function index(){

        $inscricoes_indeferidas_pendentes = DB::table('inscricoes')
                                    ->join('recursos', 'recursos.inscricoes_id', '=', 'inscricoes.id')
                                    ->where('recursos.enviou_recurso', '=', 1)
                                    // ->whereNull('recursos.recurso_etapa1')
                                    // ->whereNull('recursos.recurso_etapa2')
                                    // ->orWhereNull('recursos.resposta_recurso_etapa1')
                                    ->whereNull('recursos.resposta_recurso_etapa1')
                                    // ->where('status_envelope1', '=', 3)
                                    // ->where('status_envelope2', '=', 1)
                                    ->count();

        $inscricoes_indeferidas_lancadas = DB::table('inscricoes')
                                    ->join('recursos', 'recursos.inscricoes_id', '=', 'inscricoes.id')
                                    ->where('recursos.enviou_recurso', '=', 1)
                                    // ->whereNotNull('recursos.recurso_etapa1')
                                    ->whereNotNull('recursos.resposta_recurso_etapa1')
                                    // ->where('status_envelope1', '<>', 0)
                                    // ->where('status_envelope1', '<>', 1)
                                    // ->where('status_envelope2', '=', 1)
                                    ->count();

        return view('admin.recursos.index', compact('inscricoes_indeferidas_pendentes', 'inscricoes_indeferidas_lancadas'));
    }

    public function showInscricoesIndeferidasEnvelope1(){

        $inscricoes = DB::table('inscricoes')
                                    ->join('recursos', 'recursos.inscricoes_id', '=', 'inscricoes.id')
                                    ->join('usuarios', 'usuarios.id', '=', 'inscricoes.usuarios_id')
                                    ->join('cursos_polos', 'cursos_polos.id', '=', 'inscricoes.cursos_polos_id')
                                    ->join('cursos', 'cursos.id', '=', 'cursos_polos.curso_id')
                                    ->join('polos', 'polos.id', '=', 'cursos_polos.polo_id')
                                    ->where('recursos.enviou_recurso', '=', 1)
                                    ->where('status_envelope1', '=', 3)
                                    ->where('status_envelope2', '=', 1)
                                    ->select(
                                        'inscricoes.id as inscricao',
                                        'usuarios.nome as candidato_nome',
                                        'cursos.nome as curso_nome',
                                        'polos.nome as campus_nome',
                                        'cursos_polos.id as codigo_campus_curso',
                                        'recursos.recurso_etapa1',
                                        'recursos.resposta_recurso_etapa1'
                                    )
                                    ->get();

        return view('admin.recursos.envelope1_indeferidos', compact('inscricoes'));
    }

    public function verRecurso($id){

        $recurso = $this->recurso->where('inscricoes_id', '=', $id)->first();

        return view('admin.recursos.ver', compact('recurso'));
    }

    public function lancarRecurso(Request $request, $id){

        $recurso = Recurso::find($id);

        if($request->tipo_recurso == 'nota'){

            $recurso->recurso_etapa2 = $request->recurso;
            $recurso->data_recurso_etapa2 = date('Y-m-d H:i:s');

            if($recurso->save()){
                return redirect()->route('admin.recursos.envelope2.notas.ver', $recurso->inscricoes_id)->with('success', 'Recurso lançado com sucesso!');
            }
        }

        elseif(empty($request->tipo_recurso)){

            $recurso->recurso_etapa1 = $request->recurso;
            $recurso->data_recurso_etapa1 = date('Y-m-d H:i:s');

            if($recurso->save()){
                return redirect()->route('admin.recursos.envelope1.inscricoes.indeferidas.ver.recurso', $recurso->inscricoes_id)->with('success', 'Recurso lançado com sucesso!');
            }
        }
    }

    public function responderRecurso(Request $request, $id){

        $recurso = Recurso::find($id);

        if($request->tipo_recurso == 'nota'){

            $recurso->resposta_recurso_etapa2 = $request->resposta_recurso;
            $recurso->autor_resposta_recurso_etapa2 = $request->autor_resposta_recurso;
            $recurso->data_resposta_recurso_etapa2 = date('Y-m-d H:i:s');

            if($recurso->save()){
                return redirect()->route('admin.recursos.envelope2.notas')->with('success', 'Recurso respondido com sucesso!');
            }
        }

        elseif(empty($request->tipo_recurso)){

            $recurso->resposta_recurso_etapa1 = $request->resposta_recurso;
            $recurso->autor_resposta_recurso_etapa1 = $request->autor_resposta_recurso;
            $recurso->data_resposta_recurso_etapa1 = date('Y-m-d H:i:s');

            if($recurso->save()){
                return redirect()->route('admin.recursos.envelope1.inscricoes.indeferidas')->with('success', 'Recurso respondido com sucesso!');
            }
        }
    }

    public function buscarInscricoes(Request $request){

        if($request->pagina == 'pendentes'){

            $inscricoes = DB::table('inscricoes')
                            ->join('recursos', 'recursos.inscricoes_id', '=', 'inscricoes.id')
                            ->join('usuarios', 'usuarios.id', '=', 'inscricoes.usuarios_id')
                            ->join('cursos_polos', 'cursos_polos.id', '=', 'inscricoes.cursos_polos_id')
                            ->join('cursos', 'cursos.id', '=', 'cursos_polos.curso_id')
                            ->join('polos', 'polos.id', '=', 'cursos_polos.polo_id')
                            ->whereNull('recursos.recurso_etapa1')
                            ->whereNull('recursos.resposta_recurso_etapa1')
                            ->where('status_envelope1', '=', 3)
                            ->where('status_envelope2', '=', 1)
                            ->where('inscricoes.id', $request->inscricao)
                            ->select(
                                'inscricoes.id as inscricao',
                                'usuarios.nome as candidato_nome',
                                'cursos.nome as curso_nome',
                                'polos.nome as campus_nome',
                                'cursos_polos.id as codigo_campus_curso'
                            )
                            ->get();

            return view('admin.recursos.envelope1_indeferidos', compact('inscricoes'));
        }

        elseif($request->pagina == 'lancados'){

            $inscricoes = DB::table('inscricoes')
                            ->join('recursos', 'recursos.inscricoes_id', '=', 'inscricoes.id')
                            ->join('usuarios', 'usuarios.id', '=', 'inscricoes.usuarios_id')
                            ->join('cursos_polos', 'cursos_polos.id', '=', 'inscricoes.cursos_polos_id')
                            ->join('cursos', 'cursos.id', '=', 'cursos_polos.curso_id')
                            ->join('polos', 'polos.id', '=', 'cursos_polos.polo_id')
                            ->whereNotNull('recursos.recurso_etapa1')
                            ->whereNotNull('recursos.resposta_recurso_etapa1')
                            ->where('status_envelope1', '<>', 0)
                            ->where('status_envelope1', '<>', 1)
                            ->where('status_envelope2', '=', 1)
                            ->where('inscricoes.id', $request->inscricao)
                            ->select(
                                'inscricoes.id as inscricao',
                                'usuarios.nome as candidato_nome',
                                'cursos.nome as curso_nome',
                                'polos.nome as campus_nome',
                                'cursos_polos.id as codigo_campus_curso'
                            )
                            ->get();

            return view('admin.recursos.envelope1_indeferidos_lancados', compact('inscricoes'));
        }
    }

    public function showInscricoesIndeferidasEnvelope1Lancadas(){

        $inscricoes = DB::table('inscricoes')
                                    ->join('recursos', 'recursos.inscricoes_id', '=', 'inscricoes.id')
                                    ->join('usuarios', 'usuarios.id', '=', 'inscricoes.usuarios_id')
                                    ->join('cursos_polos', 'cursos_polos.id', '=', 'inscricoes.cursos_polos_id')
                                    ->join('cursos', 'cursos.id', '=', 'cursos_polos.curso_id')
                                    ->join('polos', 'polos.id', '=', 'cursos_polos.polo_id')
                                    // ->whereNotNull('recursos.recurso_etapa1')
                                    ->whereNotNull('recursos.resposta_recurso_etapa1')
                                    ->where('status_envelope1', '<>', 0)
                                    ->where('status_envelope1', '<>', 1)
                                    ->where('status_envelope2', '=', 1)
                                    ->select(
                                        'inscricoes.id as inscricao',
                                        'usuarios.nome as candidato_nome',
                                        'cursos.nome as curso_nome',
                                        'polos.nome as campus_nome',
                                        'cursos_polos.id as codigo_campus_curso'
                                    )
                                    ->get();

        return view('admin.recursos.envelope1_indeferidos_lancados', compact('inscricoes'));
    }

    public function showInscricoesNotasEnvelope2(){

        $inscricoes = DB::table('inscricoes')
                        ->leftjoin('recursos', 'recursos.inscricoes_id', '=', 'inscricoes.id')
                        ->join('usuarios', 'usuarios.id', '=', 'inscricoes.usuarios_id')
                        ->join('cursos_polos', 'cursos_polos.id', '=', 'inscricoes.cursos_polos_id')
                        ->join('cursos', 'cursos.id', '=', 'cursos_polos.curso_id')
                        ->join('polos', 'polos.id', '=', 'cursos_polos.polo_id')
                        ->where('status_envelope1', '<>', 0)
                        ->where('status_envelope2', '=', 1)
                        ->orderBy('inscricoes.id', 'asc')
                        ->select(
                            'inscricoes.id as inscricao',
                            'usuarios.nome as candidato_nome',
                            'cursos.nome as curso_nome',
                            'polos.nome as campus_nome',
                            'cursos_polos.id as codigo_campus_curso',
                            'usuarios.media',
                            'recursos.motivo_indeferimento_etapa1',
                            'recursos.recurso_etapa2',
                            'recursos.resposta_recurso_etapa2'
                        )
                        ->get();

        return view('admin.recursos.envelope2_notas', compact('inscricoes'));
    }

    public function editarRecursoLancado($id){

        $recurso = Recurso::where('inscricoes_id', $id)->first();

        return view('admin.recursos.envelope1_indeferidos_lancados_editar', compact('recurso'));
    }

    public function editarRecursoNotas($id){

        $recurso = Recurso::where('inscricoes_id', $id)->first();

        return view('admin.recursos.envelope2_notas_editar', compact('recurso'));
    }

    public function relancarRecurso(Request $request, $id){

        $recurso = Recurso::find($id);

        // $recurso->recurso_etapa1 = $request->recurso_etapa1;
        $recurso->resposta_recurso_etapa1 = $request->resposta_recurso_etapa1;
        $recurso->autor_resposta_recurso_etapa1 = $request->autor_resposta_recurso_etapa1;

        if($recurso->save()){
            return redirect()->route('admin.recursos.envelope1.inscricoes.indeferidas.lancadas')->with('success', 'Recurso editado com sucesso!');
        }
    }

    public function relancarRecursoEnvelope2(Request $request, $id){

        $recurso = Recurso::find($id);

        $recurso->recurso_etapa2 = $request->recurso_etapa2;
        $recurso->resposta_recurso_etapa2 = $request->resposta_recurso_etapa2;
        $recurso->autor_resposta_recurso_etapa2 = $request->autor_resposta_recurso_etapa2;

        if($recurso->save()){
            return redirect()->route('admin.recursos.envelope2.notas')->with('success', 'Recurso editado com sucesso!');
        }
    }

    public function verRecursoNotas($id){

        $recurso = Recurso::firstOrCreate([
            'inscricoes_id' => $id
        ]);

        $recurso = Recurso::find($recurso->id);

        return view('admin.recursos.ver_etapa2', compact('recurso'));
    }

    public function buscarPorInscricao(Request $request){

        switch($request->tipo){

            // Caso a origem da busca seja da página de lançamento de recursos do envelope 1 - Concluído
            case 'envelope1_lancamento':

                $inscricoes =   DB::table('inscricoes')
                                ->join('recursos', 'recursos.inscricoes_id', '=', 'inscricoes.id')
                                ->join('usuarios', 'usuarios.id', '=', 'inscricoes.usuarios_id')
                                ->join('cursos_polos', 'cursos_polos.id', '=', 'inscricoes.cursos_polos_id')
                                ->join('cursos', 'cursos.id', '=', 'cursos_polos.curso_id')
                                ->join('polos', 'polos.id', '=', 'cursos_polos.polo_id')
                                ->whereNull('recursos.recurso_etapa1')
                                ->whereNull('recursos.recurso_etapa2')
                                // ->orWhereNull('recursos.resposta_recurso_etapa1')
                                ->where('status_envelope1', '=', 3)
                                ->where('status_envelope2', '=', 1)
                                ->where('inscricoes.id', $request->inscricao)
                                ->select(
                                    'inscricoes.id as inscricao',
                                    'usuarios.nome as candidato_nome',
                                    'cursos.nome as curso_nome',
                                    'polos.nome as campus_nome',
                                    'cursos_polos.id as codigo_campus_curso',
                                    'recursos.recurso_etapa1',
                                    'recursos.resposta_recurso_etapa1'
                                )
                                ->get();

                return view('admin.recursos.envelope1_indeferidos', compact('inscricoes'));
            break;

            // Caso a origem da busca seja da página de edição de lançamento de recursos do envelope 1 - Concluído
            case 'envelope1_edicao':

                $inscricoes =   DB::table('inscricoes')
                                ->join('recursos', 'recursos.inscricoes_id', '=', 'inscricoes.id')
                                ->join('usuarios', 'usuarios.id', '=', 'inscricoes.usuarios_id')
                                ->join('cursos_polos', 'cursos_polos.id', '=', 'inscricoes.cursos_polos_id')
                                ->join('cursos', 'cursos.id', '=', 'cursos_polos.curso_id')
                                ->join('polos', 'polos.id', '=', 'cursos_polos.polo_id')
                                ->whereNotNull('recursos.recurso_etapa1')
                                ->whereNotNull('recursos.resposta_recurso_etapa1')
                                ->where('status_envelope1', '<>', 0)
                                ->where('status_envelope1', '<>', 1)
                                ->where('status_envelope2', '=', 1)
                                ->where('inscricoes.id', $request->inscricao)
                                ->select(
                                    'inscricoes.id as inscricao',
                                    'usuarios.nome as candidato_nome',
                                    'cursos.nome as curso_nome',
                                    'polos.nome as campus_nome',
                                    'cursos_polos.id as codigo_campus_curso'
                                )
                                ->get();

                return view('admin.recursos.envelope1_indeferidos_lancados', compact('inscricoes'));
            break;

            // Caso a origem da busca seja da página de lançamento de recursos sobre notas do envelope 2 - Concluído
            case 'envelope2_lancamento':

                $inscricoes =   DB::table('inscricoes')
                                ->leftjoin('recursos', 'recursos.inscricoes_id', '=', 'inscricoes.id')
                                ->join('usuarios', 'usuarios.id', '=', 'inscricoes.usuarios_id')
                                ->join('cursos_polos', 'cursos_polos.id', '=', 'inscricoes.cursos_polos_id')
                                ->join('cursos', 'cursos.id', '=', 'cursos_polos.curso_id')
                                ->join('polos', 'polos.id', '=', 'cursos_polos.polo_id')
                                ->where('status_envelope1', '<>', 0)
                                ->where('status_envelope2', '=', 1)
                                ->where('inscricoes.id', $request->inscricao)
                                ->orderBy('inscricoes.id', 'asc')
                                ->select(
                                    'inscricoes.id as inscricao',
                                    'usuarios.nome as candidato_nome',
                                    'cursos.nome as curso_nome',
                                    'polos.nome as campus_nome',
                                    'cursos_polos.id as codigo_campus_curso',
                                    'usuarios.media',
                                    'recursos.motivo_indeferimento_etapa1',
                                    'recursos.recurso_etapa2',
                                    'recursos.resposta_recurso_etapa2'
                                )
                                ->get();

                return view('admin.recursos.envelope2_notas', compact('inscricoes'));
            break;
        }
    }
}
