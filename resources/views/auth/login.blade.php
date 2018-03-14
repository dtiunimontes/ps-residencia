@extends('layouts.app')

@section('title', 'Login')

@section('class-portlet', 'col-md-6 col-md-offset-3')
@section('content')

{{ Form::open(['url' => route('login')]) }}
    <div class="row">
        <div class="col-md-12">
            <div class="form-group {{ $errors->has('cpf') ? ' has-error' : '' }}">
                <label>CPF: <span class="required">* (Somente números)</span></label>
                <input type="text" class="form-control" name="cpf" required maxlength="11">
                @if ($errors->has('cpf'))
                    <span class="help-block">
                        <strong>{{ $errors->first('cpf') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label>Senha: <span class="required">*</span></label>
                <input id="password" type="password" class="form-control" name="password" required>

                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <button type="submit" class="btn bg-green-jungle bg-font-green-jungle">Entrar</button>
            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Lembrar-me
        </div>
        <div class="col-md-6 text-right">
            <a href="{{ route('password.request') }}">Esqueceu sua senha?</a>
        </div>
    </div>
{{ Form::close() }}

@endsection
