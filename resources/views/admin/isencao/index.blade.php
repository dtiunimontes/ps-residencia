@extends('layouts.app')
@section('title', 'Candidatos que pediram Isenção')
@section('content')
<div class="row">
    <div class="col-md-12">
        {{ Form::open(['url' => route('admin.isencao.index'), 'method' => 'get']) }}
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
                    <th>Data Nasc.</th>
                    <th>Tel.</th>
                    <th>Info</th>
                    <th>Análise</th>
                </tr>
                </thead>
                <tbody>
                @foreach($pedidosIsencao as $pedido)
                <tr>
                    <td>{{ $pedido->inscricao }}</td>
                    <td width="20%">{{ $pedido->candidato_nome }}</td>
                    <td>{{ $pedido->candidato_cpf }}</td>
                    <td>{{ date('d/m/Y', strtotime($pedido->data_nasc)) }}</td>
                    <td>{{ $pedido->telefone }}</td>
                    <td width="30%"><strong>{{ $pedido->residencia_codigo }}</strong> - {{ $pedido->programa }} - {{ $pedido->categoria_profissional }} - {{ $pedido->cidade_polo }}</td>
                    <td>
                        @if(!empty($pedido->status_pedido_isencao))
                            <span style="background-color: #d58512; padding: 5px; color: #ffffff"> <i class="fa fa-check" aria-hidden="true"></i>&nbsp;Já analisada</span>
                        @endif
                        {{ Form::open(['url' => route('admin.isencao.update', $pedido->inscricao), 'method' => 'post']) }}
                        {{ method_field('PUT') }}
                        <div class="radio">
                            <label><input type="radio" name="status_pedido_isencao" {{ ($pedido->status_pedido_isencao == 2) ? 'checked="checked"' : '' }} value="2">Deferido</label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" name="status_pedido_isencao" {{ ($pedido->status_pedido_isencao == 1) ? 'checked="checked"' : '' }} value="1">Indeferido</label>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn bg-green-jungle bg-font-green-jungle">ok!</button>
                        </div>
                        {{ Form::close() }}
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection