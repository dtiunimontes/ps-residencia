@extends('layouts.app')
@section('title', 'Envelope 1 - Inscrições')
@section('content')

@push('scripts')
<script type="text/javascript">

$(document).ready(function(){
    $('#inscricao').focus();
});

// Bloqueia o Ctrl + J, pois quando a leitora lê o número automaticamente ela acessa a área de downloads do navegador...
function bloquearCtrlJ(){

    var tecla=window.event.keyCode;
    var ctrl=window.event.ctrlKey;

    if(ctrl && tecla==74){
        event.keyCode=0;
        event.returnValue=false;
    }
}
</script>
@endpush

<style media="screen">
.ou{
    font-weight: bolder;
    line-height: 35px;
    font-size: 20px;
}
</style>

{{ Form::open(['url' => route('admin.inscricoes.envelope1.indeferimento.motivo', $inscricao->id), 'method' => 'post']) }}
<div class="col-md-12">
    <div class="form-group">
        <label class="caption-subject font-green-steel bold uppercase">Motivo do indeferimento do envelope 1 da inscrição {{ $inscricao->id }}: <span class="required">*</span></label>
        <textarea name="motivo_indeferimento" class="form-control" required  rows="6" cols="15"></textarea>
    </div>
    <button type="submit" class="btn bg-green-jungle bg-font-green-jungle">Salvar</button>
</div>

{{ Form::close() }}
@endsection
