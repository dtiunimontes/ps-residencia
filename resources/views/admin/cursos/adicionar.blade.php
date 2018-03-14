@extends('layouts.app')

@section('title', 'Adicionar Curso')
@section('content')

{{ Form::open(['url' => route('admin.cursos.store'), 'method' => 'post']) }}
<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('nome') ? ' has-error' : '' }}">
            <label for="nome">Nome do Curso: <span class="required">*</span></label>
            <input type="text" class="form-control" id="nome" name="nome" value="{{ old('nome') }}" required>
            @if ($errors->has('nome'))
                <span class="help-block">
                    <strong>{{ $errors->first('nome') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
<button type="submit" class="btn bg-green-jungle bg-font-green-jungle">Enviar</button>
{{ Form::close() }}
@endsection
