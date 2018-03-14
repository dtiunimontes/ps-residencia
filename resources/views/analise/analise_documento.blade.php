@extends('layouts.app')

@section('title', 'Análise do Envelope 1')
@section('content')

{{ Form::open(['url' => route('admin.analise.update'), 'method' => 'post']) }}

<h3 class="form-section">Dados Pessoais</h3>
<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('nome') ? ' has-error' : '' }}">
            <label for="nome">Nome Completo: <span class="required">*</span></label>
            <input type="hidden" name="id" value="{{ $inscricao->id }}">
            <input type="text" class="form-control" id="nome" name="nome" value="{{ $usuario->nome }}" readonly>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group {{ $errors->has('cpf') ? ' has-error' : '' }}">
            <label for="cpf">CPF: <span class="required">*</span></label>
            <input type="text" class="form-control" id="cpf" name="cpf" value="{{ $usuario->cpf }}" readonly>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group {{ $errors->has('rg') ? ' has-error' : '' }}">
            <label for="rg">RG: <span class="required">*</span></label>
            <input type="text" class="form-control" id="rg" name="rg" value="{{ $usuario->rg }}" readonly>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group {{ $errors->has('rg') ? ' has-error' : '' }}">
            <label>Org. Exp: <span class="required">*</span></label>
            <input type="text" class="form-control" name="org_exped" value="{{ $usuario->org_exped }}" maxlength="10" readonly>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('polo_id') ? ' has-error' : '' }}">
            <label for="polo_id">Campus: <span class="required">*</span></label>
            @foreach ($polos as $polo)
                @if ($curso_polo->polo_id == $polo->id)
                    <input type="text" class="form-control" value="{{ $polo->nome }}" readonly>
                @endif
            @endforeach
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('curso_id') ? ' has-error' : '' }}">
            <label for="curso_id">Curso: <span class="required">*</span></label>
            @foreach ($cursos as $curso)
                @if ($curso_polo->curso_id == $curso->id)
                    <input type="text" class="form-control" value="{{ $curso->nome }}" readonly>
                @endif
            @endforeach
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group {{ $errors->has('codigo') ? ' has-error' : '' }}">
            <label for="codigo">Código: <span class="required">*</span></label>
            <input type="number" class="form-control" value="{{$curso_polo->id}}" readonly>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group {{ $errors->has('periodo') ? ' has-error' : '' }}">
            <label for="periodo">Período: <span class="required">*</span></label>
            <input type="text" class="form-control" value="{{ $curso_polo->periodo }}" readonly>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group {{ $errors->has('turno') ? ' has-error' : '' }}">
            <label for="turno">Turno: <span class="required">*</span></label>
            <input type="text" class="form-control" value="{{ $curso_polo->turno }}" readonly>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('acao') ? ' has-error' : '' }}">
            <label for="acao"> Solicitação: <span class="required">*</span></label><br/>
            <input type="radio" name="acao" value="deferido" required> Deferida<br/>
            <input type="radio" name="acao" value="indeferido" required> Indeferida<br/>
            @if ($errors->has('acao'))
                <span class="help-block">
                    <strong>{{ $errors->first('acao') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
<button type="submit" class="btn bg-green-jungle bg-font-green-jungle">Enviar</button>

{{ Form::close() }}

@endsection
