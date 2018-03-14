@extends('layouts.app')
@section('title', "Recurso")
@section('content')

<div class="portlet-body">
    <div class="general-item-list">
        <div class="list-group">
            @if(!empty($recurso->motivo_indeferimento_etapa1))
            <a href="javascript:;" class="list-group-item active">
                <h4 class="list-group-item-heading"><strong>Motivo do indeferimento da inscrição #{{ $recurso->inscricoes_id }}</strong></h4>
                <p class="list-group-item-text"> {{ $recurso->motivo_indeferimento_etapa1 }}</p>
            </a>
            @endif
            @if(!empty($recurso->recurso_etapa1))
            <a href="javascript:;" class="list-group-item">
                <h4 class="list-group-item-heading"><strong>Recurso da inscrição #{{ $recurso->inscricoes_id }} - {{ formatarDataUSAParaBR($recurso->data_recurso_etapa1) }}</strong></h4>
                <p class="list-group-item-text"> {{ $recurso->recurso_etapa1 }} </p>
            </a>
            @endif
            @if(!empty($recurso->resposta_recurso_etapa1))
            <a href="javascript:;" class="list-group-item">
                <h4 class="list-group-item-heading"><strong>Resposta ao recurso da inscrição #{{ $recurso->inscricoes_id }} -  Autor da resposta: {{ $recurso->autor_resposta_recurso_etapa1 }} - {{ formatarDataUSAParaBR($recurso->data_resposta_recurso_etapa1) }}</strong></h4>
                <p class="list-group-item-text"> {{ $recurso->resposta_recurso_etapa1 }} </p>
            </a>
            @endif
        </div>

        {{-- @if(empty($recurso->recurso_etapa1))
        <br>
        <div class="row">
            {{ Form::open(['url' => route('admin.recursos.envelope1.inscricoes.indeferidas.lancar.recurso', $recurso->id), 'method' => 'post']) }}
            <div class="col-md-12">
                <div class="form-group">
                    <label class="caption-subject font-green-steel bold uppercase">Escreva o recurso do candidato abaixo: <span class="required">*</span></label>
                    <textarea name="recurso" class="form-control" required  rows="8" cols="15"></textarea>
                </div>
                <button type="submit" class="btn bg-green-jungle bg-font-green-jungle">Enviar recurso</button>
            </div>
            {{ Form::close() }}
        </div>
        @endif --}}

        @if(empty($recurso->recurso_etapa1))
        <br>
        <div class="row">
            {{ Form::open(['url' => route('admin.recursos.envelope1.inscricoes.indeferidas.responder.recurso', $recurso->id), 'method' => 'post']) }}
            <div class="col-md-12">
                <div class="form-group">
                    <label class="caption-subject font-green-steel bold uppercase">Escreva a resposta ao recurso do candidato: <span class="required">*</span></label>
                    <textarea name="resposta_recurso" class="form-control" required  rows="8" cols="15"></textarea>
                </div>
                <div class="form-group">
                    <label class="caption-subject font-green-steel bold uppercase">Responsável pela resposta: <span class="required">*</span></label>
                    <input type="text" name="autor_resposta_recurso" class="form-control" required>
                </div>
                <button type="submit" class="btn bg-green-jungle bg-font-green-jungle">Enviar recurso</button>
            </div>
            {{ Form::close() }}
        </div>
        @endif
    </div>
</div>

@endsection
