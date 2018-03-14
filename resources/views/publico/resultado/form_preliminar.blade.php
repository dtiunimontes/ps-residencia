@extends('layouts.app')

@section('title', 'Resultado Preliminar')
@section('content')

@push('scripts')
<script type="text/javascript">

    $(document).ready(function(){

        var campus = $('select[name=campus]').val();
        var options;
        var i;

        if(campus != ''){

            $.ajax({
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: 'post',
                url: '{{ route('resultado.campus.cursos') }}',
                data: '&campus=' + campus,
                success: function(retorno){

                    if(retorno.length == 0){
                        $('#curso').html('<option value=""></option>');
                    }else{

                        options += '<option value="">Selecione</option>';

                        for(i=0; i<retorno.length; i++){

                            options += '<option value="' + retorno[i].id + '">'+retorno[i].nome+' - CÓDIGO ' + retorno[i].id + ' - ' + retorno[i].turno.toUpperCase() + ' - ' + retorno[i].periodo + '° PERÍODO - ' + retorno[i].vagas + ' VAGAS</option>';
                        }

                        $('#curso').html(options);
                    }
                }
            });
        }

        // Trás o array com os cursos do Campus selecionado pelo candidato
        $('#campus').on('change', function(){

            var campus = $('select[name=campus]').val();
            var options;
            var i;

            if(campus != ''){

                $.ajax({
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: 'post',
                    url: '{{ route('resultado.campus.cursos') }}',
                    data: '&campus=' + campus,
                    success: function(retorno){

                        if(retorno.length == 0){
                            $('#curso').html('<option value=""></option>');
                        }else{

                            options += '<option value="">Selecione</option>';

                            for(i=0; i<retorno.length; i++){

                                options += '<option value="' + retorno[i].id + '">'+retorno[i].nome+' - CÓDIGO ' + retorno[i].id + ' - ' + retorno[i].turno.toUpperCase() + ' - ' + retorno[i].periodo + '° PERÍODO - ' + retorno[i].vagas + ' VAGAS</option>';
                            }

                            $('#curso').html(options);
                        }
                    }
                });
            }
        });
    });
</script>
@endpush

{{ Form::open(['url' => route('resultado.preliminar.gerar'), 'method' => 'get']) }}

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="campus">Município/Campus: <span class="required">*</span></label>
            <select class="form-control" name="campus" id="campus" required>
                @foreach($campi as $campus)
                <option value="{{ $campus->id }}">{{ $campus->nome }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-8">
        <div class="form-group">
            <label for="curso">Curso e informações: <span class="required">*</span></label>
            <select class="form-control" name="curso_polo_id" id="curso" required></select>
        </div>
    </div>
</div>
<div class="text-right">
    <button type="submit" id="btn_submit" class="btn bg-green-jungle bg-font-green-jungle">Gerar Resultado</button>
</div>

{{ Form::close() }}

@endsection
