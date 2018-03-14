@extends('layouts.app')

@section('title', $titulo)
@section('content')

@if($acao == 'verificar')
    {{ Form::open(['url' => route('admin.analise.edit'), 'method' => 'post']) }}
@else
    {{ Form::open(['url' => route('admin.analise.store'), 'method' => 'post']) }}
@endif
<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('id') ? ' has-error' : '' }}">
            <label for="id">Código de Barras: <span class="required">*</span></label>
            <input type="text" class="form-control" id="id" name="id" autofocus>
            <input type="hidden" name="acao" value=" {{ $acao }} ">
            @if ($errors->has('id'))
                <span class="help-block">
                    <strong>{{ $errors->first('id') }}</strong>
                </span>
            @endif
        </div>
    </div>
    @if($acao == 'verificar')
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('cpf') ? ' has-error' : '' }}">
            <label for="cpf">CPF: <span class="required">*</span></label>
            <input type="text" class="form-control" id="cpf" name="cpf">
            @if ($errors->has('cpf'))
                <span class="help-block">
                    <strong>{{ $errors->first('cpf') }}</strong>
                </span>
            @endif
        </div>
    </div>
    @endif
</div>
<button type="submit" class="btn bg-green-jungle bg-font-green-jungle">@if($acao == 'verificar') Verificar @else Receber @endif</button>

{{ Form::close() }}

<script>
document.onkeydown = function(e) {
        if (e.ctrlKey &&
            (e.keyCode === 74 )) {
            return false;
        }
};
</script>

@endsection
