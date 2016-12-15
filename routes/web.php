<?php
/**
 * Arquivo com os Routes
 * Devem ser divididos por Controllers
 */

/**
 * AppController
 */
Route::get('/', 'AppController@index');
Route::get('/index', 'AppController@index');
Route::get('/login', 'AppController@login');

/**
 * Portal de Eventos
 */
Route::get('/evento', 'EventoController@index');
Route::get('/eventos', 'EventoController@lists');
Route::get('/eventos/{slug}', 'EventoController@single')->where('slug', '[a-zA-Z0-9-]+');

/**
 * Alunos
 */
Route::get('/aluno/cadastro', 'AlunoController@cadastro');
Route::post('/aluno/add', 'AlunoController@add');
Route::get('/aluno/palestra', 'AlunosPalestraController@palestra');
Route::post('/presenca/add', 'AlunosPalestraController@add');
Route::post('/presenca/marcar', 'AlunosPalestraController@marcarPresenca');
Route::get('/perfil/{id}', 'AlunoController@perfil')->where(['id' => '[0-9]+']);

/**
 * Palestras
 */
Route::get('/palestras/{slug}', 'PalestraController@single')->where('slug', '[a-zA-Z0-9-]+');
Route::get('/palestra/certificados', 'PalestraController@certificados');
Route::post('/palestra/certificados', 'PalestraController@postCertificados');
Route::get('/palestra/certificados/{aluno}/{palestra}', 'PalestraController@emitirCertificado')
	->where(['aluno' => '[0-9]+', 'palestra' => '[0-9]+']);
Route::get('/palestra/participar/{slug}', 'AlunosPalestraController@participar')->where('slug', '[a-zA-Z0-9-]+');
Route::get('/palestra/participacao', 'PalestraController@participacao');
Route::post('/palestra/participacao', 'PalestraController@postParticipacao');
Route::get('/palestra/certificado/{aluno}/{palestra}', 'PalestraController@certificado');

/**
 * Login Colaborador
 */
Route::group(['middleware' => 'colaborador'], function() {

	Route::group(['middleware' => 'colaborador:colaborador'], function() {
		// Perfil Colaborador
		Route::get('/colaborador', 'ColaboradorController@index');

		/**
		 * Páginas que apenas um colaborador pode acessar
		 */

		// Alunos
		Route::get('/aluno/lista', 'AlunoController@lista');
		Route::get('/aluno/edit/{id}', 'AlunoController@edit')->where(['id' => '[0-9]+']);
		Route::post('/aluno/edit/{id}', 'AlunoController@postEdit')->where(['id' => '[0-9]+']);
		Route::get('/aluno/del/{id}', 'AlunoController@del')->where(['id' => '[0-9]+']);
		Route::get('/presenca/lista', 'AlunosPalestraController@lista');
		Route::get('/presenca/cadastro', 'AlunosPalestraController@cadastro');

		// Colaboradores
		Route::get('/colaborador/lista', 'ColaboradorController@lista');
		Route::get('/colaborador/cadastro', 'ColaboradorController@cadastro');
		Route::post('/colaborador/add', 'ColaboradorController@add');
		Route::get('/colaborador/edit/{id}', 'ColaboradorController@edit')->where(['id' => '[0-9]+']);
		Route::post('/colaborador/edit/{id}', 'ColaboradorController@postEdit')->where(['id' => '[0-9]+']);

		// Eventos
		Route::get('/evento/lista', 'EventoController@lista');
		Route::get('/evento/cadastro', 'EventoController@cadastro');
		Route::post('/evento/add', 'EventoController@add');
		Route::get('/evento/edit/{id}', 'EventoController@edit')->where(['id' => '[0-9]+']);
		Route::post('/evento/edit/{id}', 'EventoController@postEdit')->where(['id' => '[0-9]+']);
		Route::get('/evento/del/{id}', 'EventoController@del')->where(['id' => '[0-9]+']);

		// Palestrantes
		Route::get('/palestrante/lista', 'PalestranteController@lista');
		Route::get('/palestrante/cadastro', 'PalestranteController@cadastro');
		Route::post('/palestrante/add', 'PalestranteController@add');
		Route::get('/palestrante/edit/{id}', 'PalestranteController@edit')->where(['id' => '[0-9]+']);
		Route::post('/palestrante/edit/{id}', 'PalestranteController@postEdit')->where(['id' => '[0-9]+']);
		Route::get('/palestrante/del/{id}', 'PalestranteController@del')->where(['id' => '[0-9]+']);

		// Palestras
		Route::get('/palestra/lista', 'PalestraController@lista');
		Route::get('/palestra/cadastro', 'PalestraController@cadastro');
		Route::post('/palestra/add', 'PalestraController@add');	
		Route::get('/palestra/edit/{id}', 'PalestraController@edit')->where(['id' => '[0-9]+']);
		Route::post('/palestra/edit/{id}', 'PalestraController@postEdit')->where(['id' => '[0-9]+']);
		Route::get('/palestra/del/{id}', 'PalestraController@del')->where(['id' => '[0-9]+']);

		// Recursos
		Route::get('/recurso/lista', 'RecursoController@lista');
		Route::get('/recurso/cadastro', 'RecursoController@cadastro');
		Route::post('/recurso/add', 'RecursoController@add');
		Route::get('/recurso/edit/{id}', 'RecursoController@edit')->where(['id' => '[0-9]+']);
		Route::post('/recurso/edit/{id}', 'RecursoController@postEdit')->where(['id' => '[0-9]+']);
		Route::get('/recurso/del/{id}', 'RecursoController@del')->where(['id' => '[0-9]+']);

		// Salas
		Route::get('/sala/lista', 'SalaController@lista');
		Route::get('/sala/cadastro', 'SalaController@cadastro');
		Route::post('/sala/add', 'SalaController@add');
		Route::get('/sala/edit/{id}', 'SalaController@edit')->where(['id' => '[0-9]+']);
		Route::post('/sala/edit/{id}', 'SalaController@postEdit')->where(['id' => '[0-9]+']);
		Route::get('/sala/del/{id}', 'SalaController@del')->where(['id' => '[0-9]+']);
	});

	Route::get('/colaborador/login', 'ColaboradorController@login');
	Route::post('/colaborador/login', 'ColaboradorController@postLogin');

	Route::get('/colaborador/logout', 'ColaboradorController@logout');
});


/**
 * Login Aluno
 */
Route::group(['middleware' => 'aluno'], function() {

	Route::group(['middleware' => 'aluno:aluno'], function() {
		// Perfil Aluno
		Route::get('/aluno', 'AlunoController@index');
		// Route::get('/aluno/edit/{id}', 'AlunoController@edit')->where(['id' => '[0-9]+']);
		// Route::post('/aluno/edit/{id}', 'AlunoController@postEdit')->where(['id' => '[0-9]+']);


		/**
		 * Páginas que apenas um aluno pode acessar
		 */
	});

	Route::get('/aluno/login', 'AlunoController@login');
	Route::post('/aluno/login', 'AlunoController@postLogin');

	Route::get('/aluno/logout', 'AlunoController@logout');
});

/**
 * Login Ambos
 */
Route::group(['middleware' => 'usuario'], function() {
	
});

Route::get('home', 'HomeController@index');

// Auth::routes();