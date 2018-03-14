@extends('layouts.app')

@section('title', 'Inscrição - Processo seletivo para os programas de residência')
@section('content')

    @push('scripts')
        <script type="text/javascript">
            $(document).ready(function () {

                if ($("#cep").val() != '') {

                    var cep = $('#cep').val();

                    $.ajax({
                        url: 'http://api.postmon.com.br/v1/cep/' + cep,
                        type: 'GET',
                        dataType: 'json',
                        success: function (json) {
                            if (typeof json.estado != 'undefined') {
                                $('#cidade').val(json.cidade);
                                $('#logradouro').val(json.logradouro);
                                $('#bairro').val(json.bairro);
                                $('#estado').html('<option value="' + json.estado + '">' + json.estado + '</option>');
                            }
                        }
                    })
                }

                $('#cep').blur(function () {
                    var cep = $('#cep').val();
                    $.ajax({
                        url: 'http://api.postmon.com.br/v1/cep/' + cep,
                        type: 'GET',
                        dataType: 'json',
                        success: function (json) {
                            if (typeof json.estado != 'undefined') {
                                $('#cidade').val(json.cidade);
                                $('#logradouro').val(json.logradouro);
                                $('#bairro').val(json.bairro);
                                $('#estado').val(json.estado);
                            }
                        }
                    })
                });

                // RETORNA AS INFORMAÇÕES REFERENTES AO CURSO DE ACORDO COM O CÓDIGO
                $("#codigo").keyup(function () {

                    $('#resultado').html('');

                    var codigo = $("#codigo").val();

                    if (codigo != '') {

                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            method: 'post',
                            url: '{{ route('informacoes') }}',
                            data: '&codigo=' + codigo,
                            success:
                                function (retorno) {

                                    if (retorno == 'erro') {
                                        $('#resultado').html('<strong><span class="label label-sm label-danger" style="padding: 10px; font-size: 13px; font-weight: bolder;">Não existe este código de inscrição! Insira novamente.</span></strong>');
                                        $('#btn_submit').attr('disabled', 'disabled');
                                    } else {
                                        $('#resultado').html('<strong><span class="label label-sm label-success" style="padding: 10px; font-size: 13px; font-weight: bolder;">' + retorno + '</span></strong>');
                                        $('#btn_submit').removeAttr('disabled');
                                    }
                                }
                        });
                    }
                });

                $('#btn_submit').submit(function () {
                    $('#btn_submit').attr('disabled', 'disabled');
                });
            })
        </script>
    @endpush

    @if(date('Y-m-d H:i') <= formatarDataHoraExtensoUSA($config->termino_inscricoes))

    {{ Form::open(['url' => route('register'), 'method' => 'post']) }}

    <div class="row">
        <div class="col-md-6">
            <div class="form-group {{ $errors->has('nome') ? ' has-error' : '' }}">
                <label for="nome">Nome completo: <span class="required">*</span></label>
                <input type="text" class="form-control" id="nome" name="nome" value="{{ old('nome') }}" required=""
                       pattern="[a-zA-ZáàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ\s]+$">
                @if ($errors->has('nome'))
                    <span class="help-block">
                    <strong>{{ $errors->first('nome') }}</strong>
                </span>
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group {{ $errors->has('cpf') ? ' has-error' : '' }}">
                <label for="cpf">CPF: <span class="required">*</span></label>
                <input type="text" class="form-control" id="cpf" name="cpf" value="{{ old('cpf') }}" required>
                @if ($errors->has('cpf'))
                    <span class="help-block">
                    <strong>{{ $errors->first('cpf') }}</strong>
                </span>
                @endif
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group {{ $errors->has('rg') ? ' has-error' : '' }}">
                <label for="rg">RG: <span class="required">*</span></label>
                <input type="text" class="form-control" id="rg" name="rg" value="{{ old('rg') }}" required
                       placeholder="Ex: MG-00.000.000">
                @if ($errors->has('rg'))
                    <span class="help-block">
                    <strong>{{ $errors->first('rg') }}</strong>
                </span>
                @endif
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group {{ $errors->has('org_exped') ? ' has-error' : '' }}">
                <label>Org. Exp: <span class="required">*</span></label>
                <input type="text" class="form-control" name="org_exped" value="{{ old('org_exped') }}" maxlength="10"
                       required placeholder="Ex: SSP/MG">
                @if ($errors->has('org_exped'))
                    <span class="help-block">
                    <strong>{{ $errors->first('org_exped') }}</strong>
                </span>
                @endif
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group {{ $errors->has('data_nasc') ? ' has-error' : '' }}">
                <label for="data_nasc">Data de nascimento: <span class="required">*</span></label>
                <input type="text" class="form-control" id="data_nasc" name="data_nasc" value="{{ old('data_nasc') }}"
                       required>
                @if ($errors->has('data_nasc'))
                    <span class="help-block">
                    <strong>{{ $errors->first('data_nasc') }}</strong>
                </span>
                @endif
            </div>
        </div>
    </div>
    <h3 class="form-section">Dados de contato</h3>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email">E-mail: <span class="required">* (E-mail existente)</span></label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required
                       placeholder="">
                @if ($errors->has('email'))
                    <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group {{ $errors->has('telefone') ? ' has-error' : '' }}">
                <label for="telefone">Telefone: <span class="required">*</span></label>
                <input type="text" class="form-control" id="telefone" name="telefone" value="{{ old('telefone') }}"
                       required>
                @if ($errors->has('telefone'))
                    <span class="help-block">
                    <strong>{{ $errors->first('telefone') }}</strong>
                </span>
                @endif
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group {{ $errors->has('cep') ? ' has-error' : '' }}">
                <label for="cep">CEP: <span class="required">*</span></label>
                <input type="text" class="form-control" id="cep" name="cep" value="{{ old('cep') }}" required>
                @if ($errors->has('cep'))
                    <span class="help-block">
                    <strong>{{ $errors->first('cep') }}</strong>
                </span>
                @endif
            </div>
        </div>
        <div class="col-md-5">
            <div class="form-group {{ $errors->has('logradouro') ? ' has-error' : '' }}">
                <label for="logradouro">Endereço: <span class="required">*</span></label>
                <input type="text" class="form-control" id="logradouro" name="logradouro"
                       value="{{ old('logradouro') }}" required>
                @if ($errors->has('logradouro'))
                    <span class="help-block">
                    <strong>{{ $errors->first('logradouro') }}</strong>
                </span>
                @endif
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group {{ $errors->has('numero') ? ' has-error' : '' }}">
                <label for="numero">Número: <span class="required">*</span></label>
                <input type="text" class="form-control" id="numero" name="numero" value="{{ old('numero') }}" required>
                @if ($errors->has('numero'))
                    <span class="help-block">
                    <strong>{{ $errors->first('numero') }}</strong>
                </span>
                @endif
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group {{ $errors->has('complemento') ? ' has-error' : '' }}">
                <label for="complemento">Complemento: </label>
                <input type="text" class="form-control" id="complemento" name="complemento"
                       value="{{ old('complemento') }}">
                @if ($errors->has('complemento'))
                    <span class="help-block">
                    <strong>{{ $errors->first('complemento') }}</strong>
                </span>
                @endif
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group {{ $errors->has('bairro') ? ' has-error' : '' }}">
                <label for="bairro">Bairro: <span class="required">*</span></label>
                <input type="text" class="form-control" id="bairro" name="bairro" value="{{ old('bairro') }}" required>
                @if ($errors->has('bairro'))
                    <span class="help-block">
                    <strong>{{ $errors->first('bairro') }}</strong>
                </span>
                @endif
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group {{ $errors->has('cidade') ? ' has-error' : '' }}">
                <label for="cidade">Cidade: <span class="required">*</span></label>
                <input type="text" class="form-control" id="cidade" name="cidade" value="{{ old('cidade') }}" required>
                @if ($errors->has('cidade'))
                    <span class="help-block">
                    <strong>{{ $errors->first('cidade') }}</strong>
                </span>
                @endif
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group {{ $errors->has('estado') ? ' has-error' : '' }}">
                <label for="estado">Estado: <span class="required">*</span></label>
                <input type="text" class="form-control" id="estado" name="estado" value="{{ old('estado') }}" required>
                @if ($errors->has('estado'))
                    <span class="help-block">
                    <strong>{{ $errors->first('estado') }}</strong>
                </span>
                @endif
            </div>
        </div>
    </div><br>
    <hr>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="form-group {{ $errors->has('tipo_candidato') ? ' has-error' : '' }}">
                <label for="codigo">Selecione uma das opções de candidato: <span class="required">*</span></label>
                <select name="tipo_candidato" id="tipo_candidato" class="form-control" required>
                    <option value="nao_se_aplica">Não se aplica</option>
                    <option value="br_instituicao_ensino_estrangeira">Candidato
                        brasileiro, formado por instituição de ensino estrangeira</option>
                    <option value="estrangeiro">Candidato estrangeiro</option>
                    <option value="estrangeiro_instituicao_ensino_br">Candidato
                        estrangeiro, formado no Brasil</option>
                </select>
                @if ($errors->has('tipo_candidato'))
                    <span class="help-block">
                    <strong>{{ $errors->first('tipo_candidato') }}</strong>
                </span>
                @endif
            </div>
        </div>
    </div>
    <h3 class="form-section">Escolha um programa de residência</h3>
    <div class="row">
        <div class="col-md-12">
            <h5><b>ATENÇÃO!</b> Esse código de inscrição está disponível na tabela do item 2 do edital do Processo
                Seletivo para os Programas de
                Residência Multiprofissional e em Área Profissional da Saúde. Certifique-se de que o código inserido
                seja válido, caso contrário você não conseguirá prosseguir com a inscrição!</h5>
        </div>
        <div class="col-md-6 col-md-offset-3">
            <div class="form-group {{ $errors->has('codigo') ? ' has-error' : '' }}">
                <label for="codigo">Código de inscrição: <span class="required">*</span></label>
                <input type="number" id="codigo" name="codigo" class="form-control" required maxlength="4" min="1">
                @if ($errors->has('codigo'))
                    <span class="help-block">
                    <strong>{{ $errors->first('codigo') }}</strong>
                </span>
                @endif
            </div>
        </div>
        <div class="col-md-6 col-md-offset-3">
            <div id="resultado">

            </div>
        </div>
    </div>
    <h3 class="form-section">Escolha a cidade que deseja realizar a prova</h3>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="form-group {{ $errors->has('cidade_prova') ? ' has-error' : '' }}">
                <label for="codigo">Cidade: <span class="required">*</span></label>
                <select name="cidade_prova" id="cidade_prova" class="form-control" required>
                    @foreach($cidades as $cidade)
                        <option value="{{ $cidade->id }}">{{ $cidade->nome }}</option>
                    @endforeach
                </select>
                @if ($errors->has('cidade_prova'))
                    <span class="help-block">
                    <strong>{{ $errors->first('cidade_prova') }}</strong>
                </span>
                @endif
            </div>
        </div>
    </div>
    <h3 class="form-section">Cadastre uma Senha</h3>
    <div class="row">
        <div class="col-md-12">
            <h5><b>ATENÇÃO!</b> Lembre-se de guardar essa senha. Somente com ela e seu CPF que você poderá acessar a
                área do candidato.</h5>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="password">Senha: <span class="required">*</span></label>
                <input type="password" id="password" name="password" class="form-control">
                @if ($errors->has('password'))
                    <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="password_confirmation">Confirme a Senha: <span class="required">*</span></label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
            </div>
        </div>
    </div>
    <h3 class="form-section">Declaração</h3>
    <div class="col-md-12">
        <div class="note note-info">
            <h4 class="block"><strong>Nota:</strong></h4>
            <p> Com o preenchimento da Ficha de Inscrição, o candidato declara: </p>
            <p>a) estar ciente e aceitar as normas constantes no Edital.</p>
            <p>b) o preenchimento desta ficha e as informações prestadas são de inteira responsabilidade do(a)
                candidato(a) .</p>
            <p>c) ao cadastrar sua senha, você poderá acessar a área do candidato posteriormente.</p>
        </div>
    </div>
    <div class="col-md-12">
        <label class="mt-checkbox mt-checkbox-outline">
            <input type="checkbox" required> Declaro atender as condições exigidas para inscrição, conhecer o Edital do
            Processo e concordo com o mesmo.
            <span></span>
        </label>
    </div>
    <div class="text-right">
        <button type="submit" id="btn_submit" class="btn bg-green-jungle bg-font-green-jungle">Realizar Inscrição
        </button>
    </div>

    {{ Form::close() }}

    @else

    <h3 class="text-center" style="color: #666666;"><strong>As inscrições foram encerradas!</strong></h3>
    <div class="text-center" style="color: #0c91e5"><a href="{{ route('candidato.home') }}"><i class="fa fa-user"></i>&nbsp;Acessar área do candidato</a></div>
    @endif

@endsection
