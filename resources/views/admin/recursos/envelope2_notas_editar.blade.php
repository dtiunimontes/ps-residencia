@extends('layouts.app')
@section('title', 'Editar Recurso - Inscrição #'.$recurso->inscricoes_id.' - Etapa 2')
@section('content')

<div class="portlet-body">
    <div class="general-item-list">
        <div class="list-group">
            @if(!empty($recurso->motivo_indeferimento_etapa2))
            <a href="javascript:;" class="list-group-item active">
                <h4 class="list-group-item-heading"><strong>Motivo do indeferimento da inscrição #{{ $recurso->inscricoes_id }}</strong></h4>
                <p class="list-group-item-text"> {{ $recurso->motivo_indeferimento_etapa2 }}</p>
            </a>
            @endif
        </div>

        @if(!empty($recurso->recurso_etapa2) OR !empty($recurso->resposta_recurso_etapa2))
            {{ Form::open(['url' => route('admin.recursos.envelope2.notas.relancar', $recurso->id), 'method' => 'post']) }}
            <div class="col-md-12">
                <div class="form-group">
                    <label class="caption-subject font-green-steel bold uppercase">Escreva o recurso do candidato abaixo: <span class="required">*</span></label>
                    <textarea name="recurso_etapa2" class="form-control" required  rows="8" cols="15">{{ $recurso->recurso_etapa2 }}</textarea>
                </div>
                <div class="form-group">
                    <label class="caption-subject font-green-steel bold uppercase">Escreva a resposta ao recurso do candidato: <span class="required">*</span></label>
                    <textarea name="resposta_recurso_etapa2" class="form-control" required  rows="8" cols="15">{{ $recurso->resposta_recurso_etapa2 }}</textarea>
                </div>
                <div class="form-group">
                    <label class="caption-subject font-green-steel bold uppercase">Responsável pela resposta: <span class="required">*</span></label>
                    <input type="text" name="autor_resposta_recurso_etapa2" class="form-control" required value="{{ $recurso->autor_resposta_recurso_etapa2 }}">
                </div>
                <button type="submit" class="btn bg-green-jungle bg-font-green-jungle">Salvar edição</button>
            </div>
            {{ Form::close() }}
        @endif
    </div>
</div>

@endsection
