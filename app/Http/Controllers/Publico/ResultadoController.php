<?php

namespace App\Http\Controllers\Publico;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Polo;
use App\Models\Curso;
use App\Models\CursoPolo;
use App\Models\Retificacao;
use App\Models\Config;
use DB;
use PDF;

class ResultadoController extends Controller{

    private $campi;
    private $config;

    public function __construct(){
        $this->campi = Polo::all();
        $this->config = Config::all()->first();
    }

    // Chama a view de resultado preliminar
    public function showFormResultadoPreliminar(){
        return view('publico.resultado.form_preliminar', ['campi' => $this->campi]);
    }

    // Chama a view de resultado final
    public function showFormResultadoFinal(){
        return view('publico.resultado.form_final', ['campi' => $this->campi]);
    }

    // Gera o resultado preliminar e a lista de indeferidos + motivos, de acordo com os filtros
    public function gerarResultadoPreliminar(Request $request){

        if(date('Y-m-d H:i') > formatarDataHoraExtensoUSA($this->config->inicio_resultado_preliminar)):

            // Arrays de retorno para view do resultado preliminar
            $resultado_limite_vagas = [];
            $resultado_alem_limite_vagas = [];

            $curso_polo = CursoPolo::find($request->curso_polo_id);

            $curso = Curso::find($curso_polo->curso_id);
            $campus = Polo::find($curso_polo->polo_id);

            /*** Calcula o limit/offset do Resultado além do limite de vagas ***/

            // Pega a quantidade de deferidos no campus-curso
            $quantidade_deferidos = DB::table('resultado_preliminar')->where('cursos_polos_id', $request->curso_polo_id)->count();

            // O novo limite é definido pela subtração da quantidade total de deferidos pela quantidade de vagas
            // O offset será a quantidade de vagas
            $novo_limit = $quantidade_deferidos - $curso_polo->vagas;

            // Se a quantidade de aprovados é maior que as vagas disponíveis
            if($quantidade_deferidos > $curso_polo->vagas){

                $resultado_limite_vagas = DB::table('resultado_preliminar')
                    ->join('usuarios', 'usuarios.id', '=', 'resultado_preliminar.usuarios_id')
                    ->join('inscricoes', 'inscricoes.usuarios_id', '=', 'usuarios.id')
                    // dae paga
                    ->where('inscricoes.status_dae', '=', 1)
                    // envelope1 teve sua documentação deferida
                    ->where('inscricoes.status_envelope1', '=', 2)
                    // envelope2 foi recebido
                    ->where('inscricoes.status_envelope2', '=', 1)
                    ->where('resultado_preliminar.cursos_polos_id', '=', $request->curso_polo_id)
                    ->orderBy('usuarios.media', 'desc')
                    ->orderBy('usuarios.qtd_disc_falta', 'asc')
                    ->orderBy('usuarios.data_nasc', 'asc')
                    ->limit($curso_polo->vagas)
                    ->select(
                        'usuarios.nome',
                        'usuarios.rg',
                        'usuarios.media',
                        'resultado_preliminar.created_at',
                        'resultado_preliminar.updated_at'
                    )
                    ->get();

                $resultado_alem_limite_vagas = DB::table('resultado_preliminar')
                    ->join('usuarios', 'usuarios.id', '=', 'resultado_preliminar.usuarios_id')
                    ->join('inscricoes', 'inscricoes.usuarios_id', '=', 'usuarios.id')
                    ->where('inscricoes.status_dae', '=', 1)
                    ->where('inscricoes.status_envelope1', '=', 2)
                    ->where('inscricoes.status_envelope2', '=', 1)
                    ->where('resultado_preliminar.cursos_polos_id', '=', $request->curso_polo_id)
                    ->orderBy('usuarios.media', 'desc')
                    ->orderBy('usuarios.qtd_disc_falta', 'asc')
                    ->orderBy('usuarios.data_nasc', 'asc')
                    ->offset($curso_polo->vagas)
                    ->limit($novo_limit)
                    ->select(
                        'usuarios.nome',
                        'usuarios.rg',
                        'usuarios.media'
                    )
                    ->get();
            }

            // A quantidade de candidatos aprovados não ultrapassou a quantidade de vagas disponível para o curso_polo
            elseif($quantidade_deferidos <= $curso_polo->vagas){

                $resultado_limite_vagas = DB::table('resultado_preliminar')
                    ->join('usuarios', 'usuarios.id', '=', 'resultado_preliminar.usuarios_id')
                    ->join('inscricoes', 'inscricoes.usuarios_id', '=', 'usuarios.id')
                    ->where('inscricoes.status_dae', '=', 1)
                    ->where('inscricoes.status_envelope1', '=', 2)
                    ->where('inscricoes.status_envelope2', '=', 1)
                    ->where('resultado_preliminar.cursos_polos_id', '=', $request->curso_polo_id)
                    ->orderBy('usuarios.nome', 'asc')
                    ->limit($curso_polo->vagas)
                    ->select(
                        'usuarios.nome',
                        'usuarios.rg',
                        'usuarios.media',
                        'resultado_preliminar.created_at',
                        'resultado_preliminar.updated_at'
                    )
                    ->get();

                $mais_vagas_que_candidatos = TRUE;
            }

            $candidatos_indeferidos = DB::table('indeferidos')
                ->join('usuarios', 'usuarios.id', '=', 'indeferidos.usuarios_id')
                ->join('inscricoes', 'inscricoes.usuarios_id', '=', 'usuarios.id')
                ->join('recursos', 'recursos.inscricoes_id', '=', 'inscricoes.id')
                ->where('inscricoes.status_dae', '=', 1)
                ->where('inscricoes.status_envelope1', '=', 3)
                ->where('inscricoes.status_envelope2', '=', 1)
                ->whereNotNull('recursos.motivo_indeferimento_etapa1')
                ->where('indeferidos.cursos_polos_id', '=', $request->curso_polo_id)
                ->orderBy('usuarios.nome', 'asc')
                ->select(
                    'inscricoes.id',
                    'usuarios.nome',
                    'usuarios.rg',
                    'recursos.motivo_indeferimento_etapa1'
                )
                ->get();

            $retificacoes = Retificacao::where('tipo', 1)->where('cursos_polos_id', $request->curso_polo_id)->orderBy('created_at', 'desc')->get();

            $pdf = PDF::loadView('publico.resultado.pdf_resultado_preliminar', compact('resultado_limite_vagas', 'resultado_alem_limite_vagas', 'curso', 'campus', 'curso_polo', 'mais_vagas_que_candidatos', 'candidatos_indeferidos', 'retificacoes'));

            $pdf->setPaper('A4');

            return $pdf->stream('resultado_preliminar.pdf');
        else:
            return redirect()->route('resultado.preliminar')->with('danger', 'Você não está autorizado a acessar a essa página hoje!');
        endif;
    }

