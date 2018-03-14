@extends('layouts.app')

@section('title', 'Editar Vinculação do Curso ao Polo')
@section('content')

{{ Form::open(['url' => route('admin.curso_polo.update',  $curso_polo->id), 'method' => 'post']) }}
<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('polo_id') ? ' has-error' : '' }}">
            <label for="polo_id">Nome do Campus: <span class="required">*</span></label>
            @if ($ver)
                @foreach ($polos as $polo)
                    @if ($curso_polo->polo_id == $polo->id)
                        <input type="text" class="form-control" value="{{ $polo->nome }}" readonly>
                    @endif
                @endforeach
            @else
                <select class="form-control" name="polo_id">
                    @foreach ($polos as $polo)
                        <option value="{{$polo->id}}" @if ($curso_polo->polo_id == $polo->id) selected @endif >{{ $polo->nome }}</option>
                    @endforeach
                </select>
            @endif
            @if ($errors->has('polo_id'))
                <span class="help-block">
                    <strong>{{ $errors->first('polo_id') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('curso_id') ? ' has-error' : '' }}">
            <label for="curso_id">Nome do Curso: <span class="required">*</span></label>
            @if ($ver)
                @foreach ($cursos as $curso)
                    @if ($curso_polo->curso_id == $curso->id)
                        <input type="text" class="form-control" value="{{ $curso->nome }}" readonly>
                    @endif
                @endforeach
            @else
            <select class="form-control" name="curso_id">
                @foreach ($cursos as $curso)
                    <option value="{{$curso->id}}" @if ($curso_polo->curso_id == $curso->id) selected @endif >{{ $curso->nome }}</option>
                @endforeach
            </select>
            @endif
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
            <input type="number" class="form-control" value="{{$curso_polo->id}}" readonly>
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
            @if ($ver)
                <input type="text" class="form-control" value="{{ $curso_polo->periodo }}" readonly>
            @else
            <select class="form-control" name="periodo">
                <option value="1" @if ($curso_polo->periodo == '1') selected @endif >1</option>
                <option value="2" @if ($curso_polo->periodo == '2') selected @endif >2</option>
                <option value="3" @if ($curso_polo->periodo == '3') selected @endif >3</option>
                <option value="4" @if ($curso_polo->periodo == '4') selected @endif >4</option>
                <option value="5" @if ($curso_polo->periodo == '5') selected @endif >5</option>
                <option value="6" @if ($curso_polo->periodo == '6') selected @endif >6</option>
                <option value="7" @if ($curso_polo->periodo == '7') selected @endif >7</option>
                <option value="8" @if ($curso_polo->periodo == '8') selected @endif >8</option>
                <option value="9" @if ($curso_polo->periodo == '9') selected @endif >9</option>
                <option value="10" @if ($curso_polo->periodo == '10') selected @endif >10</option>
            </select>
            @endif
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
            @if ($ver)
                <input type="text" class="form-control" value="{{ $curso_polo->turno }}" readonly>
            @else
            <select class="form-control" name="turno">
                <option value="Diurno" @if ($curso_polo->turno == 'Diurno') selected @endif >Diurno</option>
                <option value="Noturno" @if ($curso_polo->turno == 'Noturno') selected @endif >Noturno</option>
                <option value="Matutino" @if ($curso_polo->turno == 'Matutino') selected @endif >Matutino</option>
                <option value="Vespertino" @if ($curso_polo->turno == 'Vespertino') selected @endif >Vespertino</option>
            </select>
            @endif
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
            <input type="number" class="form-control" name="vagas" value="{{$curso_polo->vagas}}" @if ($ver) readonly @endif>
            @if ($errors->has('vagas'))
                <span class="help-block">
                    <strong>{{ $errors->first('vagas') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
@if(!$ver)
<button type="submit" class="btn bg-green-jungle bg-font-green-jungle">Enviar</button>
@endif
<a href="{{ route('admin.curso_polo.home')}}" class="btn bg-primary text-white">Voltar</a>
{{ Form::close() }}
@endsection
