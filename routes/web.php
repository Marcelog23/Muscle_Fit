        <?php

        /*
        Route::get('/', function () {

            $cidades = \App\Models\Cidade::pluck('nome_cidd','id');
            return view('welcome', compact('cidades'));
        });
        */
        /*
        Route::get('/', function () {
            return view('welcome');
        });
        */

        Route::get('/', 'SiteController@index');

        Route::post('/', 'SiteController@store')->name('site.store');


        Auth::routes();

        Route::group(['middleware' => 'auth'], function (){

            Route::get('/home', 'HomeController@index')->name('home');


            Route::group(['as' => 'academia.', 'prefix' => 'academia', 'middleware'=>['isAdmin']], function () {

                Route::get('',              ['as'=>'index',   'uses'=>'Aplicacao\AcademiaController@index']);
                Route::get('create',        ['as'=>'create',  'uses'=>'Aplicacao\AcademiaController@create']);
                Route::get('{id}/destroy',  ['as'=>'destroy', 'uses'=>'Aplicacao\AcademiaController@destroy']);
                Route::get('{id}/edit',     ['as'=>'edit',    'uses'=>'Aplicacao\AcademiaController@edit']);
                Route::put('{id}/update',   ['as'=>'update',  'uses'=>'Aplicacao\AcademiaController@update']);
                Route::post('store',        ['as'=>'store',   'uses'=>'Aplicacao\AcademiaController@store']);

            });

            Route::group(['prefix' => 'aluno'], function () {

                Route::any('',              ['as'=>'aluno',         'uses'=>'Aplicacao\AlunoController@index']);
                Route::get('create',        ['as'=>'aluno.create',  'uses'=>'Aplicacao\AlunoController@create']);
                Route::get('{id}/destroy',  ['as'=>'aluno.destroy', 'uses'=>'Aplicacao\AlunoController@destroy']);
                Route::get('{id}/edit',     ['as'=>'aluno.edit',    'uses'=>'Aplicacao\AlunoController@edit']);
                Route::put('{id}/update',   ['as'=>'aluno.update',  'uses'=>'Aplicacao\AlunoController@update']);
                Route::post('store',        ['as'=>'aluno.store',   'uses'=>'Aplicacao\AlunoController@store']);

            });


            Route::group(['prefix' => 'personal', 'middleware'=>['isAdmin']], function () {

                Route::any('',              ['as'=>'personal',         'uses'=>'Aplicacao\PersonalController@index']);
                Route::get('create',        ['as'=>'personal.create',  'uses'=>'Aplicacao\PersonalController@create']);
                Route::get('{id}/destroy',  ['as'=>'personal.destroy', 'uses'=>'Aplicacao\PersonalController@destroy']);
                Route::get('{id}/edit',     ['as'=>'personal.edit',    'uses'=>'Aplicacao\PersonalController@edit']);
                Route::put('{id}/update',   ['as'=>'personal.update',  'uses'=>'Aplicacao\PersonalController@update']);
                Route::post('store',        ['as'=>'personal.store',   'uses'=>'Aplicacao\PersonalController@store']);

            });


            Route::group(['prefix' => 'medida', 'middleware'=>['isProfessor']], function () {

                Route::any('',                  ['as'=>'medida',         'uses'=>'Aplicacao\MedidasController@index']);
                Route::get('create',            ['as'=>'medida.create',  'uses'=>'Aplicacao\MedidasController@create']);
                Route::get('{id}/destroy',      ['as'=>'medida.destroy', 'uses'=>'Aplicacao\MedidasController@destroy']);
                Route::get('{id}/edit',         ['as'=>'medida.edit',    'uses'=>'Aplicacao\MedidasController@edit']);
                Route::put('{id}/update',       ['as'=>'medida.update',  'uses'=>'Aplicacao\MedidasController@update']);
                Route::post('store',            ['as'=>'medida.store',   'uses'=>'Aplicacao\MedidasController@store']);
                Route::get('listaMedidas/{id}', ['as'=>'medida.listaMedidas',   'uses'=>'Aplicacao\MedidasController@listaMedidas']);

            });

            Route::group(['prefix' => 'plano'], function () {

                Route::any('',              ['as'=>'plano',         'uses'=>'Aplicacao\PlanoController@index']);
                Route::get('create',        ['as'=>'plano.create',  'uses'=>'Aplicacao\PlanoController@create']);
                Route::get('{id}/destroy',  ['as'=>'plano.destroy', 'uses'=>'Aplicacao\PlanoController@destroy']);
                Route::get('{id}/edit',     ['as'=>'plano.edit',    'uses'=>'Aplicacao\PlanoController@edit']);
                Route::put('{id}/update',   ['as'=>'plano.update',  'uses'=>'Aplicacao\PlanoController@update']);
                Route::post('store',        ['as'=>'plano.store',   'uses'=>'Aplicacao\PlanoController@store']);

            });

            Route::group(['prefix' => 'matricula'], function () {

                Route::any('',              ['as'=>'matricula',         'uses'=>'Aplicacao\MatriculaController@index']);
                Route::get('create',        ['as'=>'matricula.create',  'uses'=>'Aplicacao\MatriculaController@create']);
                Route::post('remove',       ['as'=>'matricula.remove',  'uses'=>'Aplicacao\MatriculaController@remove']);
                Route::get('{id}/edit',     ['as'=>'matricula.edit',    'uses'=>'Aplicacao\MatriculaController@edit']);
                Route::put('{id}/update',   ['as'=>'matricula.update',  'uses'=>'Aplicacao\MatriculaController@update']);
                Route::post('store',        ['as'=>'matricula.store',   'uses'=>'Aplicacao\MatriculaController@store']);

            });

            Route::group(['prefix'=>'treino', 'as'=>'treino.','middleware'=>['isProfessor'] ], function () {

                Route::any('index',              ['as'=>'index',         'uses'=>'Aplicacao\TreinoController@index']);
                Route::get('create',             ['as'=>'create',        'uses'=>'Aplicacao\TreinoController@create']);
                Route::get('{id}/destroy',       ['as'=>'destroy',       'uses'=>'Aplicacao\TreinoController@destroy']);
                Route::get('{id}/edit',          ['as'=>'edit',          'uses'=>'Aplicacao\TreinoController@edit']);
                Route::put('{id}/update',        ['as'=>'update',        'uses'=>'Aplicacao\TreinoController@update']);
                Route::get('{id}/show',          ['as'=>'show',          'uses'=>'Aplicacao\TreinoController@show']);
                Route::post('store',             ['as'=>'store',         'uses'=>'Aplicacao\TreinoController@store']);
                Route::get('getDiaSemana/{id}',  ['as'=>'getDiaSemana',  'uses'=>'Aplicacao\TreinoController@getDiaSemana']);
                Route::get('listaTreino/{id}',   ['as'=>'listaTreino',   'uses'=>'Aplicacao\TreinoController@listaTreino']);
                Route::get('getExercicios',      ['as'=>'getExercicios',    'uses'=>'Aplicacao\ExercicioController@getExercicios']);


            });

            Route::group(['prefix' => 'exercicio', 'middleware'=>['isAdmin'] ], function () {

                Route::any('',              ['as'=>'exercicio',         'uses'=>'Aplicacao\ExercicioController@index']);
                Route::get('create',        ['as'=>'exercicio.create',  'uses'=>'Aplicacao\ExercicioController@create']);
                Route::get('{id}/destroy',  ['as'=>'exercicio.destroy', 'uses'=>'Aplicacao\ExercicioController@destroy']);
                Route::get('{id}/edit',     ['as'=>'exercicio.edit',    'uses'=>'Aplicacao\ExercicioController@edit']);
                Route::put('{id}/update',   ['as'=>'exercicio.update',  'uses'=>'Aplicacao\ExercicioController@update']);
                Route::post('store',        ['as'=>'exercicio.store',   'uses'=>'Aplicacao\ExercicioController@store']);

            });

            Route::group(['prefix' => 'usuario','middleware'=>['isAdmin']], function () {

                Route::any('',              ['as'=>'usuario',         'uses'=>'Aplicacao\UsuarioController@index']);
                Route::get('create',        ['as'=>'usuario.create',  'uses'=>'Aplicacao\UsuarioController@create']);
                Route::get('{id}/destroy',  ['as'=>'usuario.destroy', 'uses'=>'Aplicacao\UsuarioController@destroy']);
                Route::get('{id}/edit',     ['as'=>'usuario.edit',    'uses'=>'Aplicacao\UsuarioController@edit']);
                Route::put('{id}/update',   ['as'=>'usuario.update',  'uses'=>'Aplicacao\UsuarioController@update']);
                Route::post('store',        ['as'=>'usuario.store',   'uses'=>'Aplicacao\UsuarioController@store']);
                Route::get('reset/{id}',    ['as'=>'usuario.reset',   'uses'=>'Aplicacao\UsuarioController@resetUser']);
            });

            Route::group(['prefix' => 'mensalidade','middleware'=>['isRecep']], function () {

                Route::any('',              ['as'=>'mensalidade',         'uses'=>'Aplicacao\MensalidadeController@index']);
                Route::get('{id}/show',     ['as'=>'mensalidade.show',    'uses'=>'Aplicacao\MensalidadeController@show']);
                Route::post('receber',      ['as'=>'mensalidade.receber', 'uses'=>'Aplicacao\MensalidadeController@receber']);
            });

            Route::group(['prefix' => 'pagamento','middleware'=>['isRecep']], function () {

                Route::any('',              ['as'=>'pagamento',          'uses'=>'Aplicacao\PagamentoController@index']);
                Route::get('{id}/destroy',  ['as'=>'pagamento.destroy',  'uses'=>'Aplicacao\PagamentoController@destroy']);
            });

            Route::group(['prefix' => 'caixa','middleware'=>['isRecep']], function () {

                Route::get('',              ['as'=>'caixa',              'uses'=>'Aplicacao\CaixaController@index']);
                Route::post('store',        ['as'=>'caixa.store',        'uses'=>'Aplicacao\CaixaController@store']);

            });


            Route::group(['prefix'=>'relatorio', 'middleware'=>'isRecep' ], function (){
               Route::get('',           ['as'=>'relatorio', 'uses'=>'Aplicacao\RelatorioController@index']);
               Route::any('quitadas',   ['as'=>'relatorio.mensalidade.quitadas', 'uses'=>'Aplicacao\RelatorioController@mensalidadesPagas']);
               Route::any('avencer',    ['as'=>'relatorio.mensalidade.avencer',  'uses'=>'Aplicacao\RelatorioController@mensalidadesAVencer']);
               Route::any('caixa',      ['as'=>'relatorio.caixa',                'uses'=>'Aplicacao\RelatorioController@caixaPorData']);
            });


        });
