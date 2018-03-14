@extends('layouts.app')
@section('title', 'Envelope 2  - Análise - Inscrições')
@section('content')

@push('scripts')
<script type="text/javascript">

$(document).ready(function(){
    $('#inscricao').focus();

    // $('input[name=media]').mask('000.00', {
    //     reverse: true
    // });
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
    {{ Form::open(['url' => route('admin.inscricoes.buscar.inscricao'), 'method' => 'get']) }}
    <input type="hidden" name="envelope" value="2">
    <div class="col-md-2">
        <input type="text" class="form-control" id="inscricao" name="inscricao" placeholder="Inscrição" onKeyDown="bloquearCtrlJ()">
    </div>
    <div class="col-md-1">
        <button type="submit" class="btn bg-green-jungle bg-font-green-jungle">Buscar</button>
    </div>
    {{ Form::close() }}
    <div class="col-md-1">
        <div class="text-center">
            <span class="ou">ou</span>
        </div>
    </div>
    {{ Form::open(['url' => route('admin.inscricoes.buscar.cpf'), 'method' => 'get']) }}
    <input type="hidden" name="envelope" value="2">
    <div class="col-md-2">
        <input type="text" class="form-control" id="cpf" name="cpf" placeholder="CPF do candidato">
    </div>
    <div class="col-md-1">
        <button type="submit" class="btn bg-green-jungle bg-font-green-jungle">Buscar</button>
    </div>
    {{ Form::close() }}
    <div class="col-md-1">
        <div class="text-center">
            <span class="ou">ou</span>
        </div>
    </div>
    {{ Form::open(['url' => route('admin.inscricoes.buscar.nome'), 'method' => 'get']) }}
    <input type="hidden" name="envelope" value="2">
    <div class="col-md-3">
        <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome do candidato">
    </div>
    <div class="col-md-1">
        <button type="submit" class="btn bg-green-jungle bg-font-green-jungle">Buscar</button>
    </div>
    {{ Form::close() }}
</div>
<br>
<hr>

@if(!isset($busca))
    @if($num_inscricoes > 1)
    <div class="note note-warning">
        <h4 class="block"><i class="fa fa-exclamation-triangle"></i> Ainda restam <strong>{{$num_inscricoes}}</strong> inscrições para serem lançadas as médias/número de disciplinas a serem cumpridas!</h4>
        </div>
    @elseif($num_inscricoes == 1)
    <div class="note note-warning">
        <h4 class="block"><i class="fa fa-exclamation-triangle"></i> Ainda resta <strong>{{$num_inscricoes}}</strong> inscrição para ser lançada a média/número de disciplinas a serem cumpridas!</h4>
    </div>
@elseif($num_inscricoes == 0)
    <div class="note note-success">
        <h4 class="block"><i class="fa fa-check-square-o"></i> Todas as médias/número de disciplinas a serem cumpridas já foram lançadas!</h4>
    </div>
    @endif
@endif

<small>OBS: Na listagem abaixo só aparecem as inscrições que entregaram os dois envelopes, foram deferidas/indeferidas!</small><br>
<small>OBS: Após <strong>lançar a média ou número de disciplinas a serem cumpridas de um candidato</strong>, ele também não estará listado abaixo. E passará a ser listado na parte de edição de envelopes!</small>
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
                        {{ Form::open(['url' => route('admin.inscricoes.envelope2.analise', $inscricao->candidato_id), 'method' => 'post']) }}
                        <label for="media">Média: </label><br>
                        <input type="text" name="media" required class="form-control" id="media" pattern="[0-9.]+$">
                        <label for="qtd_disc_falta">Número de disciplinas a serem cumpridas: </label><br>
                        <input type="number" name="qtd_disc_falta" class="form-control">
                        <div class="text-right">
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
