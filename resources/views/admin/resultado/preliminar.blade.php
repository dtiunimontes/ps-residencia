@extends('layouts.app')

@section('title', 'Gerar Resultado Preliminar')
@section('content')

<br><br>
<div class="row">
    <div class="text-center">
        <a href="{{ route('admin.resultado.preliminar.gerar') }}" class="btn btn-lg blue"><i class="fa fa-file-o"></i> GERAR RESULTADO PRELIMINAR</a>
    </div>
</div>
<br><br>

@endsection
