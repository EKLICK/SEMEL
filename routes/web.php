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
    return view('welcome');
})->name('welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::resource('professor', 'professorController');
Route::get('/professor_info/{id}', 'ProfessorController@professor_info')->name('professor_info');
Route::get('/professor_turmas/{id}', 'ProfessorController@professor_turmas')->name('professor_turmas');
Route::get('/professor_turmas/vincular/{idprofessor}/{idturma}', 'ProfessorController@professores_turmas_vincular')->name('professores_turmas_vincular');
Route::get('/professor_turmas/desvincular/{idprofessor}/{idturma}', 'ProfessorController@professores_turmas_desvincular')->name('professores_turmas_desvincular');

Route::resource('pessoas', 'PessoasController');
Route::get('/pessoas_info/{id}', 'PessoasController@pessoas_info')->name('pessoa_info');
Route::get('/pessoas_lista_anamneses/{id}', 'PessoasController@lista_anamnese')->name('lista_anamnese');
Route::get('/pessoas_lista_anamneses_create/{id}', 'PessoasController@lista_anamnese_create')->name('lista_anamnese_create');
Route::get('/pessoas_turmas/{id}', 'PessoasController@pessoas_turmas')->name('pessoas_turmas');
Route::get('/pessoas_turmas/vincular/{idpessoa}/{idturma}', 'PessoasController@pessoas_turmas_vincular')->name('pessoas_turmas_vincular');
Route::get('/pessoas_turmas/desvincular/{idpessoa}/{idturma}', 'PessoasController@pessoas_turmas_desvincular')->name('pessoas_turmas_desvincular');

Route::resource('anamneses', 'anamneseController');
Route::get('/anamneses_info/{id}', 'AnamneseController@anamnese_info')->name('anamnese_info');

Route::resource('doencas', 'doencasController');

Route::resource('turmas', 'turmasController');

Route::resource('nucleos', 'nucleosController');
Route::get('/nucleos_turmas/{id}', 'NucleosController@turmas_cadastradas')->name('turmas_cadastradas');