@extends('layouts.app')
@section('title', 'Todas as Inscrições')
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

{{ Form::open(['url' => route('admin.inscricoes.buscar'), 'method' => 'get']) }}
<div class="row">
    <div class="col-md-3">
        <input type="text" class="form-control" id="inscricao" name="inscricao" placeholder="Inscrição">
    </div>
    <div class="col-md-1">
        <div class="text-center">
            <span class="ou">ou</span>
        </div>
    </div>
    <div class="col-md-3">
        <input type="text" class="form-control" id="cpf" name="cpf" placeholder="CPF do candidato">
    </div>
    <div class="col-md-1">
        <div class="text-center">
            <span class="ou">ou</span>
        </div>
    </div>
    <div class="col-md-3">
        <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome do candidato">
    </div>
    <div class="col-md-1">
        <button type="submit" class="btn bg-green-jungle bg-font-green-jungle">Buscar</button>
    </div>
</div>
{{ Form::close() }}

<br><hr>

<div class="note note-success">
    <h4 class="block"><i class="fa fa-check-square-o"></i> Foram realizadas <strong>{{ $qtd_inscricoes }}</strong> inscrições neste processo seletivo!</h4>
</div>

<small>OBS: A listagem abaixo mostra absolutamente todas as inscrições realizadas neste processo seletivo!</small><br>
<small>OBS: A ultima coluna da tabela informa os status do <strong>envelope 1</strong> e do <strong>envelope 2</strong>!</small>
<br><br>
<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-hover table-condensed table-bordered">
                <tr>
                    <th>#</th>
                    <th>Candidato</th>
                    <th>CPF</th>
                    <th>RG</th>
                    <th>Campus</th>
                    <th>Curso</th>
                    <th>Info</th>
                    <th>DAE</th>
                    <th>Status</th>
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
                    <td style="text-align: center;">
                        @if($inscricao->status_dae == 1)
                            <span class="badge badge-success badge-roundless">Paga</span>
                        @elseif($inscricao->status_dae == 0)
                            <span class="badge badge-danger badge-roundless">Pendente</span>
                        @endif
                    </td>
                    <td>
                        <label>Envelope 1:</label><br>
                        @if($inscricao->status_envelope1 == 'Envelope Pendente')
                            <span class="label label-danger">{{ $inscricao->status_envelope1 }}</span>
                        @elseif($inscricao->status_envelope1 == 'Envelope Entregue')
                            <span class="label label-success">{{ $inscricao->status_envelope1 }}</span>
                        @elseif($inscricao->status_envelope1 == 'Documentação Deferida')
                            <span class="label label-primary">{{ $inscricao->status_envelope1 }}</span>
                        @elseif($inscricao->status_envelope1 == 'Documentação Indeferida')
                            <span class="label label-info">{{ $inscricao->status_envelope1 }}</span>
                        @endif
                        <br>
                        <label>Envelope 2:</label><br>
                        @if($inscricao->status_envelope2 == 'Envelope Pendente')
                            <span class="label label-danger">{{ $inscricao->status_envelope2 }}</span>
                        @elseif($inscricao->status_envelope2 == 'Envelope Entregue')
                            <span class="label label-primary">{{ $inscricao->status_envelope2 }}</span>
                        @endif
                        <br>
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