    // Gera o resultado final de acordo com os filtros
    public function gerarResultadoFinal(Request $request){

        if(date('Y-m-d H:i') > formatarDataHoraExtensoUSA($this->config->inicio_resultado_final)):

            $resultado_limite_vagas = [];
            $resultado_alem_limite_vagas = [];

            $curso_polo = CursoPolo::find($request->curso_polo_id);

            $curso = Curso::find($curso_polo->curso_id);
            $campus = Polo::find($curso_polo->polo_id);

            $quantidade_deferidos = DB::table('usuarios')
                ->join('inscricoes', 'inscricoes.usuarios_id', '=', 'usuarios.id')
                ->join('cursos_polos', 'cursos_polos.id', '=', 'inscricoes.cursos_polos_id')
                ->where('inscricoes.status_dae', '=', 1)
                ->where('inscricoes.status_envelope1', '=', 2)
                ->where('inscricoes.status_envelope2', '=', 1)
                ->where('cursos_polos.id', '=', $request->curso_polo_id)
                ->count();

            $novo_limit = $quantidade_deferidos - $curso_polo->vagas;

            if($quantidade_deferidos > $curso_polo->vagas){

                $resultado_limite_vagas = DB::table('usuarios')
                    ->join('inscricoes', 'inscricoes.usuarios_id', '=', 'usuarios.id')
                    ->join('cursos_polos', 'cursos_polos.id', '=', 'inscricoes.cursos_polos_id')
                    ->where('inscricoes.status_dae', '=', 1)
                    ->where('inscricoes.status_envelope1', '=', 2)
                    ->where('inscricoes.status_envelope2', '=', 1)
                    ->where('cursos_polos.id', '=', $request->curso_polo_id)
                    ->orderBy('usuarios.media', 'desc')
                    ->orderBy('usuarios.qtd_disc_falta', 'asc')
                    ->orderBy('usuarios.data_nasc', 'asc')
                    ->limit($curso_polo->vagas)
                    ->select(
                        'usuarios.nome',
                        'usuarios.rg',
                        'usuarios.media'
                    )
                    ->get();

                $resultado_alem_limite_vagas = DB::table('usuarios')
                    ->join('inscricoes', 'inscricoes.usuarios_id', '=', 'usuarios.id')
                    ->join('cursos_polos', 'cursos_polos.id', '=', 'inscricoes.cursos_polos_id')
                    ->where('inscricoes.status_dae', '=', 1)
                    ->where('inscricoes.status_envelope1', '=', 2)
                    ->where('inscricoes.status_envelope2', '=', 1)
                    ->where('cursos_polos.id', '=', $request->curso_polo_id)
                    ->orderBy('usuarios.media', 'desc')
                    ->orderBy('usuarios.qtd_disc_falta', 'asc')
                    ->orderBy('usuarios.data_nasc', 'asc')
                    ->limit($novo_limit)
                    ->offset($curso_polo->vagas)
                    ->select(
                        'usuarios.nome',
                        'usuarios.rg',
                        'usuarios.media'
                    )
                    ->get();
            }
            elseif($quantidade_deferidos <= $curso_polo->vagas){

                $resultado_limite_vagas = DB::table('usuarios')
                    ->join('inscricoes', 'inscricoes.usuarios_id', '=', 'usuarios.id')
                    ->join('cursos_polos', 'cursos_polos.id', '=', 'inscricoes.cursos_polos_id')
                    ->where('inscricoes.status_dae', '=', 1)
                    ->where('inscricoes.status_envelope1', '=', 2)
                    ->where('inscricoes.status_envelope2', '=', 1)
                    ->where('cursos_polos.id', '=', $request->curso_polo_id)
                    ->orderBy('usuarios.nome', 'asc')
                    ->select(
                        'usuarios.nome',
                        'usuarios.rg',
                        'usuarios.media'
                    )
                    ->get();

                $mais_vagas_que_candidatos = TRUE;
            }

            $retificacoes = Retificacao::where('tipo', 2)->where('cursos_polos_id', $request->curso_polo_id)->orderBy('created_at', 'desc')->get();

            $pdf = PDF::loadView('publico.resultado.pdf_resultado_final', compact('resultado_limite_vagas', 'resultado_alem_limite_vagas', 'curso', 'campus', 'curso_polo', 'mais_vagas_que_candidatos', 'retificacoes'));

            $pdf->setPaper('A4');

            return $pdf->stream('resultado_final.pdf');
        else:
            return redirect()->route('resultado.final')->with('danger', 'Você não está autorizado a acessar a essa página hoje!');
        endif;
    }

    // Retorna os cursos de um determinado campus
    public function getCursosCampus(Request $request){

        if(!empty($request->campus)){

            $cursos = DB::table('cursos_polos')
                            ->join('cursos', 'cursos.id', '=', 'cursos_polos.curso_id')
                            ->where('cursos_polos.polo_id', '=', $request->campus)
                            ->select(
                                'cursos_polos.id',
                                'cursos.nome',
                                'cursos_polos.periodo',
                                'cursos_polos.turno',
                                'cursos_polos.vagas'
                            )
                            ->orderBy('cursos.nome')
                            ->get();

            return $cursos;
        }
    }
}
