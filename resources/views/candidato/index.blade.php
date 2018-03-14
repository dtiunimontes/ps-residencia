@extends('layouts.app')

@section('title', 'Área do Candidato')
@section('content')

    <div class="col-md-12">
        <div class="portlet light portlet-fit ">
            <div class="portlet-body">
                <div class="mt-element-step">
                    <div class="row step-background">
			@if(($inscricao->status_pedido_isencao == \App\Models\Inscricao::DEFERIDO) OR ($inscricao->status_dae == 1))
                        <div class="col-md-4 bg-grey-steel mt-step-col ancora">
                            <a href="{{ route('candidato.cartao-inscricao') }}" style="text-decoration: none;">
                                <div class="mt-step-title uppercase font-grey-cascade"><strong><i class="fa fa-file" aria-hidden="true"></i>&nbsp Cartão de Inscrição</strong></div>
                                <div class="mt-step-content font-grey-cascade">Cartão de inscrição com o local da sua prova</div>
                            </a>
                        </div>
                        @endif
                        @if(date('Y-m-d H:i') <= formatarDataHoraExtensoUSA($config->termino_pagamento_dae))
                        <div class="col-md-4 bg-grey-steel mt-step-col ancora">
                            <a href="javascript:;" onclick="submeterFormulario('emitir-dae')" style="text-decoration: none;">
                                <div class="mt-step-title uppercase font-grey-cascade"><strong><i class="fa fa-file" aria-hidden="true"></i>&nbsp; Emitir DAE</strong></div>
                                <div class="mt-step-content font-grey-cascade">Clique aqui para emitir a dae</div>
                            </a>
                        </div>
                        <form id="emitir-dae" action="{{ route('candidato.dae.store', $inscricao->id) }}" style="display: none;" method="POST">
                            {{csrf_field()}}
                        </form>
                        @else
                        @if((date('Y-m-d H:i') <= formatarDataHoraExtensoUSA($config->dia_limite_pag_dae_indeferidos)) AND ($inscricao->pediu_isencao == 1) AND ($inscricao->status_pedido_isencao == 1 OR empty($inscricao->status_pedido_isencao)))
                                <div class="col-md-4 bg-grey-steel mt-step-col ancora">
                                    <a href="javascript:;" onclick="submeterFormulario('emitir-dae')" style="text-decoration: none;">
                                        <div class="mt-step-title uppercase font-grey-cascade"><strong><i class="fa fa-file" aria-hidden="true"></i>&nbsp; Emitir DAE</strong></div>
                                        <div class="mt-step-content font-grey-cascade">Clique aqui para emitir a dae</div>
                                    </a>
                                </div>
                                <form id="emitir-dae" action="{{ route('candidato.dae.store', $inscricao->id) }}" style="display: none;" method="POST">
                                    {{csrf_field()}}
                                </form>
                            @endif
                        @endif
                        <div class="col-md-4 bg-grey-steel mt-step-col active ancora">
                            <a href="{{ route('candidato.isencao.index') }}" style="text-decoration: none;">
                                <div class="mt-step-title uppercase font-grey-cascade"><strong><i class="fa fa-usd" aria-hidden="true"></i> Pedido de isenção</strong></div>
                                <div class="mt-step-content font-grey-cascade">Clique aqui para pedir a isenção da taxa de inscrição</div>
                            </a>
                        </div>
                        <a href="{{ route('candidato.pdf.folha-identificacao-segunda-etapa') }}" class="ancora">
                            <div class="col-md-4 bg-grey-steel mt-step-col">
                                <div class="mt-step-title uppercase font-grey-cascade titulo"><i class="fa fa-file-text" aria-hidden="true"></i>&nbsp;<strong>Imprimir folha de identificação - 2ª Etapa</strong></div>
                            </div>
                        </a>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>
    @if($inscricao->pediu_isencao == 1)
    <div class="col-md-12">
        <div class="portlet light ">
            <div class="portlet-title">
                <div class="caption caption-md">
                    <i class="icon-bar-chart font-dark hide"></i>
                    <span class="caption-subject font-green-steel uppercase bold">Pedido de Isenção</span>
                </div>
            </div>
            <div class="portlet-body">
                @php $dataResultadoFinal = '2018-01-19 13:00'; @endphp
                @if($inscricao->pediu_isencao == 1)
                    <div class="well">
                        <h4 class="block">Você realizou o pedido de isenção dia <strong>{{ date('d/m/Y', strtotime($inscricao->data_pediu_isencao)) }}</strong>.
                        @if(date('Y-m-d H:i') >= formatarDataHoraExtensoUSA($dataResultadoFinal))
                            Sua situação atual é: <strong>{{ ($inscricao->status_pedido_isencao == 1) ? 'INDEFERIDO' : 'DEFERIDO' }}</strong></h4>
                        @endif
                    </div>
                @endif

                @if(date('Y-m-d H:i') >= formatarDataHoraExtensoUSA($dataResultadoFinal))
                    @if(!empty($inscricao->resposta_recurso_isencao))
                        <div class="col-md-12">
                            <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption caption-md">
                                        <i class="icon-bar-chart font-dark hide"></i>
                                        <span class="caption-subject font-green-steel uppercase bold">Resultado do Recurso ao Pedido de Isenção</span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="well">
                                        <h4 class="block"><strong>RESPOSTA AO RECURSO QUE VOCÊ ENVIOU:</strong></h4>
                                        <p>{{ $inscricao->resposta_recurso_isencao }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
    @endif

@endsection
