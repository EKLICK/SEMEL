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
Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
Route::get('decompose','\Lubusin\Decomposer\Controllers\DecomposerController@index');

Route::get('/', function () {
    return redirect()->route('login');
})->name('welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::resource('professor', 'professorController');
Route::get('/professor/audits','professorController@audits')->name('professor_audits');
Route::get('/restore/professor{id}','professorController@restore')->name('professor_restore');
Route::get('/professor/edit/senha', 'professorController@editar_senha')->name('editar_senha');
Route::get('/professor_info/{id}', 'professorController@professor_info')->name('professor_info');
Route::put('/professor/update/senha/{id}', 'professorController@update_senha')->name('update_senha');
Route::get('/softdeletes/professor','professorController@softdeletes')->name('professor_softdeletes');
Route::get('/professor_turmas/{id}', 'professorController@professor_turmas')->name('professor_turmas');
Route::get('/professor_meus_alunos/{id}', 'professorController@professor_meus_alunos')->name('professor_meus_alunos');
Route::get('/professor_turmas/vincular/{idprofessor}/{idturma}', 'professorController@professores_turmas_vincular')->name('professores_turmas_vincular');
Route::get('/professor_turmas/desvincular/{idprofessor}/{idturma}', 'ProfessorController@professores_turmas_desvincular')->name('professores_turmas_desvincular');

Route::resource('pessoas', 'pessoasController');
Route::get('/pessoas/audits','pessoasController@audits')->name('pessoas_audits');
Route::get('/pessoas_info/{id}', 'pessoasController@pessoas_info')->name('pessoa_info');
Route::get('/restore/pessoas{id}','pessoasController@restore')->name('pessoas_restore');
Route::get('/pessoas_turmas/{id}', 'pessoasController@pessoas_turmas')->name('pessoas_turmas');
Route::get('/softdeletes/pessoas','PessoasController@softdeletes')->name('pessoas_softdeletes');
Route::get('/pessoas_lista_anamneses/{id}', 'pessoasController@lista_anamnese')->name('lista_anamnese');
Route::get('/pessoas_lista_anamneses_create/{id}', 'pessoasController@lista_anamnese_create')->name('lista_anamnese_create');
Route::get('/pessoas_turmas/vincular/{idpessoa}/{idturma}', 'pessoasController@pessoas_turmas_vincular')->name('pessoas_turmas_vincular');
Route::get('/pessoas_turmas/desvincular/{idpessoa}/{idturma}', 'pessoasController@pessoas_turmas_desvincular')->name('pessoas_turmas_desvincular');

Route::resource('anamneses', 'anamneseController');
Route::get('/anamneses/audits','anamneseController@audits')->name('anamneses_audits');
Route::get('/anamneses_antigas', 'anamneseController@index2')->name('anamneses.index2');
Route::get('/anamneses_info/{id}', 'anamneseController@anamnese_info')->name('anamnese_info');
Route::get('/softdeletes/anamneses','anamneseController@softdeletes')->name('anamneses_softdeletes');

Route::resource('doencas', 'doencasController');
Route::get('/doencas/audits','doencasController@audits')->name('doencas_audits');
Route::get('/softdeletes/doencas','doencasController@softdeletes')->name('doencas_softdeletes');

Route::resource('turmas', 'turmasController');
Route::get('/turmas/audits','turmasController@audits')->name('turmas_audits');
Route::get('/softdeletes/doencas','doencasController@softdeletes')->name('doencas_softdeletes');


Route::resource('nucleos', 'nucleosController');
Route::get('/nucleos/audits','nucleosController@audits')->name('nucleos_audits');
Route::get('/softdeletes/turmas','turmasController@softdeletes')->name('turmas_softdeletes');
Route::get('/nucleos_turmas/{id}', 'nucleosController@turmas_cadastradas')->name('turmas_cadastradas');