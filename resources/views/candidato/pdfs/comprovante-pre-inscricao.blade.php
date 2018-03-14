<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Folha de Identificação</title>
    <link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <style media="screen">
        @page { margin: 1cm; };
    </style>
</head>
<body>
<header class="header" style="position: fixed; height:100px;">
    <img src="{{ asset('assets/img/header_programa_residencia.png') }}" class="img-responsive" alt="">
</header>
<div class="container" style="font-family: 'Arial', sans-serif!important;">
    <div class="col-md-12" style="position:absolute; top: 5cm;">
        <div class="col-md-12" id="indigena">
            <div class="col-md-12 text-uppercase text-center">
                <h2><strong>Comprovante de Pré-Inscrição</strong></h2>
            </div><br><br><br><br>

            <p style="text-align: justify">O CANDIDATO(A) <strong>{{ $inscricao->candidato_nome }}</strong>, COM NÚMERO DE INSCRIÇÃO <strong>{{ str_pad($inscricao->inscricao_id, 10, "0", STR_PAD_LEFT) }}</strong> REALIZOU A PRÉ-INSCRIÇÃO PARA O PEDIDO DE ISENÇÃO DA TAXA DE INSCRIÇÃO DO <strong>PROCESSO SELETIVO PARA OS PROGRAMAS DE RESIDÊNCIA MULTIPROFISSIONAL E EM ÁREA PROFISSIONAL DA SAÚDE - EDITAL 1/2018</strong> no dia <strong>{{ date('d/m/Y', strtotime($inscricao->data_pediu_isencao)) }}</strong></p>
        </div>
    </div>
</div>
</body>
</html>
