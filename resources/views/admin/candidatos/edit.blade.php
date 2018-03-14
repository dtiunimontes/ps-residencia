@extends('layouts.app')
@section('title', 'Editar dados do candidato')
@section('content')

    {{ Form::open(['url' => route('admin.candidatos.update', $candidato['id']), 'method' => 'put']) }}
    <div class="row">
        <div class="col-md-6">
            <h5><strong>CANDIDATO: {{ $candidato['nome'] }}</strong></h5>
        </div>
    </div><br>
    <div class="row">
        <input type="hidden" name="candidato_id" value="{{ $candidato['id'] }}">
        <div class="col-md-6">
            <div class="form-group {{ $errors->has('cpf') ? ' has-error' : '' }}">
                <label>CPF: </label><br>
                <input type="text" name="cpf" class="form-control" value="{{ $candidato['cpf'] }}">
                @if ($errors->has('cpf'))
                    <span class="help-block">
                        <strong>{{ $errors->first('cpf') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group {{ $errors->has('residencia_id') ? ' has-error' : '' }}">
                <label>CÓDIGO DE INSCRIÇÃO DA RESIDÊNCIA: </label><br>
                <input type="text" name="residencia_id" class="form-control" value="{{ $candidato['residencia_id'] }}">
                @if ($errors->has('residencia_id'))
                    <span class="help-block">
                        <strong>{{ $errors->first('residencia_id') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
    <button type="submit" class="btn blue btn-block" name="submit">Salvar</button>

    {{ Form::close() }}

@endsection