<?php

Auth::routes();
Route::get('/', 'PrincipalController@home');


Route::get('teste', 'PrincipalController@get')->name('teste.get');
Route::post('teste', 'PrincipalController@post')->name('teste.post');
Route::get('home', 'PrincipalController@home')->name('principal.home');
Route::get('apresentacao', 'PrincipalController@apresentacao')->name('principal.apresentacao');
Route::get('instrucao', 'PrincipalController@instrucao')->name('principal.instrucao');
Route::get('contato', 'PrincipalController@contato')->name('principal.contato');
Route::get('libratos', 'PrincipalController@libratos')->name('principal.libratos');
Route::get('libror', 'PrincipalController@libror')->name('principal.libror');
Route::get('unifrazinho', 'PrincipalController@unifrazinho')->name('principal.unifrazinho');
Route::get('links', 'PrincipalController@links')->name('principal.links');
Route::get('biblioteca', 'PrincipalController@biblioteca')->name('principal.biblioteca');
Route::post('home', 'PrincipalController@store')->name('principal.store');
Route::post('fetch', 'PrincipalController@fetch')->name('principal.fetch');
Route::post('idiomapesquisado', 'PrincipalController@idiomapesquisado')->name('principal.idiomapesquisado');
Route::post('idiomatraduzir', 'PrincipalController@idiomatraduzir')->name('principal.idiomatraduzir');
Route::post('enviarfraseemail', 'PrincipalController@enviarfraseemail')->name('principal.enviarfraseemail');
Route::post('enviarcontato', 'PrincipalController@enviarcontato')->name('principal.enviarcontato');
Route::post('entrarchat', 'PrincipalController@entrarchat')->name('principal.entrarchat');
Route::post('sairchat', 'PrincipalController@sairchat')->name('principal.sairchat');
Route::post('enviamensagemchat', 'PrincipalController@enviamensagemchat')->name('principal.enviamensagemchat');
Route::post('verificarusuarioonline', 'PrincipalController@verificarusuarioonline')->name('principal.verificarusuarioonline');
Route::post('enviamensagemchat', 'PrincipalController@enviamensagemchat')->name('principal.enviamensagemchat');
Route::post('gravarmensagemchat', 'PrincipalController@gravarmensagemchat')->name('principal.gravarmensagemchat');
Route::post('idiomalink', 'PrincipalController@idiomaLink')->name('principal.idiomalink');

Route::group(['prefix' => 'admin'], function () {

    // Rota principal do administrador
    Route::get('/', 'AdministradorController@index')->name('admin');
    //Rotas de cadastro
    Route::group(['prefix' => 'cadastrar'], function () {

        Route::get('idiomas', 'IdiomasController@create')->name('idiomas.create');
        Route::post('idiomas', 'IdiomasController@store')->name('idiomas.store');
        Route::get('frases', 'FrasesController@create')->name('frases.create');
        Route::post('frases', 'FrasesController@store')->name('frases.store');

        Route::get('user', 'UserController@create')->name('user.create');
        Route::post('user', 'UserController@store')->name('user.store');
    });

    // Rotas de controle
    Route::group(['prefix' => 'controle'], function () {

        Route::get('idiomas', 'IdiomasController@show')->name('idiomas.show');
        Route::post('idiomas', 'IdiomasController@show')->name('idiomas.show');
        Route::post('idiomas', 'IdiomasController@pesquisa')->name('idiomas.pesquisa');

        Route::get('frases', 'FrasesController@show')->name('frases.show');
        Route::post('frases', 'FrasesController@show')->name('frases.show');
        Route::post('frases', 'FrasesController@pesquisa')->name('frases.pesquisa');

        Route::get('user', 'UserController@show')->name('user.show');
        Route::post('user', 'UserController@show')->name('user.show');
    });

    // Rotas de Edição
    Route::group(['prefix' => 'editar'], function () {

        Route::get('idiomas/{id}', 'IdiomasController@edit')->name('idiomas.edit');
        Route::post('idiomas', 'IdiomasController@update')->name('idiomas.update');

        Route::get('frases/{id}', 'FrasesController@edit')->name('frases.edit');
        Route::post('frases', 'FrasesController@update')->name('frases.update');

        Route::get('/', 'AdministradorController@edit')->name('admin.edit');
        Route::post('/', 'AdministradorController@update')->name('admin.update');

        Route::get('user/{id}', 'UserController@edit')->name('user.edit');
        Route::post('user', 'UserController@update')->name('user.update');
    });

    // Rotas de Exclusão
    Route::group(['prefix' => 'deletar'], function () {

        Route::get('idiomas/{id}', 'IdiomasController@delete')->name('idiomas.delete');
        Route::get('frases/{id}', 'FrasesController@delete')->name('frases.delete');
        Route::get('user/{id}', 'UserController@delete')->name('user.delete');
    });

    Route::group(['prefix' => 'processar'], function () {
        Route::post('processa', 'FrasesController@processa')->name('processa.planilha');
    });

});





