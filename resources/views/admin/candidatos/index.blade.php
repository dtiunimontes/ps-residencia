@extends('layouts.app')
@section('title', 'Candidatos')
@section('content')
    <div class="row">
        <div class="col-md-12">
            {{ Form::open(['url' => route('admin.candidatos.index'), 'method' => 'get']) }}
            <div class="form-group">
                <div class="input-group input-group-md">
                    <label>Buscar por: </label>
                    <select name="atributo" id="atributo" class="form-control">
                        <option value="cpf">CPF</option>
                        <option value="nome">NOME</option>
                        <option value="rg">RG</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="input-group input-group-md">
                    <input type="text" class="form-control" name="q">
                    <span class="input-group-btn">
                        <button class="btn green" type="submit">Buscar!</button>
                    </span>
                </div>
            </div>
            {{ Form::close() }}
            @if(count($candidatos) > 0)
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>CPF</th>
                        <th>NOME</th>
                        <th>RG</th>
                        <th class="text-center">DATA NASC.</th>
                        <th class="text-center">AÇÕES</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($candidatos as $candidato)
                        <tr>
                            <td>{{ $candidato->cpf }}</td>
                            <td>{{ $candidato->nome }}</td>
                            <td>{{ $candidato->rg }}</td>
                            <td class="text-center">{{ date('d/m/Y', strtotime($candidato->data_nasc)) }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.candidatos.edit', $candidato->id) }}" class="btn blue-madison"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;Editar</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="text-center">
                    {{ $candidatos->links() }}
                </div>
            </div>
            @endif
        </div>
    </div>
@endsection