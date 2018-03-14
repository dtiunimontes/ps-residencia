<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Cartão de Inscrição</title>
    <link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <style media="screen">
        @page { margin: 1cm; }
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
                <h2><strong>Cartão de Inscrição</strong></h2>
            </div><br><br><br>
            <h4><strong>Informações Gerais</strong></h4>
            <strong>NÚMERO DE INSCRIÇÃO DO CANDIDATO: </strong> {{ str_pad($inscricao->inscricao, 10, "0", STR_PAD_LEFT) }} <br>
            <strong>NOME DO CANDIDATO: </strong> {{ $inscricao->candidato_nome }} <br>
            <strong>CÓDIGO DE INSCRIÇÃO DA RESIDÊNCIA: </strong> {{ $inscricao->residencia_id }} <br>
            <strong>PROGRAMA: </strong> {{ $inscricao->programa }} <br>
            <strong>CATEGORIA PROFISSIONAL: </strong> {{ $inscricao->categoria_profissional }} <br>
            <strong>CIDADE POLO: </strong> {{ $inscricao->cidade_polo }} <br>
            <hr>
            <h4><strong>Prova</strong></h4>
            <strong>LOCAL: </strong> {{ $inscricao->local_prova }} <br>
            <strong>SALA: </strong> {{ $inscricao->sala_prova }} <br>
            <strong>ENDEREÇO: </strong> {{ $inscricao->endereco_prova }} <br>
        </div>
    </div>
</div>
</body>
</html>
