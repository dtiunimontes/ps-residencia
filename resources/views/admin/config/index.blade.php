@extends('layouts.app')

@section('title', 'Configurações do Processo Seletivo')
@section('content')

@push('scripts')
<script type="text/javascript">
$(function(){
    $('#inicio_inscricoes').mask('00/00/0000 00:00:00', {placeholder: "__/__/____ 00:00:00"});
    $('#termino_inscricoes').mask('00/00/0000 00:00:00', {placeholder: "__/__/____ 00:00:00"});
    $('#inicio_resultado_preliminar').mask('00/00/0000 00:00:00', {placeholder: "__/__/____ 00:00:00"});
    $('#termino_resultado_preliminar').mask('00/00/0000 00:00:00', {placeholder: "__/__/____ 00:00:00"});
    $('#inicio_resultado_final').mask('00/00/0000 00:00:00', {placeholder: "__/__/____ 00:00:00"});
    $('#termino_resultado_final').mask('00/00/0000 00:00:00', {placeholder: "__/__/____ 00:00:00"});
    $('#inicio_recursos_etapa1').mask('00/00/0000 00:00:00', {placeholder: "__/__/____ 00:00:00"});
    $('#termino_recursos_etapa1').mask('00/00/0000 00:00:00', {placeholder: "__/__/____ 00:00:00"});
    $('#inicio_recursos_etapa2').mask('00/00/0000 00:00:00', {placeholder: "__/__/____ 00:00:00"});
    $('#termino_recursos_etapa2').mask('00/00/0000 00:00:00', {placeholder: "__/__/____ 00:00:00"});
});
</script>
@endpush

{{ Form::open(['url' => route('admin.config.update', $config->id), 'method' => 'post']) }}

<div class="row">
    <div class="col-md-3 col-md-offset-3">
        <div class="form-group">
            <label>Início das incrições</label><br>
            <input type="text" name="inicio_inscricoes" id="inicio_inscricoes" class="form-control" value="{{ date('d\/m\/Y H:i:s', strtotime($config->inicio_inscricoes)) }}" required="">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label>Fim das incrições</label><br>
            <input type="text" name="termino_inscricoes" id="termino_inscricoes" class="form-control" value="{{ date('d\/m\/Y H:i:s', strtotime($config->termino_inscricoes)) }}" required="">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-3 col-md-offset-3">
        <div class="form-group">
            <label>Início dos recursos - ETAPA 1</label><br>
            <input type="text" name="inicio_recursos_etapa1" id="inicio_recursos_etapa1" class="form-control" value="{{ date('d\/m\/Y H:i:s', strtotime($config->inicio_recursos_etapa1)) }}" required="">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label>Fim dos recursos - ETAPA 1</label><br>
            <input type="text" name="termino_recursos_etapa1" id="termino_recursos_etapa1" class="form-control" value="{{ date('d\/m\/Y H:i:s', strtotime($config->termino_recursos_etapa1)) }}" required="">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-3 col-md-offset-3">
        <div class="form-group">
            <label>Início dos recursos - ETAPA 2</label><br>
            <input type="text" name="inicio_recursos_etapa2" id="inicio_recursos_etapa2" class="form-control" value="{{ date('d\/m\/Y H:i:s', strtotime($config->inicio_recursos_etapa2)) }}" required="">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label>Fim dos recursos - ETAPA 2</label><br>
            <input type="text" name="termino_recursos_etapa2" id="termino_recursos_etapa2" class="form-control" value="{{ date('d\/m\/Y H:i:s', strtotime($config->termino_recursos_etapa2)) }}" required="">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-3 col-md-offset-3">
        <div class="form-group">
            <label>Início do Resultado Preliminar</label><br>
            <input type="text" name="inicio_resultado_preliminar" id="inicio_resultado_preliminar" class="form-control" value="{{ date('d\/m\/Y H:i:s', strtotime($config->inicio_resultado_preliminar)) }}" required="">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label>Fim do Resultado Preliminar</label><br>
            <input type="text" name="termino_resultado_preliminar" id="termino_resultado_preliminar" class="form-control" value="{{ date('d\/m\/Y H:i:s', strtotime($config->termino_resultado_preliminar)) }}" required="">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-3 col-md-offset-3">
        <div class="form-group">
            <label>Início do Resultado Final</label><br>
            <input type="text" name="inicio_resultado_final" id="inicio_resultado_final" class="form-control" value="{{ date('d\/m\/Y H:i:s', strtotime($config->inicio_resultado_final)) }}" required="">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label>Fim do Resultado Final</label><br>
            <input type="text" name="termino_resultado_final" id="termino_resultado_final" class="form-control" value="{{ date('d\/m\/Y H:i:s', strtotime($config->termino_resultado_final)) }}" required="">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-2 col-md-offset-5">
        <button type="submit" class="btn blue btn-block" name="submit">Salvar</button>
    </div>
</div>

{{ Form::close() }}

@endsection
