@extends('layouts.app')
@section('title', 'Indeferimento de Pedido de Tratamento Especial')
@section('content')
    {{ Form::open(['url' => route('admin.indeferimento_tratamento.update', $id), 'method' => 'PUT']) }}
    <div class="col-md-12">
        <div class="form-group">
            <label class="caption-subject font-green-steel bold uppercase">Motivo do indeferimento do pedido de tratamento especial da inscrição {{ $id }}: <span class="required">*</span></label>
            <textarea name="motivo_indeferimento_tratamento_especial" class="form-control" required  rows="6" cols="15"></textarea>
        </div>
        <button type="submit" class="btn bg-green-jungle bg-font-green-jungle">Salvar</button>
    </div>
    {{ Form::close() }}
@endsection
