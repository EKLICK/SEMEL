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
Route::resource('professor','professorController');
Route::get('/professor/edit/senha','professorController@editar_senha')->name('editar_senha');
Route::get('/restore/professor{id}','professorController@restore')->name('professor_restore');
Route::get('/professors_info/{id}','professorController@professor_info')->name('professor_info');
Route::put('/professor/update/senha/{id}','professorController@update_senha')->name('update_senha');
Route::get('/softdeletes/professor','professorController@softdeletes')->name('professor_softdeletes');
Route::get('/professor_turmas/{id}','professorController@professor_turmas')->name('professor_turmas');
Route::get('/professor_meus_alunos/{idprofessor}/{idturma}','professorController@professor_meus_alunos')->name('professor_meus_alunos');
Route::get('/professor_turmas/vincular/{idprofessor}/{idturma}', 'professorController@professores_turmas_vincular')->name('professores_turmas_vincular');
Route::get('/professor_turmas/desvincular/{idprofessor}/{idturma}', 'ProfessorController@professores_turmas_desvincular')->name('professores_turmas_desvincular');

//Rotas de pessoas
Route::resource('pessoas','pessoasController');
Route::post('/pessoas/procurar','pessoasController@pessoas_procurar')->name('pessoas_procurar');
Route::get('/pessoas/pdf/{id}','pessoasController@pdfpessoas')->name('pdfpessoas');
Route::get('/pessoas_info/{id}','pessoasController@pessoas_info')->name('pessoa_info');
Route::get('/restore/pessoas/{id}','pessoasController@restore')->name('pessoas_restore');
Route::get('/select/pessoas', 'pessoasController@pessoas_select')->name('pessoas_select');
Route::get('/pessoas_turmas/{id}','pessoasController@pessoas_turmas')->name('pessoas_turmas');
Route::get('/softdeletes/pessoas','PessoasController@softdeletes')->name('pessoas_softdeletes');
Route::get('/professor/deletarpessoa/','pessoaController@deletarPessoaCriada')->name('recriar');
Route::get('/edit/menores/{id}', 'pessoasController@pessoas_edit_menores')->name('pessoas_edit_menores');
Route::get('/edit/maiores/{id}', 'pessoasController@pessoas_edit_maiores')->name('pessoas_edit_maiores');
Route::get('/pessoas_lista_anamneses/{id}','pessoasController@lista_anamnese')->name('lista_anamnese');
Route::get('/create/menores', 'pessoasController@pessoas_create_menores')->name('pessoas_create_menores');
Route::get('/create/maiores', 'pessoasController@pessoas_create_maiores')->name('pessoas_create_maiores');
Route::get('/pessoas_lista_anamneses_create/{id}','pessoasController@lista_anamnese_create')->name('lista_anamnese_create');
Route::get('/pessoas_turmas/vincular/{idpessoa}/{idturma}','pessoasController@pessoas_turmas_vincular')->name('pessoas_turmas_vincular');
Route::get('/pessoas_turmas/desvincular/{idpessoa}/{idturma}','pessoasController@pessoas_turmas_desvincular')->name('pessoas_turmas_desvincular');

//Rotas de anamneses
Route::resource('anamneses','anamneseController');
Route::get('/anamnese/pdf/{id}','anamneseController@pdfanamnese')->name('pdfanamnese');
Route::get('/anamneses_antigas','anamneseController@index2')->name('anamneses.index2');
Route::get('/anamneses_info/{id}','anamneseController@anamnese_info')->name('anamnese_info');
Route::post('/anamneses/procurar','anamneseController@anamnese_procurar')->name('anamnese_procurar');

//Rotas de doenças
Route::resource('doencas','doencasController');
Route::post('/doencas/procurar', 'doencasController@doencas_procurar')->name('doencas_procurar');

//Rotas de turmas
Route::resource('turmas','turmasController');
Route::post('/turmas/procurar','turmasController@turmas_procurar')->name('turmas_procurar');

//Rotas de núcleos
Route::resource('nucleos','nucleosController');
Route::get('/nucleos_turmas/{id}','nucleosController@turmas_cadastradas')->name('turmas_cadastradas');
Route::post('/nucleos/procurar', 'nucleosController@nucleos_procurar')->name('nucleos_procurar');

Route::get('/audits','AuditsController@index')->name('audits.index');
Route::get('/audits/info/{id}','AuditsController@info')->name('audits_info');