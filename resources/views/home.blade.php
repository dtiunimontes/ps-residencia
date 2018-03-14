@extends('layouts.app')
@section('title', 'Página Inicial')
@section('content')
    <div class="col-md-12">
        <div class="portlet light portlet-fit ">
            <div class="portlet-title">
                <div class="caption">
                    <i class=" icon-layers font-green"></i>
                    <span class="caption-subject font-green bold uppercase">PROGRAMAS DE RESIDÊNCIA MULTIPROFISSIONAL E EM ÁREA PROFISSIONAL DA SAÚDE</span>
                </div>
            </div>
            <div class="portlet-body">
                <div class="mt-element-step">
                    <div class="row step-background">
                        <div class="mt-step-desc">
                            <br> </div>
                        <div class="col-md-4 bg-grey-steel mt-step-col">
                            <a href="{{ route('login') }}" class="ancora">
                                <div class="mt-step-title uppercase font-grey-cascade"><strong>Login</strong></div>
                                <div class="mt-step-content font-grey-cascade">Clique aqui para acessar área do candidato</div>
                            </a>
                        </div>
                        @if(date('Y-m-d H:i') <= formatarDataHoraExtensoUSA($config->termino_inscricoes))
                            <div class="col-md-4 bg-grey-steel mt-step-col active">
                                <a href="{{ route('register') }}" class="ancora">
                                    <div class="mt-step-title uppercase font-grey-cascade"><strong>Inscrição</strong></div>
                                    <div class="mt-step-content font-grey-cascade">Clique aqui para realizar inscrição no processo seletivo</div>
                                </a>
                            </div>
                        @endif
                        <div class="col-md-4 bg-grey-steel mt-step-col error">
                            <a href="http://www.ceps.unimontes.br" target="_blank" class="ancora">
                                <div class="mt-step-title uppercase font-grey-cascade"><strong>CEPS</strong></div>
                                <div class="mt-step-content font-grey-cascade">Clique aqui para acessar o site do <strong>CEPS</strong></div>
                            </a>
                        </div>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>
@endsection
