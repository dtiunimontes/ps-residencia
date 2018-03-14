@extends('layouts.app')

@section('title', 'Alteração de Senha')
@section('content')

{{ Form::open(['url' => route('candidato.minhaconta.alterar.senha'), 'method' => 'post']) }}

<div class="row">
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('senha') ? ' has-error' : '' }}">
            <label for="senha_atual">Senha atual: <span class="required">*</span></label>
            <input type="password" class="form-control" id="senha_atual" name="senha_atual" required="">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('senha') ? ' has-error' : '' }}">
            <label for="nova_senha">Nova Senha: <span class="required">*</span></label>
            <input type="password" class="form-control" id="nova_senha" name="nova_senha" required="">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('confirm_senha') ? ' has-error' : '' }}">
            <label for="confirm_nova_senha">Confirme a Senha: <span class="required">*</span></label>
            <input type="password" class="form-control" id="confirm_nova_senha" name="confirm_nova_senha" required="">
        </div>
    </div>
</div>
<div class="text-right">
    <button type="submit" id="btn_submit" class="btn bg-green-jungle bg-font-green-jungle">Alterar senha</button>
</div>

{{ Form::close() }}

@endsection
