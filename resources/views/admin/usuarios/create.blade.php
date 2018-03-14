@extends('layouts.app')

@section('title', 'Adicionar novo administrador')
@section('content')

{{ Form::open(['url' => route('admin.usuarios.store'), 'method' => 'post']) }}
<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('nome') ? ' has-error' : '' }}">
            <label for="nome">Nome: <span class="required">*</span></label>
            <input type="text" class="form-control" id="nome" name="nome" value="{{ old('nome') }}" required>
            @if ($errors->has('nome'))
                <span class="help-block">
                    <strong>{{ $errors->first('nome') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('nome') ? ' has-error' : '' }}">
            <label for="email">E-mail: <span class="required">*</span></label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('nome') ? ' has-error' : '' }}">
            <label for="cpf">CPF: <span class="required">*</span></label>
            <input type="text" class="form-control" id="cpf" name="cpf" value="{{ old('cpf') }}" required>
            @if ($errors->has('cpf'))
                <span class="help-block">
                    <strong>{{ $errors->first('cpf') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('nome') ? ' has-error' : '' }}">
            <label for="password">Senha: <span class="required">*</span></label>
            <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}" required>
            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
<button type="submit" class="btn bg-green-jungle bg-font-green-jungle">Cadastrar</button>
{{ Form::close() }}

@endsection
