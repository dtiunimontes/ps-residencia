@extends('layouts.app')
@section('title', 'Listagem dos candidatos com suas médias - Lançamento de Recurso - Etapa 2')
@section('content')

<div class="row">
    {{ Form::open(['url' => route('admin.recursos.buscar.inscricao'), 'method' => 'get']) }}
    <input type="hidden" name="tipo" value="envelope2_lancamento">
    <div class="col-md-2">
        <input type="text" class="form-control" id="inscricao" name="inscricao" placeholder="Inscrição" required>
    </div>
    <div class="col-md-1">
        <button type="submit" class="btn bg-green-jungle bg-font-green-jungle">Buscar</button>
    </div>
    {{ Form::close() }}
</div>
<br>
<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-hover table-condensed">
                <tr>
                    <th style="text-align: center">Inscrição</th>
                    <th>Candidato</th>
                    <th>Média</th>
                    <th style="text-align: center">Código Campus/Curso</th>
                    <th>Campus</th>
                    <th>Curso</th>
                    <th>Enviou recurso etapa 1?</th>
                    <th>Ações</th>
                </tr>
                @foreach($inscricoes as $inscricao)
                <tr>
                    <td style="text-align: center">{{ $inscricao->inscricao }}</td>
                    <td>{{ $inscricao->candidato_nome }}</td>
                    <td><strong>{{ $inscricao->media }}</strong></td>
                    <td style="text-align: center">{{ $inscricao->codigo_campus_curso }}</td>
                    <td>{{ $inscricao->curso_nome }}</td>
                    <td>{{ $inscricao->campus_nome }}</td>
                    <td style="text-align: center">
                        @if(!empty($inscricao->motivo_indeferimento_etapa1))
                            <span class="badge badge-success badge-roundless">Sim</span>
                        @else
                            <span class="badge badge-danger badge-roundless">Não</span>
                        @endif
                    </td>
                    <td>
                        @if(empty($inscricao->recurso_etapa2))
                        <a href="{{ route('admin.recursos.envelope2.notas.ver', $inscricao->inscricao) }}" class="btn green-meadow"><strong>Criar recurso</strong></a>
                        @elseif(!empty($inscricao->recurso_etapa2) AND empty($inscricao->resposta_recurso_etapa2))
                        <a href="{{ route('admin.recursos.envelope2.notas.ver', $inscricao->inscricao) }}" class="btn blue-madison"><strong>Finalizar recurso</strong></a>
                        @elseif(!empty($inscricao->recurso_etapa2) AND !empty($inscricao->resposta_recurso_etapa2))
                        <a href="{{ route('admin.recursos.envelope2.notas.editar', $inscricao->inscricao) }}" class="btn yellow-crusta"><strong>Finalizado. Editar?</strong></a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>

@endsection
