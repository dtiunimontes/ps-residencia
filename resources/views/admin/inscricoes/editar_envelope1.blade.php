@extends('layouts.app')
@section('title', 'Envelope 1 - Editar Análise - Inscrições')
@section('content')

@push('scripts')
<script type="text/javascript">

$(document).ready(function(){
    $('#inscricao').focus();
});

</script>
@endpush

<style media="screen">
.ou{
    font-weight: bolder;
    line-height: 35px;
    font-size: 20px;
}
</style>

<div class="row">
    {{ Form::open(['url' => route('admin.inscricoes.buscar.inscricao.editar'), 'method' => 'get']) }}
    <input type="hidden" name="envelope" value="1">
    <div class="col-md-2">
        <input type="text" class="form-control" id="inscricao" name="inscricao" placeholder="Inscrição" onKeyDown="bloquearCtrlJ()">
    </div>
    <div class="col-md-1">
        <button type="submit" class="btn bg-green-jungle bg-font-green-jungle">Buscar</button>
    </div>
    {{ Form::close() }}
</div>
<br>
<hr>

<small>OBS: Na listagem abaixo só aparecem as inscrições que já foram deferidas ou indeferidas!</small><br>
<br><br>
<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-hover table-condensed">
                <tr>
                    <th>#</th>
                    <th>Candidato</th>
                    <th>CPF</th>
                    <th>RG</th>
                    <th>Campus</th>
                    <th>Curso</th>
                    <th>Info</th>
                    <th>Ações</th>
                </tr>
                @foreach($inscricoes as $inscricao)
                <tr>
                    <td>{{ $inscricao->id }}</td>
                    <td>{{ $inscricao->nome }}</td>
                    <td>{{ $inscricao->cpf }}</td>
                    <td>{{ $inscricao->rg }}</td>
                    <td>{{ $inscricao->polo_nome }}</td>
                    <td>{{ $inscricao->curso_nome }}</td>
                    <td>CÓD. {{ $inscricao->codigo}} - {{ strtoupper($inscricao->turno) }} - {{ $inscricao->periodo }}º PERÍODO</td>
                    <td>
                        {{ Form::open(['url' => route('admin.inscricoes.envelope1.analise.editar', $inscricao->id), 'method' => 'post']) }}
                        <div class="radio">
                            <label><input type="radio" name="resultado" value="2" @php echo ($inscricao->status_envelope1 == 2) ? 'checked="checked"' : '' @endphp>Deferido</label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" name="resultado" value="3" @php echo ($inscricao->status_envelope1 == 3) ? 'checked="checked"' : '' @endphp>Indeferido</label>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn bg-green-jungle bg-font-green-jungle">ok!</button>
                        </div>
                        {{ Form::close() }}
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>

<div class="row">
    <div class="text-center">
        {{ $inscricoes->links() }}
    </div>
</div>
@endsection
