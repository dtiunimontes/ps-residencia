@extends('layouts.app')
@section('title', 'Alocação')
@section('content')
    <script>
        function marcarOuDesmarcarCheckboxes(){
            $(".check").each(function(){
                if($(this).prop("checked")){
                    $(this).prop("checked", false);
                }else{
                    $(this).prop("checked", true);
                }
            });
            event.preventDefault();
        }
    </script>
    <div class="row">
        <div class="col-md-12">
            {{ Form::open(['url' => route('admin.alocacao.index'), 'method' => 'get', 'class' => 'form-inline']) }}
                <div class="form-group">
                    <input type="text" name="cidadeId" placeholder="Cidade" class="form-control" value="{{ Request::get('cidadeId') }}">
                </div>
                <div class="form-group">
                    <input type="text" name="residenciaId" placeholder="Residência" class="form-control" value="{{ Request::get('residenciaId') }}">
                </div>
                <button type="submit" class="btn btn-sm btn-success">Buscar</button>
            {{ Form::close() }}
            <br><br>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th width="50"><a href="javascript;" onclick="marcarOuDesmarcarCheckboxes()" class="btn btn-sm btn-success">todos</a></th>
                        <th>INSCRIÇÃO</th>
                        <th>NOME</th>
                        <th>CPF</th>
                    </tr>
                    </thead>
                    {{ Form::open(['url' => route('admin.alocacao.alocar'), 'method' => 'post']) }}
                    <tbody>
                    @foreach($inscricoes as $inscricao)
                        <tr>
                            <td align="center"><input type="checkbox" class="check" name="inscricoes[]" value="{{ $inscricao->id }}"></td>
                            <td>{{ $inscricao->id }}</td>
                            <td>{{ $inscricao->nome }}</td>
                            <td>{{ $inscricao->cpf }}</td>
                        </tr>
                    @endforeach
                    <div class="form-inline">
                        <div class="form-group">
                            <input type="text" name="local" placeholder="Local"  class="form-control" value="{{ old('local') }}">
                        </div>
                        <div class="form-group">
                            <input type="text" name="sala" placeholder="Sala"  class="form-control" value="{{ old('sala') }}">
                        </div>
                        <div class="form-group">
                            <input type="text" name="endereco" placeholder="Endereço"  class="form-control" value="{{ old('endereco') }}">
                        </div>
                        <button type="submit" class="btn btn-sm btn-success">Alocar candidatos</button>
                    </div>
                    <br><br>
                    </tbody>
                    {{ Form::close() }}
                </table>
                <div class="text-center">
                    {{ $inscricoes->appends(Request::all())->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection