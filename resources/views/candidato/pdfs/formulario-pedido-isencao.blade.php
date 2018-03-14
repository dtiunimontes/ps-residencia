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
                <h2><strong> Formulário de Pré-Inscrição/Pedido de Isenção</strong></h2>
            </div><br><br><br><br>

            <strong>NÚMERO DE INSCRIÇÃO DO CANDIDATO: </strong> {{ str_pad($inscricao->inscricao_id, 10, "0", STR_PAD_LEFT) }} <br>
            <strong>NOME DO CANDIDATO: </strong> {{ $inscricao->candidato_nome }} <br><br>
            <strong>CÓDIGO DE INSCRIÇÃO DA RESIDÊNCIA: </strong> {{ $inscricao->residencia_id }} <br>
            <strong>PROGRAMA: </strong> {{ $inscricao->programa_nome }} <br>
            <strong>CATEGORIA PROFISSIONAL: </strong> {{ $inscricao->categoria_profissional_nome }} <br>
            <strong>CIDADE POLO: </strong> {{ $inscricao->cidade_polo_nome }} <br>
        </div>

        <br><br><br><br><br><br><br>
        <div class="text-center">
            ____________________________________________________ <br>
            Ass. de {{ $inscricao->candidato_nome }}
        </div>
    </div>
</div>
</body>
</html>
