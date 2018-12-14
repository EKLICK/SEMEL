<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Rotas de administração geral
Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
Route::get('decompose','\Lubusin\Decomposer\Controllers\DecomposerController@index');
Route::get('/', function () {
    return redirect()->route('login');
})->name('welcome');
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

//Rotas de professores
Route::resource('professor','professorController')->middleware('Authenticate');
Route::get('/professor/edit/senha','professorController@editar_senha')->name('editar_senha')->middleware('Authenticate');
Route::get('/professors_info/{id}','professorController@professor_info')->name('professor_info')->middleware('Authenticate');
Route::put('/professor/update/senha/{id}','professorController@update_senha')->name('update_senha')->middleware('Authenticate');
Route::get('/professor_turmas/{id}','professorController@professor_turmas')->name('professor_turmas')->middleware('Authenticate');
Route::post('/professor/procurar','professorController@professor_procurar')->name('professor_procurar')->middleware('Authenticate');
Route::get('/filtros_professor_turmas/{id}','professorController@filtros_professor_turmas')->name('filtros_professor_turmas')->middleware('Authenticate');
Route::post('/professor_meus_alunos/procurar/', 'professorController@professor_procurar_aluno')->name('professor_procurar_aluno')->middleware('Authenticate');
Route::get('/professor_meus_alunos/{idprofessor}/{idturma}','professorController@professor_meus_alunos')->name('professor_meus_alunos')->middleware('Authenticate');
Route::get('/professor_turmas/vincular/{idprofessor}/{idturma}','professorController@professores_turmas_vincular')->name('professores_turmas_vincular')->middleware('Authenticate');
Route::get('/professor_turmas/desvincular/{idprofessor}/{idturma}','ProfessorController@professores_turmas_desvincular')->name('professores_turmas_desvincular')->middleware('Authenticate');

//Rotas de pessoas
Route::resource('pessoas','pessoasController')->middleware('Authenticate');
Route::get('/pessoas/pdf/{id}','pessoasController@pdfpessoas')->name('pdfpessoas')->middleware('Authenticate');
Route::get('/pessoas_info/{id}','pessoasController@pessoas_info')->name('pessoa_info')->middleware('Authenticate');
Route::get('/select/pessoas', 'pessoasController@pessoas_select')->name('pessoas_select')->middleware('Authenticate');
Route::get('/pessoas_turmas/{id}','pessoasController@pessoas_turmas')->name('pessoas_turmas')->middleware('Authenticate');
Route::get('/professor/deletarpessoa/','pessoaController@deletarPessoaCriada')->name('recriar')->middleware('Authenticate');
Route::post('/pessoas/procurar','pessoasController@pessoas_procurar')->name('pessoas_procurar')->middleware('Authenticate');
Route::get('/edit/menores/{id}','pessoasController@pessoas_edit_menores')->name('pessoas_edit_menores')->middleware('Authenticate');
Route::get('/edit/maiores/{id}','pessoasController@pessoas_edit_maiores')->name('pessoas_edit_maiores')->middleware('Authenticate');
Route::get('/pessoas_lista_anamneses/{id}','pessoasController@lista_anamnese')->name('lista_anamnese')->middleware('Authenticate');
Route::get('/create/menores','pessoasController@pessoas_create_menores')->name('pessoas_create_menores')->middleware('Authenticate');
Route::get('/create/maiores','pessoasController@pessoas_create_maiores')->name('pessoas_create_maiores')->middleware('Authenticate');
Route::get('/pessoas_lista_anamneses_create/{id}','pessoasController@lista_anamnese_create')->name('lista_anamnese_create')->middleware('Authenticate');
Route::get('/pessoas_turmas/vincular/{idpessoa}/{idturma}','pessoasController@pessoas_turmas_vincular')->name('pessoas_turmas_vincular')->middleware('Authenticate');
Route::get('/pessoas_turmas/desvincular/{idpessoa}/{idturma}','pessoasController@pessoas_turmas_desvincular')->name('pessoas_turmas_desvincular')->middleware('Authenticate');

//Rotas de anamneses
Route::resource('anamneses','anamneseController')->middleware('Authenticate');
Route::get('/anamnese_create/{id}','anamneseController@anamnese_create')->name('anamnese_create')->middleware('Authenticate');
Route::get('/anamnese/pdf/{id}','anamneseController@pdfanamnese')->name('pdfanamnese')->middleware('Authenticate');
Route::get('/anamneses_antigas','anamneseController@index2')->name('anamneses.index2')->middleware('Authenticate');
Route::get('/anamneses_info/{id}','anamneseController@anamnese_info')->name('anamnese_info')->middleware('Authenticate');
Route::post('/anamneses/procurar','anamneseController@anamnese_procurar')->name('anamnese_procurar')->middleware('Authenticate');

//Rotas de doenças
Route::resource('doencas','doencasController')->middleware('Authenticate');
Route::post('/doencas/procurar', 'doencasController@doencas_procurar')->name('doencas_procurar')->middleware('Authenticate');

//Rotas de turmas
Route::resource('turmas','turmasController')->middleware('Authenticate');
Route::get('/turmas_info/{id}','turmasController@turma_info')->name('turma_info')->middleware('Authenticate');
Route::post('/turmas/procurar','turmasController@turmas_procurar')->name('turmas_procurar')->middleware('Authenticate');

//Rotas de núcleos
Route::resource('nucleos','nucleosController')->middleware('Authenticate');
Route::get('/nucleos_info/{id}','nucleosController@nucleo_info')->name('nucleo_info')->middleware('Authenticate');
Route::post('/nucleos/procurar','nucleosController@nucleos_procurar')->name('nucleos_procurar')->middleware('Authenticate');
Route::get('/nucleos_turmas/{id}','nucleosController@turmas_cadastradas')->name('turmas_cadastradas')->middleware('Authenticate');

//Rotas de Audits
Route::get('/audits','AuditsController@index')->name('audits.index')->middleware('Authenticate');
Route::get('/audits/info/{id}','AuditsController@info')->name('audits_info')->middleware('Authenticate');
Route::post('/audits_procurar','AuditsController@audits_procurar')->name('audits_procurar')->middleware('Authenticate');

//Softdeletes
Route::get('/restore/pessoas/{id}','deleteController@pessoas_restore')->name('pessoas_restore')->middleware('Authenticate');
Route::get('/softdeletes/pessoas','deleteController@pessoas_softdeletes')->name('pessoas_softdeletes')->middleware('Authenticate');
Route::get('/restore/professor{id}','deleteController@professores_restore')->name('professores_restore')->middleware('Authenticate');
Route::get('/softdeletes/professor','deleteController@professores_softdeletes')->name('professores_softdeletes')->middleware('Authenticate');
Route::post('/softdeletes/procurar/pessoas', 'deleteController@pessoas_procurar_softdelete')->name('pessoas_procurar_softdelete')->middleware('Authenticate');
Route::post('/softdeletes/procurar/professores', 'deleteController@professores_procurar_softdelete')->name('professores_procurar_softdelete')->middleware('Authenticate');