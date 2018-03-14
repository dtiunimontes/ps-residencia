@extends('layouts.app')
@section('title', 'Candidatos que foram deferidos no Pedido de isenção')
@section('content')
<div class="row">
    <div class="col-md-12">
        {{ Form::open(['url' => route('admin.isencao.candidatos', 'deferidos'), 'method' => 'get']) }}
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
                @foreach($deferidos as $deferido)
                <tr>
                    <td>{{ $deferido->inscricao }}</td>
                    <td>{{ $deferido->candidato_nome }}</td>
                    <td>{{ $deferido->candidato_cpf }}</td>
                    <td width="40%"><strong>{{ $deferido->residencia_codigo }}</strong> - {{ $deferido->programa }} - {{ $deferido->categoria_profissional }} - {{ $deferido->cidade_polo }}</td>
                    <td>
                        <a href="{{ route('admin.isencao.recurso', $deferido->inscricao) }}" class="{{ (empty($deferido->resposta_recurso_isencao) ? 'btn blue-madison' : 'btn purple-plum') }}">{{ (empty($deferido->resposta_recurso_isencao) ? 'Lançar resposta recurso' : 'Editar lançamento') }}</a>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection