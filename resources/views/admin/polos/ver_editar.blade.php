@extends('layouts.app')

@section('title', $titulo)
@section('content')

{{ Form::open(['url' => route('admin.polos.update', $polo->id), 'method' => 'post']) }}
<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('nome') ? ' has-error' : '' }}">
            <label for="nome">Nome do Campus: <span class="required">*</span></label>
            <input type="text" class="form-control" id="nome" name="nome" value="{{ $polo->nome }}" required @if($ver) readonly @endif>
            @if ($errors->has('nome'))
                <span class="help-block">
                    <strong>{{ $errors->first('nome') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
@if(!$ver)
<button type="submit" class="btn bg-green-jungle bg-font-green-jungle">Enviar</button>
@endif
<a href="{{ route('admin.polos.home')}}" class="btn bg-primary text-white">Voltar</a>
{{ Form::close() }}
@endsection
