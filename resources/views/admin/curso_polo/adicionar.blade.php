@extends('layouts.app')

@section('title', 'Vincular Curso ao Polo')
@section('content')

{{ Form::open(['url' => route('admin.curso_polo.store'), 'method' => 'post']) }}
<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('polo_id') ? ' has-error' : '' }}">
            <label for="polo_id">Campus: <span class="required">*</span></label>
            <select class="form-control" name="polo_id">
                @foreach ($polos as $polo)
                    <option value="{{ $polo->id }}" @if (old('polo_id') == $polo->id) selected @endif >{{ $polo->nome }}</option>
                @endforeach
            </select>
            @if ($errors->has('polo_id'))
                <span class="help-block">
                    <strong>{{ $errors->first('polo_id') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('curso_id') ? ' has-error' : '' }}">
            <label for="curso_id">Curso: <span class="required">*</span></label>
            <select class="form-control" name="curso_id">
                @foreach ($cursos as $curso)
                    <option value="{{ $curso->id }}" @if (old('curso_id') == $curso->id) selected @endif >{{ $curso->nome }}</option>
                @endforeach
            </select>
            @if ($errors->has('curso_id'))
                <span class="help-block">
                    <strong>{{ $errors->first('curso_id') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group {{ $errors->has('codigo') ? ' has-error' : '' }}">
            <label for="codigo">Código: <span class="required">*</span></label>
            <input type="number" class="form-control" name="codigo" value="">
            @if ($errors->has('codigo'))
                <span class="help-block">
                    <strong>{{ $errors->first('codigo') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group {{ $errors->has('periodo') ? ' has-error' : '' }}">
            <label for="periodo">Período: <span class="required">*</span></label>
            <select class="form-control" name="periodo">
                <option value="1" @if (old('periodo') == '1') selected @endif >1</option>
                <option value="2" @if (old('periodo') == '2') selected @endif >2</option>
                <option value="3" @if (old('periodo') == '3') selected @endif >3</option>
                <option value="4" @if (old('periodo') == '4') selected @endif >4</option>
                <option value="5" @if (old('periodo') == '5') selected @endif >5</option>
                <option value="6" @if (old('periodo') == '6') selected @endif >6</option>
                <option value="7" @if (old('periodo') == '7') selected @endif >7</option>
                <option value="8" @if (old('periodo') == '8') selected @endif >8</option>
                <option value="9" @if (old('periodo') == '9') selected @endif >9</option>
                <option value="10" @if (old('periodo') == '10') selected @endif >10</option>
            </select>
            @if ($errors->has('periodo'))
                <span class="help-block">
                    <strong>{{ $errors->first('periodo') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group {{ $errors->has('turno') ? ' has-error' : '' }}">
            <label for="turno">Turno: <span class="required">*</span></label>
            <select class="form-control" name="turno">
                <option value="Diurno" @if (old('turno') == 'Diurno') selected @endif >Diurno</option>
                <option value="Noturno" @if (old('turno') == 'Noturno') selected @endif >Noturno</option>
                <option value="Matutino" @if (old('turno') == 'Matutino') selected @endif >Matutino</option>
                <option value="Vespertino" @if (old('turno') == 'Vespertino') selected @endif >Vespertino</option>
            </select>
            @if ($errors->has('turno'))
                <span class="help-block">
                    <strong>{{ $errors->first('turno') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group {{ $errors->has('vagas') ? ' has-error' : '' }}">
            <label for="vagas">Quantidade de Vagas: <span class="required">*</span></label>
            <input type="number" class="form-control" name="vagas" value="">
            @if ($errors->has('vagas'))
                <span class="help-block">
                    <strong>{{ $errors->first('vagas') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
<button type="submit" class="btn bg-green-jungle bg-font-green-jungle">Enviar</button>
{{ Form::close() }}
@endsection
