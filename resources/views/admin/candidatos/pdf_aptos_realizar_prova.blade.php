<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Candidatos aptos a realizar a prova</title>
    <link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <style>
        @page { margin: 1cm; }
        .upper{
            text-transform: uppercase;
        }
        td{
            text-transform: uppercase;
        }
    </style>
</head>
<body>
<header class="header" style="position: fixed; height:100px;">
    <img src="{{ asset('assets/img/header_programa_residencia.png') }}" class="img-responsive" alt="">
</header>
<div class="container" style="font-family: 'Roboto', sans-serif!important;">
    <div class="col-md-12" style="top: 5cm;">
        <br><br>
        @foreach($aptosRealizarProva as $nomeCidade => $candidatosArray)
            <h4><strong>CIDADE: {{ strtoupper($nomeCidade) }}</strong></h4>
            @foreach($candidatosArray as $residenciaId => $candidatos)
                <h5><strong>RESIDÊNCIA DE CÓDIGO: {{ $residenciaId }}</strong> - {{ count($candidatos) }} CANDIDATOS APTOS</h5>
                <table class="table table-condensed table-bordered table-striped">
                    <tr>
                        <th width="90">Nº INSCRIÇÃO</th>
                        <th>NOME</th>
                        <th width="90">CPF</th>
                    </tr>
                    @foreach($candidatos as $apto)
                        <tr>
                            <td>{{ $apto->id }}</td>
                            <td>{{ $apto->nome }}</td>
                            <td>{{ $apto->cpf }}</td>
                        </tr>
                    @endforeach
                </table>
            @endforeach
        @endforeach
    </div>
</div>
</body>
</html>
