@extends('layouts.app')
@section('title', 'Inscrições Indeferidas - Lançamento de Recurso concluído')
@section('content')

<div class="row">
    {{ Form::open(['url' => route('admin.recursos.buscar.inscricao'), 'method' => 'get']) }}
    <input type="hidden" name="tipo" value="envelope1_edicao">
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
                    <th>Inscrição</th>
                    <th>Candidato</th>
                    <th>Código Campus/Curso</th>
                    <th>Campus</th>
                    <th>Curso</th>
                    <th>Ações</th>
                </tr>
                @foreach($inscricoes as $inscricao)
                <tr>
                    <td>{{ $inscricao->inscricao }}</td>
                    <td>{{ $inscricao->candidato_nome }}</td>
                    <td>{{ $inscricao->codigo_campus_curso }}</td>
                    <td>{{ $inscricao->campus_nome }}</td>
                    <td>{{ $inscricao->curso_nome }}</td>
                    <td>
                        <a href="{{ route('admin.recursos.envelope1.inscricoes.indeferidas.lancadas.editar.recurso', $inscricao->inscricao) }}" class="btn bg-green-jungle bg-font-green-jungle">Editar</a>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>

@endsection
