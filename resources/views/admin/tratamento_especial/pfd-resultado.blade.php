<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Resultado do Pedido de Tratamento Especial</title>
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
        <h4><strong>CANDIDATOS DEFERIDOS</strong></h4>

        @if(count($deferidos) != 0)
            <table class="table table-condensed table-bordered table-striped">
                <tr>
                    <th style="text-align: center;">INSCRIÇÃO</th>
                    <th>NOME</th>
                    <th>RG</th>
                </tr>
                @foreach($deferidos as $deferido)
                    <tr>
                        <td width="40px" align="center">{{ $deferido->id }}</td>
                        <td class="upper">{{ $deferido->nome }}</td>
                        <td width="200px">{{ $deferido->rg }}</td>
                    </tr>
                @endforeach
            </table>
        @else
            <small>Não há candidatos deferidos</small>
        @endif
        @if(isset($indeferidos))
            <br><br>
            <h4><strong>CANDIDATOS INDEFERIDOS</strong></h4>

            @if(count($indeferidos) != 0)
                <table class="table table-condensed table-bordered table-striped">
                    <tr>
                        <th style="text-align: center;">INSCRIÇÃO</th>
                        <th>NOME</th>
                        <th>RG</th>
                        <th>MOTIVO</th>
                    </tr>
                    @foreach($indeferidos as $indeferido)
                        <tr>
                            <td width="40px" align="center">{{ $indeferido->id }}</td>
                            <td class="upper">{{ $indeferido->nome }}</td>
                            <td width="200px">{{ $indeferido->rg }}</td>
                            <td width="200px">{{ $indeferido->motivo_indeferimento_tratamento_especial }}</td>
                        </tr>
                    @endforeach
                </table>
            @else
                <small>Não há candidatos deferidos</small>
            @endif
        @endif
    </div>
</div>
</body>
</html>
