<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Inscricao;
use App\Models\Usuario;
use App\Models\Polo;
use App\Models\Curso;
use App\Models\CursoPolo;
use App\Models\Recurso;
class AnaliseController extends Controller{

    public function index(){
        //
    }

    public function create(){
        $acao = 'receber';
        $titulo = 'Recebimento de Envelope';
        return view('analise.verificar_receber_envelope', compact('acao', 'titulo'));
    }

    public function store(Request $request){
        $this->validate($request, [
            'id' => 'numeric|required',
        ]);
        $id = substr($request['id'], 1, 11);
        $envelope = substr($request['id'], 0, 1);
        try{
            $inscricao = Inscricao::findorfail($id);
        }catch(\Exception $e){
            return redirect()->route('admin.analise.create')->with('danger', "Ocorreu um erro, o envelope não pôde ser recebido!");
        }

        if($envelope == 1){
            if($inscricao->status_envelope1 != 0){
                return redirect()->route('admin.analise.create')->with('danger', "Envelope {$envelope} da inscricao {$id} já foi recebido!");
            }else{
                $inscricao->status_envelope1 = 1;
                $result = $inscricao->save();
            }
        }

        if($envelope == 2){
            if($inscricao->status_envelope2 != 0){
                return redirect()->route('admin.analise.create')->with('danger', "Envelope {$envelope} da inscricao {$id} já foi recebido!");
            }else{
                $inscricao->status_envelope2 = 1;
                $result = $inscricao->save();
            }
        }

        if(isset($result) && $result){
            return redirect()->route('admin.analise.create')->with('success', "O envelope {$envelope} da inscricao {$id} foi recebido com sucesso!");
        }else{
            return redirect()->route('admin.analise.create')->with('danger', "Ocorreu um erro, o envelope não pôde ser recebido!");
        }
    }

    public function analise(){
        $acao = 'verificar';
        $titulo = 'Verificação de Envelope';
        return view('analise.verificar_receber_envelope', compact('acao', 'titulo'));
    }

    public function show($id){
        //
    }

    public function edit(Request $request){
        if($request['cpf'] != null){
            $this->validate($request, [
                'cpf' => 'numeric|required',
            ]);
            try{
                $usuario = Usuario::where('cpf', $request['cpf'])->first();
                $inscricao = Inscricao::where('usuarios_id', $usuario->id)->first();
                if($inscricao->status_envelope1 != 1){
                    return redirect()->back()->with('danger', "Envelope não recebido ou já verificado!");
                }
            }catch(\Exception $e){
                return redirect()->route('admin.analise.analise')->with('danger', "A inscrição ou envelope do candidato não foi encontrado!");
            }
        }else{
            $this->validate($request, [
                'id' => 'numeric|required',
            ]);
            $envelope = substr($request['id'], 0, 1);
            if($envelope == 1){
                $id = substr($request['id'], 1, 11);
                try{
                    $inscricao = Inscricao::findorfail($id);
                    if($inscricao->status_envelope1 != 1){
                        return redirect()->back()->with('danger', "Envelope não recebido ou já verificado!");
                    }
                }catch(\Exception $e){
                    return redirect()->route('admin.analise.analise')->with('danger', "A inscrição ou envelope do candidato não foi encontrado!");
                }
            }else{
                return redirect()->route('admin.analise.analise')->with('danger', "A inscrição ou envelope do candidato não foi encontrado!");
            }
        }
        if($inscricao->status_envelope1 != 2 || $inscricao->status_envelope1 != 3){
            try{
                $usuario = Usuario::findorfail($inscricao->usuarios_id);
                $curso_polo = CursoPolo::where('id', $inscricao->cursos_polos_id)->first();
                $polos = Polo::all();
                $cursos = Curso::all();
                return view('analise.analise_documento', compact('usuario', 'inscricao', 'polos', 'cursos', 'curso_polo'));
            }catch(\Exception $e){
                return redirect()->route('admin.analise.analise')->with('danger', "Ocorreu um erro, o candidato não foi encontrado!");
            }
        }else{
            return redirect()->route('admin.analise.analise')->with('danger', "Envelope já analisado!");
        }
    }

    public function update(Request $request){
        try{
            $inscricao = Inscricao::findorfail($request['id']);
            if($inscricao->status_envelope1 != 1){
                return redirect()->route('admin.analise.analise')->with('danger', "Envelope não recebido ou já verificado!");
            }
        }catch(\Exception $e){
            return redirect()->route('admin.analise.analise')->with('danger', "Ocorreu um erro ao procurar inscrição!");
        }
        $this->validate($request, [
            'acao' => 'required',
        ]);
        if($request['acao'] == 'deferido'){
            try{
                $inscricao->status_envelope1 = 2;
                $inscricao->save();
            }catch(\Exception $e){
                return redirect()->route('admin.analise.analise')->with('danger', "Ocorreu um erro ao indeferir inscrição!");
            }
        }elseif($request['acao'] == 'indeferido'){
            return view('analise.motivo_indeferimento', ['id' => $inscricao->id]);
        }
        return redirect()->route('admin.analise.analise')->with('success', "Envelope verificado com sucesso!");
    }

    public function indeferimento(Request $request){
        $this->validate($request, [
            'id' => 'numeric|required',
            'motivo_indeferimento_etapa1' => 'string|required',
        ]);
        try{
            $inscricao = Inscricao::findorfail($request['id']);
            $inscricao->status_envelope1 = 3;
            $inscricao->save();
            Recurso::create([
                'motivo_indeferimento_etapa1' => $request['motivo_indeferimento_etapa1'],
                'inscricoes_id' => $inscricao->id
            ]);
            return redirect()->route('admin.analise.analise')->with('success', "Envelope indeferido com sucesso!");            
        }catch(\Exception $e){
            return redirect()->route('admin.analise.analise')->with('danger', "Ocorreu um erro ao indeferir inscrição!");
        }
    }

    public function destroy($id){
        //
    }
}
