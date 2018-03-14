<?php
use App\Models\Config;

// ROTA - NÃO REMOVER
Route::middleware(['home'])->get('/', function(){

    $config = Config::all()->first();

    return view('home', compact('config'));
});

// ROTAS ADMINISTRADOR
Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'as' => 'admin.', 'middleware' => 'auth', 'middleware' => 'admin'], function(){
    Route::get('/', 'HomeController@index')->name('home');
    Route::resource('isencao', 'IsencaoController', ['only' => ['index', 'update']]);
    Route::resource('indeferimento_isencao', 'IndeferimentoIsencaoController', ['only' => ['update']]);
    Route::resource('candidatos', 'CandidatosController', ['only' => ['index', 'edit', 'update']]);
    Route::resource('tratamento_especial', 'TratamentoEspecialController', ['only' => ['index', 'update']]);
    Route::resource('indeferimento_tratamento', 'IndeferimentoTratamentoEspecialController', ['only' => ['update']]);
    Route::get('isencao/resultado/{tipo}', 'IsencaoController@gerarResultado')->name('isencao.resultado');
    Route::get('isencao/candidatos/{tipo}', 'IsencaoController@showCandidatos')->name('isencao.candidatos');
    Route::get('isencao/recurso/{id}', 'IsencaoController@showFormLancarRespostaRecurso')->name('isencao.recurso');
    Route::put('isencao/recurso/{id}/{tipo}', 'IsencaoController@lancarRespostaRecurso')->name('isencao.recurso.lancar');
    Route::get('tratamento_especial/resultado/{tipo}', 'TratamentoEspecialController@gerarResultado')->name('tratamento_especial.resultado');
    Route::get('tratamento_especial/candidatos/{tipo}', 'TratamentoEspecialController@showCandidatos')->name('tratamento_especial.candidatos');
    Route::get('tratamento_especial/recurso/{id}', 'TratamentoEspecialController@showFormLancarRespostaRecurso')->name('tratamento_especial.recurso');
    Route::put('tratamento_especial/recurso/{id}/{tipo}', 'TratamentoEspecialController@lancarRespostaRecurso')->name('tratamento_especial.recurso.lancar');

    Route::get('candidatos/aptos', 'CandidatosController@gerarListaAptosRealizarProva');

    Route::resource('alocacao', 'AlocacaoCandidatosController');
    Route::post('alocacao/alocar', 'AlocacaoCandidatosController@alocar')->name('alocacao.alocar');
});

// ROTAS CANDIDATO
Route::group(['namespace' => 'Candidato', 'prefix' => 'candidato', 'as' => 'candidato.', 'middleware' => ['auth', 'candidato']], function(){

    Route::get('/cartao-inscricao', 'CartaoInscricaoController@gerarPdf')->name('cartao-inscricao');

    // GERAÇÃO DE DAE
    Route::group(['as' => 'dae.', 'prefix' => 'dae'], function(){
        Route::post('/{id}', 'DaeController@index')->name('store');
        Route::get('/show', 'DaeController@show')->name('show');
    });

    // PEDIDO DE ISENÇÃO
    Route::resource('isencao', 'IsencaoController', ['only' => ['index', 'update']]);

    // GERAÇÃO DE PDF's DE FORMULÁRIOS, FOLHAS DE IDENTIFICAÇÃO, COMPROVANTES
    Route::group(['namespace' => 'Pdfs', 'as' => 'pdf.', 'prefix' => 'pdf'], function(){

        Route::get('/folha-identificacao', 'IsencaoController@gerarFolhaIdentificacao')->name('folha-identificacao');
        Route::get('/folha-identificacao-segunda-etapa', 'IsencaoController@gerarFolhaIdentificacaoSegundaEtapa')->name('folha-identificacao-segunda-etapa');
        Route::get('/comprovante-pre-inscricao-isencao', 'IsencaoController@gerarComprovantePreInscricaoPedidoIsencao')->name('comprovante-pre-inscricao-isencao');
        Route::get('/formulario-pedido-isencao', 'IsencaoController@gerarFormularioPedidoIsencao')->name('formulario-pedido-isencao');
    });

    //CANDITATO HOME
    Route::get('/', 'HomeController@index')->name('home');

    Route::group(['prefix' => 'minhaconta', 'as' => 'minhaconta.'], function(){

        // CURSOS HOME
        Route::get('/', 'MinhaContaController@index')->name('home');
        Route::get('/create', 'MinhaContaController@create')->name('create');
        Route::post('/store', 'MinhaContaController@store')->name('store');
        Route::get('/show/{id}', 'MinhaContaController@show')->name('show');
        Route::get('/edit/{id}', 'MinhaContaController@edit')->name('edit');
        Route::post('/update/{id}', 'MinhaContaController@update')->name('update');
        Route::post('/destroy/{id}', 'MinhaContaController@destroy')->name('destroy');
        Route::get('/senha', 'MinhaContaController@formAlterarSenha')->name('form.alterar.senha');
        Route::post('/senha/alterar', 'MinhaContaController@alterarSenha')->name('alterar.senha');
    });
});

Auth::routes();

Route::get('/home', function(){
	return redirect()->route('candidato.home');
});

Route::get('/senha', 'HomeController@index')->name('minhaconta.senha');

Route::post('/informacoes', 'Admin\ResidenciasController@getInfoResidencias')->name('informacoes');
