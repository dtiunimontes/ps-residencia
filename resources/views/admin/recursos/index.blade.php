@extends('layouts.app')
@section('title', 'Recursos')
@section('content')

<div class="row">
    <div class="col-md-8">
        <h3 class="form-section">Envelope 1</h3>
        <div class="row">
            <div class="col-md-6">
                <a class="dashboard-stat dashboard-stat-v2 red" href="{{ route('admin.recursos.envelope1.inscricoes.indeferidas') }}">
                    <div class="visual">
                        <i class="fa fa-globe"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span data-counter="counterup"><b>{{ $inscricoes_indeferidas_pendentes }}</b></span>
                        </div>
                        <div class="desc"><b>Recursos a lançar</b></div>
                    </div>
                </a>
            </div>
            <div class="col-md-6">
                <a class="dashboard-stat dashboard-stat-v2 green" href="{{ route('admin.recursos.envelope1.inscricoes.indeferidas.lancadas') }}">
                    <div class="visual">
                        <i class="fa fa-globe"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span data-counter="counterup"><b>{{ $inscricoes_indeferidas_lancadas }}</b></span>
                        </div>
                        <div class="desc"><b>Recursos lançados</b></div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <h3 class="form-section">Envelope 2</h3>
        <div class="row">
            <div class="col-md-12">
                <a class="dashboard-stat dashboard-stat-v2 red" href="{{ route('admin.recursos.envelope2.notas') }}">
                    <div class="visual">
                        <i class="fa fa-globe"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span data-counter="counterup"><b></b></span>
                        </div>
                        <div class="desc"><b>Notas</b></div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

@endsection
