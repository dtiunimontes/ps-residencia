@extends('layouts.app')
@section('title', 'Candidatos')
@section('content')
    <div class="row">
        <div class="col-md-12">
            {{ Form::open(['url' => route('admin.tratamento_especial.index'), 'method' => 'get']) }}
            <div class="form-group">
                <div class="input-group input-group-md">
                    <label>Buscar por: </label>
                    <select name="atributo" id="atributo" class="form-control">
                        <option value="inscricao_id">INSCRIÇÃO</option>
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
                        <th>Inscrição</th>
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
                            <td>{{ $candidato->inscricao->id }}</td>
                            <td>{{ $candidato->cpf }}</td>
                            <td>{{ $candidato->nome }}</td>
                            <td>{{ $candidato->rg }}</td>
                            <td class="text-center">{{ date('d/m/Y', strtotime($candidato->data_nasc)) }}</td>
                            <td>
                                @if(!empty($candidato->inscricao->tratamento_especial))
                                    <span style="background-color: #d58512; padding: 5px; color: #ffffff"> <i class="fa fa-check" aria-hidden="true"></i>&nbsp;Já analisada</span>
                                @endif
                                {{ Form::open(['url' => route('admin.tratamento_especial.update', $candidato->inscricao->id), 'method' => 'put']) }}
                                <div class="radio">
                                    <label><input type="radio" name="tratamento_especial" {{ ($candidato->inscricao->tratamento_especial == \App\Models\Inscricao::DEFERIDO) ? 'checked="checked"' : '' }} value="{{ \App\Models\Inscricao::DEFERIDO }}">Deferido</label>
                                </div>
                                <div class="radio">
                                    <label><input type="radio" name="tratamento_especial" {{ ($candidato->inscricao->tratamento_especial == \App\Models\Inscricao::INDEFERIDO) ? 'checked="checked"' : '' }} value="{{ \App\Models\Inscricao::INDEFERIDO }}">Indeferido</label>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn bg-green-jungle bg-font-green-jungle">ok!</button>
                                </div>
                                {{ Form::close() }}
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