@extends('layouts.app')
@section('title', 'Administrador ')
@section('content')
<div class="row">
    {{--<div class="col-md-3" style="margin-bottom:15px;">--}}
        {{--<a class="dashboard-stat dashboard-stat-v2 green" href="javascript:;">--}}
            {{--<div class="visual">--}}
                {{--<i class="fa fa-globe"></i>--}}
            {{--</div>--}}
            {{--<div class="details">--}}
                {{--<div class="number">--}}
                    {{--<span data-counter="counterup"><strong>{{ $qtd_inscricoes }}</strong></span>--}}
                {{--</div>--}}
                {{--<div class="desc"><strong>Inscritos no Processo Seletivo</strong></div>--}}
            {{--</div>--}}
        {{--</a>--}}
    {{--</div>--}}
    {{--<div class="col-md-3" style="margin-bottom:15px;">--}}
        {{--<a class="dashboard-stat dashboard-stat-v2 blue" href="javascript:;">--}}
            {{--<div class="visual">--}}
                {{--<i class="fa fa-globe"></i>--}}
            {{--</div>--}}
            {{--<div class="details">--}}
                {{--<div class="number">--}}
                    {{--<span data-counter="counterup"><strong>{{ $qtd_inscricoes_dae_paga }}</strong></span>--}}
                {{--</div>--}}
                {{--<div class="desc"><strong>Pagaram a DAE</strong></div>--}}
            {{--</div>--}}
        {{--</a>--}}
    {{--</div>--}}
    {{--<div class="col-md-3" style="margin-bottom:15px;">--}}
        {{--<a class="dashboard-stat dashboard-stat-v2 red" href="javascript:;">--}}
            {{--<div class="visual">--}}
                {{--<i class="fa fa-globe"></i>--}}
            {{--</div>--}}
            {{--<div class="details">--}}
                {{--<div class="number">--}}
                    {{--<span data-counter="counterup"><strong>{{ $qtd_entregaram_envelope1 }}</strong></span>--}}
                {{--</div>--}}
                {{--<div class="desc"><strong>Envelope 1 - Entregues</strong></div>--}}
            {{--</div>--}}
        {{--</a>--}}
    {{--</div>--}}
    {{--<div class="col-md-3" style="margin-bottom:15px;">--}}
        {{--<a class="dashboard-stat dashboard-stat-v2 green" href="javascript:;">--}}
            {{--<div class="visual">--}}
                {{--<i class="fa fa-globe"></i>--}}
            {{--</div>--}}
            {{--<div class="details">--}}
                {{--<div class="number">--}}
                    {{--<span data-counter="counterup"><strong>{{ $qtd_entregaram_envelope2 }}</strong></span>--}}
                {{--</div>--}}
                {{--<div class="desc"><strong>Envelope 2 - Entregues</strong></div>--}}
            {{--</div>--}}
        {{--</a>--}}
    {{--</div>--}}
    {{--<div class="col-md-3" style="margin-bottom:15px;">--}}
        {{--<a class="dashboard-stat dashboard-stat-v2 blue" href="javascript:;">--}}
            {{--<div class="visual">--}}
                {{--<i class="fa fa-globe"></i>--}}
            {{--</div>--}}
            {{--<div class="details">--}}
                {{--<div class="number">--}}
                    {{--<span data-counter="counterup"><strong>{{ $qtd_envelope1_deferidos }}</strong></span>--}}
                {{--</div>--}}
                {{--<div class="desc"><strong>Envelope 1 - Deferidos</strong></div>--}}
            {{--</div>--}}
        {{--</a>--}}
    {{--</div>--}}
    {{--<div class="col-md-3" style="margin-bottom:15px;">--}}
        {{--<a class="dashboard-stat dashboard-stat-v2 red" href="javascript:;">--}}
            {{--<div class="visual">--}}
                {{--<i class="fa fa-globe"></i>--}}
            {{--</div>--}}
            {{--<div class="details">--}}
                {{--<div class="number">--}}
                    {{--<span data-counter="counterup"><strong>{{ $qtd_envelope1_indeferidos }}</strong></span>--}}
                {{--</div>--}}
                {{--<div class="desc"><strong>Envelope 1 - Indeferidos</strong></div>--}}
            {{--</div>--}}
        {{--</a>--}}
    {{--</div>--}}
</div>
@endsection
