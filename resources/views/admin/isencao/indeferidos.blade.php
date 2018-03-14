@extends('layouts.app')
@section('title', 'Candidatos que foram indeferidos no Pedido de isenção')
@section('content')
<div class="row">
    <div class="col-md-12">
        {{ Form::open(['url' => route('admin.isencao.candidatos', 'indeferidos'), 'method' => 'get']) }}
        <div class="form-group">
            <div class="input-group input-group-md">
                <input type="text" class="form-control" name="q" placeholder="Digite a inscrição">
                <span class="input-group-btn">
                    <button class="btn green" type="submit">Buscar!</button>
                </span>
            </div>
        </div>
        {{ Form::close() }}
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>Insc.</th>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>Info</th>
                    <th>Análise</th>
                </tr>
                </thead>
                <tbody>
                @foreach($indeferidos as $indeferido)
                <tr>
                    <td>{{ $indeferido->inscricao }}</td>
                    <td>{{ $indeferido->candidato_nome }}</td>
                    <td>{{ $indeferido->candidato_cpf }}</td>
                    <td width="40%"><strong>{{ $indeferido->residencia_codigo }}</strong> - {{ $indeferido->programa }} - {{ $indeferido->categoria_profissional }} - {{ $indeferido->cidade_polo }}</td>
                    <td>
                        <a href="{{ route('admin.isencao.recurso', $indeferido->inscricao) }}" class="{{ (empty($indeferido->resposta_recurso_isencao) ? 'btn blue-madison' : 'btn purple-plum') }}">{{ (empty($indeferido->resposta_recurso_isencao) ? 'Lançar resposta recurso' : 'Editar lançamento') }}</a>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection