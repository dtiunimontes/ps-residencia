<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Models\Inscricao;
use App\Models\Recurso;
use App\Models\Usuario;

class InscricoesController extends Controller{

    // Lista todas as inscrições no Processo Seletivo (Pendentes, Confirmadas, Deferidas, Indeferidas)
    public function index(){

        $qtd_inscricoes = Inscricao::count();

        $inscricoes = DB::table('usuarios')
                        ->join('inscricoes', 'inscricoes.usuarios_id', '=', 'usuarios.id')
                        ->join('cursos_polos', 'cursos_polos.id', '=', 'inscricoes.cursos_polos_id')
                        ->join('cursos', 'cursos.id', '=', 'cursos_polos.curso_id')
                        ->join('polos', 'polos.id', '=', 'cursos_polos.polo_id')
                        ->select(
                            'usuarios.id as candidato_id',
                            'usuarios.nome',
                            'usuarios.cpf',
                            'usuarios.rg',
                            'inscricoes.id',
                            'cursos.nome as curso_nome',
                            'polos.nome as polo_nome',
                            'cursos_polos.id as codigo',
                            'cursos_polos.turno as turno',
                            'cursos_polos.periodo as periodo',
                            DB::raw("
                                CASE inscricoes.status_envelope1
                                    WHEN 0 THEN 'Envelope Pendente'
                                    WHEN 1 THEN 'Envelope Entregue'
                                    WHEN 2 THEN 'Documentação Deferida'
                                    WHEN 3 THEN 'Documentação Indeferida'
                                END as status_envelope1
                            "),
                            DB::raw("
                                CASE inscricoes.status_envelope2
                                    WHEN 0 THEN 'Envelope Pendente'
                                    WHEN 1 THEN 'Envelope Entregue'
                                END as status_envelope2
                            "),
                            'inscricoes.status_dae'
                        )
                        ->orderBy('inscricoes.id', 'asc')
                        ->paginate(50);

        return view('admin.inscricoes.index', compact('inscricoes', 'qtd_inscricoes'));
    }

    // Realiza uma busca com parâmetros no geral (inscrição, CPF e nome).
    public function buscar(Request $request){

        if(empty($request->nome) AND empty($request->inscricao) AND empty($request->cpf)){
            return redirect()->route('admin.inscricoes.home');
        }

        $qtd_inscricoes = Inscricao::count();

        if(!empty($request->nome)){

            $inscricoes = DB::table('usuarios')
                            ->join('inscricoes', 'inscricoes.usuarios_id', '=', 'usuarios.id')
                            ->join('cursos_polos', 'cursos_polos.id', '=', 'inscricoes.cursos_polos_id')
                            ->join('cursos', 'cursos.id', '=', 'cursos_polos.curso_id')
                            ->join('polos', 'polos.id', '=', 'cursos_polos.polo_id')
                            ->where('inscricoes.id', '=', $request->inscricao)
                            ->orWhere('usuarios.cpf', '=', $request->cpf)
                            ->orWhere('usuarios.nome', 'like', "%".$request->nome."%")
                            ->select(
                                'usuarios.id as candidato_id',
                                'usuarios.nome',
                                'usuarios.cpf',
                                'usuarios.rg',
                                'inscricoes.id',
                                'cursos.nome as curso_nome',
                                'polos.nome as polo_nome',
                                'cursos_polos.id as codigo',
                                'cursos_polos.turno as turno',
                                'cursos_polos.periodo as periodo',
                                DB::raw("
                                    CASE inscricoes.status_envelope1
                                        WHEN 0 THEN 'Envelope Pendente'
                                        WHEN 1 THEN 'Envelope Entregue'
                                        WHEN 2 THEN 'Documentação Deferida'
                                        WHEN 3 THEN 'Documentação Indeferida'
                                    END as status_envelope1
                                "),
                                DB::raw("
                                    CASE inscricoes.status_envelope2
                                        WHEN 0 THEN 'Envelope Pendente'
                                        WHEN 1 THEN 'Envelope Entregue'
                                    END as status_envelope2
                                "),
                                'inscricoes.status_dae'
                            )
                            ->orderBy('inscricoes.id', 'asc')
                            ->paginate(50);
        }else{
            $inscricoes = DB::table('usuarios')
                            ->join('inscricoes', 'inscricoes.usuarios_id', '=', 'usuarios.id')
                            ->join('cursos_polos', 'cursos_polos.id', '=', 'inscricoes.cursos_polos_id')
                            ->join('cursos', 'cursos.id', '=', 'cursos_polos.curso_id')
                            ->join('polos', 'polos.id', '=', 'cursos_polos.polo_id')
                            ->where('inscricoes.id', '=', $request->inscricao)
                            ->orWhere('usuarios.cpf', '=', $request->cpf)
                            ->select(
                                'usuarios.id as candidato_id',
                                'usuarios.nome',
                                'usuarios.cpf',
                                'usuarios.rg',
                                'inscricoes.id',
                                'cursos.nome as curso_nome',
                                'polos.nome as polo_nome',
                                'cursos_polos.id as codigo',
                                'cursos_polos.turno as turno',
                                'cursos_polos.periodo as periodo',
                                DB::raw("
                                    CASE inscricoes.status_envelope1
                                        WHEN 0 THEN 'Envelope Pendente'
                                        WHEN 1 THEN 'Envelope Entregue'
                                        WHEN 2 THEN 'Documentação Deferida'
                                        WHEN 3 THEN 'Documentação Indeferida'
                                    END as status_envelope1
                                "),
                                DB::raw("
                                    CASE inscricoes.status_envelope2
                                        WHEN 0 THEN 'Envelope Pendente'
                                        WHEN 1 THEN 'Envelope Entregue'
                                    END as status_envelope2
                                "),
                                'inscricoes.status_dae'
                            )
                            ->orderBy('inscricoes.id', 'asc')
                            ->paginate(50);
        }

        return view('admin.inscricoes.index', compact('inscricoes', 'qtd_inscricoes'));
    }

    // Lista as inscrições em que os dois envelopes foram entregues
    public function inscricoesEnvelope1(){

        $inscricoes = DB::table('usuarios')
                        ->join('inscricoes', 'inscricoes.usuarios_id', '=', 'usuarios.id')
                        ->join('cursos_polos', 'cursos_polos.id', '=', 'inscricoes.cursos_polos_id')
                        ->join('cursos', 'cursos.id', '=', 'cursos_polos.curso_id')
                        ->join('polos', 'polos.id', '=', 'cursos_polos.polo_id')
                        ->where('status_dae', 1)
                        ->where('inscricoes.status_envelope1', '=', 1)
                        ->where('inscricoes.status_envelope2', '=', 1)
                        ->select(
                            'usuarios.id as candidato_id',
                            'usuarios.nome',
                            'usuarios.cpf',
                            'usuarios.rg',
                            'inscricoes.id',
                            'cursos.nome as curso_nome',
                            'polos.nome as polo_nome',
                            'cursos_polos.id as codigo',
                            'cursos_polos.turno as turno',
                            'cursos_polos.periodo as periodo'
                        )
                        ->orderBy('inscricoes.id', 'asc')
                        ->paginate(10);

        $num_inscricoes = DB::table('usuarios')
                        ->join('inscricoes', 'inscricoes.usuarios_id', '=', 'usuarios.id')
                        ->join('cursos_polos', 'cursos_polos.id', '=', 'inscricoes.cursos_polos_id')
                        ->join('cursos', 'cursos.id', '=', 'cursos_polos.curso_id')
                        ->join('polos', 'polos.id', '=', 'cursos_polos.polo_id')
                        ->where('status_dae', 1)
                        ->where('inscricoes.status_envelope1', '=', 1)
                        ->where('inscricoes.status_envelope2', '=', 1)
                        ->count();

        return view('admin.inscricoes.envelope1', compact('inscricoes', 'num_inscricoes'));
    }

    // Lista as inscrições que estão com os envelopes confirmados, deferidos ou indeferidos e que a nota ou a quantidade de disciplinas já estejam lançadas
    public function inscricoesEnvelope2(){

        $inscricoes = DB::table('usuarios')
                        ->join('inscricoes', 'inscricoes.usuarios_id', '=', 'usuarios.id')
                        ->join('cursos_polos', 'cursos_polos.id', '=', 'inscricoes.cursos_polos_id')
                        ->join('cursos', 'cursos.id', '=', 'cursos_polos.curso_id')
                        ->join('polos', 'polos.id', '=', 'cursos_polos.polo_id')
                        ->where('status_dae', 1)
                        ->where('inscricoes.status_envelope1', '<>', 0)
                        ->where('inscricoes.status_envelope2', '<>', 0)
                        ->whereNull('usuarios.media')
                        ->whereNull('usuarios.qtd_disc_falta')
                        ->select(
                            'usuarios.id as candidato_id',
                            'usuarios.nome',
                            'usuarios.cpf',
                            'usuarios.rg',
                            'inscricoes.id',
                            'cursos.nome as curso_nome',
                            'polos.nome as polo_nome',
                            'cursos_polos.id as codigo',
                            'cursos_polos.turno as turno',
                            'cursos_polos.periodo as periodo'
                        )
                        ->orderBy('inscricoes.id', 'asc')
                        ->paginate(10);

        $num_inscricoes = DB::table('usuarios')
                        ->join('inscricoes', 'inscricoes.usuarios_id', '=', 'usuarios.id')
                        ->join('cursos_polos', 'cursos_polos.id', '=', 'inscricoes.cursos_polos_id')
                        ->join('cursos', 'cursos.id', '=', 'cursos_polos.curso_id')
                        ->join('polos', 'polos.id', '=', 'cursos_polos.polo_id')
                        ->where('status_dae', 1)
                        ->where('inscricoes.status_envelope1', '<>', 0)
                        ->where('inscricoes.status_envelope2', '<>', 0)
                        ->whereNull('usuarios.media')
                        ->whereNull('usuarios.qtd_disc_falta')
                        ->count();

        return view('admin.inscricoes.envelope2', compact('inscricoes', 'num_inscricoes'));
    }

    // Realiza a busca de um candidato pela sua inscrição
    public function buscarPorInscricao(Request $request){

        if(empty($request->inscricao)){
            if($request->envelope == 1){
                return redirect()->route('admin.inscricoes.envelope1');
            }elseif($request->envelope == 2){
                return redirect()->route('admin.inscricoes.envelope2');
            }
        }

        // Se a requisição de busca vier da view de tratamento do envelope 1
        if($request->envelope == 1){
            $inscricoes = DB::table('usuarios')
                            ->join('inscricoes', 'inscricoes.usuarios_id', '=', 'usuarios.id')
                            ->join('cursos_polos', 'cursos_polos.id', '=', 'inscricoes.cursos_polos_id')
                            ->join('cursos', 'cursos.id', '=', 'cursos_polos.curso_id')
                            ->join('polos', 'polos.id', '=', 'cursos_polos.polo_id')
                            ->where('status_dae', 1)
                            ->where('inscricoes.status_envelope1', '=', 1)
                            ->where('inscricoes.status_envelope2', '=', 1)
                            ->where('inscricoes.id', '=', $request->inscricao)
                            ->select(
                                'usuarios.id as candidato_id',
                                'usuarios.nome',
                                'usuarios.cpf',
                                'usuarios.rg',
                                'inscricoes.id',
                                'cursos.nome as curso_nome',
                                'polos.nome as polo_nome',
                                'cursos_polos.id as codigo',
                                'cursos_polos.turno as turno',
                                'cursos_polos.periodo as periodo'
                            )
                            ->orderBy('inscricoes.id', 'asc')
                            ->paginate(10);
        }

        // Se a requisição de busca vier da view de tratamento do envelope 2
        elseif($request->envelope == 2){
            $inscricoes = DB::table('usuarios')
                            ->join('inscricoes', 'inscricoes.usuarios_id', '=', 'usuarios.id')
                            ->join('cursos_polos', 'cursos_polos.id', '=', 'inscricoes.cursos_polos_id')
                            ->join('cursos', 'cursos.id', '=', 'cursos_polos.curso_id')
                            ->join('polos', 'polos.id', '=', 'cursos_polos.polo_id')
                            ->where('status_dae', 1)
                            ->where('inscricoes.status_envelope1', '<>', 0)
                            ->where('inscricoes.status_envelope2', '<>', 0)
                            ->whereNull('usuarios.media')
                            ->whereNull('usuarios.qtd_disc_falta')
                            ->where('inscricoes.id', '=', $request->inscricao)
                            ->select(
                                'usuarios.id as candidato_id',
                                'usuarios.nome',
                                'usuarios.cpf',
                                'usuarios.rg',
                                'inscricoes.id',
                                'cursos.nome as curso_nome',
                                'polos.nome as polo_nome',
                                'cursos_polos.id as codigo',
                                'cursos_polos.turno as turno',
                                'cursos_polos.periodo as periodo'
                            )
                            ->orderBy('inscricoes.id', 'asc')
                            ->paginate(10);
        }

        $busca = TRUE;

        if($request->envelope == 1){
            return view('admin.inscricoes.envelope1', compact('inscricoes', 'busca'));
        }elseif($request->envelope == 2){
            return view('admin.inscricoes.envelope2', compact('inscricoes', 'busca'));
        }
    }

    // Realiza a busca de um candidato pelo seu CPF
    public function buscarPorCPF(Request $request){
        if(empty($request->cpf)){
            if($request->envelope == 1){
                return redirect()->route('admin.inscricoes.envelope1');
            }elseif($request->envelope == 2){
                return redirect()->route('admin.inscricoes.envelope2');
            }
        }

        if($request->envelope == 1){
            $inscricoes = DB::table('usuarios')
                            ->join('inscricoes', 'inscricoes.usuarios_id', '=', 'usuarios.id')
                            ->join('cursos_polos', 'cursos_polos.id', '=', 'inscricoes.cursos_polos_id')
                            ->join('cursos', 'cursos.id', '=', 'cursos_polos.curso_id')
                            ->join('polos', 'polos.id', '=', 'cursos_polos.polo_id')
                            ->where('status_dae', 1)
                            ->where('inscricoes.status_envelope1', '=', 1)
                            ->where('inscricoes.status_envelope2', '=', 1)
                            ->where('usuarios.cpf', '=', $request->cpf)
                            ->select(
                                'usuarios.id as candidato_id',
                                'usuarios.nome',
                                'usuarios.cpf',
                                'usuarios.rg',
                                'inscricoes.id',
                                'cursos.nome as curso_nome',
                                'polos.nome as polo_nome',
                                'cursos_polos.id as codigo',
                                'cursos_polos.turno as turno',
                                'cursos_polos.periodo as periodo'
                            )
                            ->orderBy('inscricoes.id', 'asc')
                            ->paginate(10);
        }elseif($request->envelope == 2){
            $inscricoes = DB::table('usuarios')
                            ->join('inscricoes', 'inscricoes.usuarios_id', '=', 'usuarios.id')
                            ->join('cursos_polos', 'cursos_polos.id', '=', 'inscricoes.cursos_polos_id')
                            ->join('cursos', 'cursos.id', '=', 'cursos_polos.curso_id')
                            ->join('polos', 'polos.id', '=', 'cursos_polos.polo_id')
                            ->where('status_dae', 1)
                            ->where('inscricoes.status_envelope1', '<>', 0)
                            ->where('inscricoes.status_envelope2', '<>', 0)
                            ->whereNull('usuarios.media')
                            ->whereNull('usuarios.qtd_disc_falta')
                            ->where('usuarios.cpf', '=', $request->cpf)
                            ->select(
                                'usuarios.id as candidato_id',
                                'usuarios.nome',
                                'usuarios.cpf',
                                'usuarios.rg',
                                'inscricoes.id',
                                'cursos.nome as curso_nome',
                                'polos.nome as polo_nome',
                                'cursos_polos.id as codigo',
                                'cursos_polos.turno as turno',
                                'cursos_polos.periodo as periodo'
                            )
                            ->orderBy('inscricoes.id', 'asc')
                            ->paginate(10);
        }

        $busca = TRUE;

        if($request->envelope == 1){
            return view('admin.inscricoes.envelope1', compact('inscricoes', 'busca'));
        }elseif($request->envelope == 2){
            return view('admin.inscricoes.envelope2', compact('inscricoes', 'busca'));
        }
    }

    // Realiza a busca de um candidato pelo seu nome
    public function buscarPorNome(Request $request){
        if(empty($request->nome)){
            if($request->envelope == 1){
                return redirect()->route('admin.inscricoes.envelope1');
            }elseif($request->envelope == 2){
                return redirect()->route('admin.inscricoes.envelope2');
            }
        }

        if($request->envelope == 1){
            $inscricoes = DB::table('usuarios')
                            ->join('inscricoes', 'inscricoes.usuarios_id', '=', 'usuarios.id')
                            ->join('cursos_polos', 'cursos_polos.id', '=', 'inscricoes.cursos_polos_id')
                            ->join('cursos', 'cursos.id', '=', 'cursos_polos.curso_id')
                            ->join('polos', 'polos.id', '=', 'cursos_polos.polo_id')
                            ->where('status_dae', 1)
                            ->where('inscricoes.status_envelope1', '=', 1)
                            ->where('inscricoes.status_envelope2', '=', 1)
                            ->where('usuarios.nome', 'like', "%".$request->nome."%")
                            ->select(
                                'usuarios.id as candidato_id',
                                'usuarios.nome',
                                'usuarios.cpf',
                                'usuarios.rg',
                                'inscricoes.id',
                                'cursos.nome as curso_nome',
                                'polos.nome as polo_nome',
                                'cursos_polos.id as codigo',
                                'cursos_polos.turno as turno',
                                'cursos_polos.periodo as periodo'
                            )
                            ->orderBy('inscricoes.id', 'asc')
                            ->paginate(10);
        }elseif($request->envelope == 2){
            $inscricoes = DB::table('usuarios')
                            ->join('inscricoes', 'inscricoes.usuarios_id', '=', 'usuarios.id')
                            ->join('cursos_polos', 'cursos_polos.id', '=', 'inscricoes.cursos_polos_id')
                            ->join('cursos', 'cursos.id', '=', 'cursos_polos.curso_id')
                            ->join('polos', 'polos.id', '=', 'cursos_polos.polo_id')
                            ->where('status_dae', 1)
                            ->where('inscricoes.status_envelope1', '<>', 0)
                            ->where('inscricoes.status_envelope2', '<>', 0)
                            ->whereNull('usuarios.media')
                            ->whereNull('usuarios.qtd_disc_falta')
                            ->where('usuarios.nome', 'like', "%".$request->nome."%")
                            ->select(
                                'usuarios.id as candidato_id',
                                'usuarios.nome',
                                'usuarios.cpf',
                                'usuarios.rg',
                                'inscricoes.id',
                                'cursos.nome as curso_nome',
                                'polos.nome as polo_nome',
                                'cursos_polos.id as codigo',
                                'cursos_polos.turno as turno',
                                'cursos_polos.periodo as periodo'
                            )
                            ->orderBy('inscricoes.id', 'asc')
                            ->paginate(10);
        }

        $busca = TRUE;

        if($request->envelope == 1){
            return view('admin.inscricoes.envelope1', compact('inscricoes', 'busca'));
        }elseif($request->envelope == 2){
            return view('admin.inscricoes.envelope2', compact('inscricoes', 'busca'));
        }
    }

    // Seta se uma inscrição está deferida ou inderefida - Envelope 1
    public function analisarEnvelope1(Request $request, $id){

        // Verifica se o formulário não foi mandado sem a escolha de um dos radiobox
        if(empty($request->resultado)){
            return redirect()->back()->with('danger', 'Informe se o envelope foi derefido ou indeferido!');
        }

        $inscricao = Inscricao::find($id);

        // Deferido
        if($request->resultado == 2){

            $inscricao->status_envelope1 = 2;
            $inscricao->save();
        }

        // Indeferido
        elseif($request->resultado == 3){

            $inscricao->status_envelope1 = 3;
            $inscricao->save();

            return view('admin.inscricoes.indeferimento', compact('inscricao'));
        }

        return redirect()->back()->with('success', "Envelope 1 da inscricão {$id} deferido com sucesso!");
    }

    // Insere o motivo de inferimento de uma inscrição
    public function inserirMotivoIndeferimentoEnvelope1(Request $request, $id){

        $recurso = Recurso::where('inscricoes_id', $id)->count();

        if($recurso == 0){
            Recurso::firstOrCreate([
                'inscricoes_id' => $id,
                'motivo_indeferimento_etapa1' => $request->motivo_indeferimento
            ]);
        }else{

            $recurso = Recurso::where('inscricoes_id', $id)->first();

            $recurso->motivo_indeferimento_etapa1 = $request->motivo_indeferimento;
            $recurso->save();
        }

        return redirect()->route('admin.inscricoes.envelope1')->with('success', "Motivo do indererimento do envelope 1 da inscrição {$id} salvo com sucesso!");
    }

    // Seta a nota de a quantidade de disciplinas faltantes de uma inscrição
    public function analisarEnvelope2(Request $request, $id){

        if(!is_numeric($request->media)){
            return redirect()->route('admin.inscricoes.envelope2')->with('danger', 'Por favor, informe um valor válido para a média/número de disciplinas a serem cumpridas!');
        }

        if(!empty($request->qtd_disc_falta) AND !is_numeric($request->qtd_disc_falta)){
            return redirect()->route('admin.inscricoes.envelope2')->with('danger', 'Por favor, informe um valor válido para a média/número de disciplinas a serem cumpridas!');
        }

        $candidato = Usuario::find($id);

        $candidato->media = $request->media;
        $candidato->qtd_disc_falta = $request->qtd_disc_falta;

        if($candidato->save()){
            return redirect()->back()->with('success', 'Valores salvos com sucesso!');
        }else{
            return redirect()->back()->with('danger', 'Ocorreu um erro, tente novamente!');
        }
    }

    // Lista todas as inscrições que estão deferidas ou indeferidas
    public function editarInscricoesEnvelope1(){

        $inscricoes = DB::table('usuarios')
                        ->join('inscricoes', 'inscricoes.usuarios_id', '=', 'usuarios.id')
                        ->join('cursos_polos', 'cursos_polos.id', '=', 'inscricoes.cursos_polos_id')
                        ->join('cursos', 'cursos.id', '=', 'cursos_polos.curso_id')
                        ->join('polos', 'polos.id', '=', 'cursos_polos.polo_id')
                        ->where('status_dae', 1)
                        ->where('inscricoes.status_envelope1', '=', 2)
                        ->orWhere('inscricoes.status_envelope1', '=', 3)
                        ->where('inscricoes.status_envelope2', '=', 1)
                        ->select(
                            'usuarios.id as candidato_id',
                            'usuarios.nome',
                            'usuarios.cpf',
                            'usuarios.rg',
                            'inscricoes.id',
                            'cursos.nome as curso_nome',
                            'polos.nome as polo_nome',
                            'cursos_polos.id as codigo',
                            'cursos_polos.turno as turno',
                            'cursos_polos.periodo as periodo',
                            'inscricoes.status_envelope1'
                        )
                        ->orderBy('inscricoes.id', 'asc')
                        ->paginate(10);

        return view('admin.inscricoes.editar_envelope1', compact('inscricoes'));
    }

    // Lista todas as inscrições que já foram lançadas a média ou a quantidade de disciplinas restantes
    public function editarInscricoesEnvelope2(){

        $inscricoes = DB::table('usuarios')
                        ->join('inscricoes', 'inscricoes.usuarios_id', '=', 'usuarios.id')
                        ->join('cursos_polos', 'cursos_polos.id', '=', 'inscricoes.cursos_polos_id')
                        ->join('cursos', 'cursos.id', '=', 'cursos_polos.curso_id')
                        ->join('polos', 'polos.id', '=', 'cursos_polos.polo_id')
                        ->where('status_dae', 1)
                        ->where('inscricoes.status_envelope1', '<>', 0)
                        ->where('inscricoes.status_envelope2', '<>', 0)
                        ->whereNotNull('usuarios.media')
                        ->orWhereNotNull('usuarios.qtd_disc_falta')
                        ->select(
                            'usuarios.id as candidato_id',
                            'usuarios.nome',
                            'usuarios.cpf',
                            'usuarios.rg',
                            'inscricoes.id',
                            'cursos.nome as curso_nome',
                            'polos.nome as polo_nome',
                            'cursos_polos.id as codigo',
                            'cursos_polos.turno as turno',
                            'cursos_polos.periodo as periodo',
                            'usuarios.media',
                            'usuarios.qtd_disc_falta'
                        )
                        ->orderBy('inscricoes.id', 'asc')
                        ->paginate(10);

        return view('admin.inscricoes.editar_envelope2', compact('inscricoes'));
    }

    // Edita o estado de uma inscrição - deferida/indeferida
    public function editarAnaliseEnvelope1(Request $request, $id){

        $inscricao = Inscricao::find($id);

        // Deferido
        if($request->resultado == 2){

            $inscricao->status_envelope1 = 2;
            $inscricao->save();
        }

        // Indeferido
        elseif($request->resultado == 3){

            $inscricao->status_envelope1 = 3;
            $inscricao->save();

            $recurso = Recurso::where('inscricoes_id', $id)->first();

            if(empty($recurso)){
                return view('admin.inscricoes.indeferimento', compact('inscricao'));
            }else{
                return view('admin.inscricoes.editar_indeferimento', compact('inscricao', 'recurso'));
            }
        }

        return redirect()->back()->with('success', "Envelope 1 da inscricão {$id} deferido com sucesso!");
    }

    // Edita a nota ou a quantidade de disciplinas restantes
    public function editarAnaliseEnvelope2(Request $request, $id){

        $candidato = Usuario::find($id);

        $candidato->media = $request->media;
        $candidato->qtd_disc_falta = $request->qtd_disc_falta;

        if($candidato->save()){
            return redirect()->back()->with('success', 'Valores salvos com sucesso!');
        }else{
            return redirect()->back()->with('danger', 'Ocorreu um erro, tente novamente!');
        }
    }

    // Edita o motivo de indeferimento de uma inscrição
    public function editarMotivoIndeferimentoEnvelope1(Request $request, $id){

        $recurso = Recurso::where('inscricoes_id', $id)->first();

        $recurso->motivo_indeferimento_etapa1 = $request->motivo_indeferimento;

        return redirect()->route('admin.inscricoes.envelope1.editar')->with('success', "Motivo do indererimento do envelope 1 da inscrição {$id} salvo com sucesso!");
    }

    public function buscarPorInscricaoEditar(Request $request){

        if(empty($request->inscricao) AND $request->envelope == 1){
            return redirect()->route('admin.inscricoes.envelope1.editar');
        }elseif(empty($request->inscricao) AND $request->envelope == 2){
            return redirect()->route('admin.inscricoes.envelope2.editar');
        }

        if($request->envelope == 1){

            $inscricoes = DB::table('usuarios')
                            ->join('inscricoes', 'inscricoes.usuarios_id', '=', 'usuarios.id')
                            ->join('cursos_polos', 'cursos_polos.id', '=', 'inscricoes.cursos_polos_id')
                            ->join('cursos', 'cursos.id', '=', 'cursos_polos.curso_id')
                            ->join('polos', 'polos.id', '=', 'cursos_polos.polo_id')
                            ->where('status_dae', 1)
                            ->where('inscricoes.id', '=', $request->inscricao)
                            ->where('inscricoes.status_envelope1', '<>', 0)
                            ->where('inscricoes.status_envelope1', '<>', 1)
                            ->where('inscricoes.status_envelope2', '=', 1)
                            ->select(
                                'usuarios.id as candidato_id',
                                'usuarios.nome',
                                'usuarios.cpf',
                                'usuarios.rg',
                                'inscricoes.id',
                                'cursos.nome as curso_nome',
                                'polos.nome as polo_nome',
                                'cursos_polos.id as codigo',
                                'cursos_polos.turno as turno',
                                'cursos_polos.periodo as periodo',
                                'inscricoes.status_envelope1'
                            )
                            ->orderBy('inscricoes.id', 'asc')
                            ->paginate(10);
        }

        elseif($request->envelope == 2){

            $inscricoes = DB::table('usuarios')
                            ->join('inscricoes', 'inscricoes.usuarios_id', '=', 'usuarios.id')
                            ->join('cursos_polos', 'cursos_polos.id', '=', 'inscricoes.cursos_polos_id')
                            ->join('cursos', 'cursos.id', '=', 'cursos_polos.curso_id')
                            ->join('polos', 'polos.id', '=', 'cursos_polos.polo_id')
                            ->where('status_dae', 1)
                            ->where('inscricoes.id', '=', $request->inscricao)
                            ->where('inscricoes.status_envelope1', '<>', 0)
                            ->where('inscricoes.status_envelope2', '<>', 0)
                            ->whereNotNull('usuarios.media')
                            // ->WhereNotNull('usuarios.qtd_disc_falta')
                            ->select(
                                'usuarios.id as candidato_id',
                                'usuarios.nome',
                                'usuarios.cpf',
                                'usuarios.rg',
                                'inscricoes.id',
                                'cursos.nome as curso_nome',
                                'polos.nome as polo_nome',
                                'cursos_polos.id as codigo',
                                'cursos_polos.turno as turno',
                                'cursos_polos.periodo as periodo',
                                'usuarios.media',
                                'usuarios.qtd_disc_falta'
                            )
                            ->orderBy('inscricoes.id', 'asc')
                            ->paginate(10);
        }

        if($request->envelope == 1){
            return view('admin.inscricoes.editar_envelope1', compact('inscricoes'));
        }elseif($request->envelope == 2){
            return view('admin.inscricoes.editar_envelope2', compact('inscricoes'));
        }
    }
}
