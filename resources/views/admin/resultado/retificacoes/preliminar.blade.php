@extends('layouts.app')

@section('title', 'Retificações - Resultado Preliminar')
@section('content')

<div class="row">
    <div class="col-md-12">
        {{ Form::open(['url' => route('admin.resultado.retificacao.criar'), 'method' => 'post']) }}
        <input type="hidden" name="resultado" value="1">
        <div class="form-group">
            <label>Insira o código do Campus/Curso: </label>
            <div class="input-group input-group-md">
                <input type="text" class="form-control" name="cursos_polos_id">
                <span class="input-group-btn">
                    <button class="btn green" type="submit">Retificar</button>
                </span>
            </div>
        </div>
        {{ Form::close() }}
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-hover table-condensed">
                <thead>
                    <tr>
                        <th>Código Campus/Curso</th>
                        <th>Data da Retificação</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($retificacoes as $retificacao)
                    <tr>
                        <td>{{ $retificacao->cursos_polos_id }}</td>
                        <td>{{ formatarDataUSAParaBRData($retificacao->created_at) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
