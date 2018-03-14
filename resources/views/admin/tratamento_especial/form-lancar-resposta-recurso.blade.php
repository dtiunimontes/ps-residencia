@extends('layouts.app')
@section('title', 'Lançamento da resposta ao recurso do candidato - Pedido de Tratamento Especial')
@section('content')

    {{-- "http://localhost/programa-residencia/public/admin/isencao/candidatos/deferidos" --}}
    @php
        $url = explode('//', URL::previous());
        $url = explode('/', $url[1]);
        $tipo = end($url);
    @endphp

    {{ Form::open(['url' => route('admin.tratamento_especial.recurso.lancar', ['id' => $inscricao->id, 'tipo' => $tipo]), 'method' => 'PUT']) }}
    <div class="col-md-12">
        <div class="form-group">
            <label class="caption-subject font-green-steel bold uppercase">Resposta ao recurso da inscrição {{ $inscricao->id }}: <span class="required">*</span></label>
            <textarea name="resposta_recurso_tratamento_especial" class="form-control" required  rows="6" cols="15">{{ !empty($inscricao->resposta_recurso_tratamento_especial) ? $inscricao->resposta_recurso_tratamento_especial : '' }}</textarea>
        </div>
        <input type="checkbox" name="deferido" {{ $inscricao->tratamento_especial == \App\Models\Inscricao::DEFERIDO ? 'checked="checked"' : '' }}> Deferir pedido do candidato? <br><br>
        <button type="submit" class="btn bg-green-jungle bg-font-green-jungle">Salvar</button>
    </div>
    {{ Form::close() }}

@endsection
