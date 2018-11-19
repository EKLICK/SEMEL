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
Route::resource('pessoas', 'PessoasController');
Route::resource('anamneses', 'anamneseController');
Route::resource('doencas', 'doencasController');
Route::resource('turmas', 'turmasController');

Route::get('/pessoas_lista_anamneses/{id}', 'PessoasController@lista_anamnese')->name('lista_anamnese');
Route::get('/pessoas_info/{id}', 'PessoasController@pessoas_info')->name('pessoa_info');