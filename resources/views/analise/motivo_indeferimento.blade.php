@extends('layouts.app')

@section('title', 'Análise do Envelope 1')
@section('content')

{{ Form::open(['url' => route('admin.analise.indeferimento'), 'method' => 'post']) }}

<h3 class="form-section">Indeferimento</h3>
<div class="row">
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('motivo_indeferimento_etapa1') ? ' has-error' : '' }}">
            <label>Motivo do Indeferimento: <span class="required">*</span></label>
            <input type="hidden" name="id" value="{{$id}}">
            <textarea name="motivo_indeferimento_etapa1" rows="8" class="form-control" required></textarea>
            @if ($errors->has('motivo_indeferimento_etapa1'))
                <span class="help-block">
                    <strong>{{ $errors->first('motivo_indeferimento_etapa1') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
<button type="submit" class="btn bg-green-jungle bg-font-green-jungle">Enviar</button>

{{ Form::close() }}

@endsection
