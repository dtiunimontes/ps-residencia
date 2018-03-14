@extends('layouts.app')

@section('title', 'Área do Candidato')
@section('content')

    @if($inscricao->pediu_isencao == 0)
        @if(date('Y-m-d H:i') <= formatarDataHoraExtensoUSA($config->termino_pedido_isencao))
            {{ Form::open(['url' => route('candidato.isencao.update', $inscricao->id), 'method' => 'PUT']) }}
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group {{ $errors->has('condicao_isencao') ? ' has-error' : '' }}">
                        <label for="condicao_isencao">Escolha condição de isenção: <span class="required">*</span></label>
                        <select name="condicao_isencao" id="condicao_isencao" class="form-control" required>
                            @foreach($condicoesIsencao as $condicao)
                                <option value="{{ $condicao->id }}">{{ $condicao->nome }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('condicao_isencao'))
                            <span class="help-block">
                    <strong>{{ $errors->first('condicao_isencao') }}</strong>
                </span>
                        @endif
                    </div>
                    <div class="text-right">
                        <button type="submit" id="btn_submit" class="btn bg-green-jungle bg-font-green-jungle">Pedir isenção
                        </button>
                    </div>
                </div>
            </div>
            {{ Form::close() }}
        @endif
    @else

        <br>
        <div class="portlet-body">
            <div class="mt-element-step">
                <div class="row step-background">
                    <a href="{{ route('candidato.pdf.folha-identificacao') }}" class="ancora">
                        <div class="col-md-4 bg-grey-steel mt-step-col">
                            <div class="mt-step-title uppercase font-grey-cascade titulo"><i class="fa fa-file-text" aria-hidden="true"></i>&nbsp;<strong>Imprimir folha de identificação</strong></div>
                        </div>
                    </a>
                    <a href="{{ route('candidato.pdf.comprovante-pre-inscricao-isencao') }}" class="ancora">
                        <div class="col-md-4 bg-grey-steel mt-step-col active">
                            <div class="mt-step-title uppercase font-grey-cascade titulo"><i class="fa fa-file-text" aria-hidden="true"></i>&nbsp;<strong>Imprimir comprovante do Pedido de Inscrição</strong></div>
                        </div>
                    </a>
                    <a href="{{ route('candidato.pdf.formulario-pedido-isencao') }}" class="ancora">
                        <div class="col-md-4 bg-grey-steel mt-step-col error">
                            <div class="mt-step-title uppercase font-grey-cascade titulo"><i class="fa fa-file-text" aria-hidden="true"></i>&nbsp;<strong>Imprimir formulário de pedido de Isenção</strong></div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    @endif

@endsection