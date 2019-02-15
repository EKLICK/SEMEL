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

//Controle de Professores
Route::get('/professors_info/{id}','ProfessorController@professor_info')->name('professor_info')->middleware('Authenticate');
Route::get('/professor_turmas/{id}','ProfessorController@professor_turmas')->name('professor_turmas')->middleware('Authenticate');
//Controle do professor
Route::get('/professor_meus_alunos/{idprofessor}/{idturma}','ProfessorController@professor_meus_alunos')->name('professor_meus_alunos')->middleware('Authenticate');
//Controle do administrador
Route::resource('professor','ProfessorController')->middleware('AdministracaoEProfessor');
Route::post('/professor_turmas/vincular','ProfessorController@professores_turmas_vincular')->name('professores_turmas_vincular')->middleware('AdministracaoEProfessor', 'Authenticate');
Route::post('/professores_turmas/ativar_inativar','ProfessorController@professores_turmas_ativar_inativar')->name('professores_turmas_ativar_inativar')->middleware('AdministracaoEProfessor', 'Authenticate');

//Rotas de pessoas
Route::resource('pessoas','PessoasController')->middleware('AdministracaoEProfessor');
Route::get('/pessoas/pdf/{id}','PessoasController@pdfpessoas')->name('pdfpessoas')->middleware('AdministracaoEProfessor', 'Authenticate');
Route::get('/pessoas_info/{id}','PessoasController@pessoas_info')->name('pessoa_info')->middleware('AdministracaoEProfessor', 'Authenticate');
Route::get('/select/pessoas', 'PessoasController@pessoas_select')->name('pessoas_select')->middleware('AdministracaoEProfessor', 'Authenticate');
//Rotas de vinculos de pessoas e turmas
Route::get('/pessoas_turmas/{id}','PessoasController@pessoas_turmas')->name('pessoas_turmas')->middleware('AdministracaoEProfessor', 'Authenticate');
Route::post('/pessoas_turmas/vincular','PessoasController@pessoas_turmas_vincular')->name('pessoas_turmas_vincular')->middleware('AdministracaoEProfessor', 'Authenticate');
Route::post('/pessoas_turmas/ativar_inativar','PessoasController@pessoas_turmas_ativar_inativar')->name('pessoas_turmas_ativar_inativar')->middleware('AdministracaoEProfessor', 'Authenticate');

//Rotas de anamneses
Route::resource('anamneses','AnamneseController')->middleware('AdministracaoEProfessor', 'Authenticate');
Route::get('/anamnese_create/{id}','AnamneseController@anamnese_create')->name('anamnese_create')->middleware('AdministracaoEProfessor', 'Authenticate');
Route::get('/anamnese/pdf/{id}','AnamneseController@pdfanamnese')->name('pdfanamnese')->middleware('AdministracaoEProfessor', 'Authenticate');
Route::get('/anamneses_antigas','AnamneseController@index2')->name('anamneses.index2')->middleware('AdministracaoEProfessor', 'Authenticate');
Route::get('/anamneses_info/{id}','AnamneseController@anamnese_info')->name('anamnese_info')->middleware('AdministracaoEProfessor', 'Authenticate');

//Rotas de doenças
Route::resource('doencas','DoencasController')->middleware('AdministracaoEProfessor', 'Authenticate');
Route::get('/ajax/doenca','DoencasController@criar_doenca_ajax')->middleware('AdministracaoEProfessor', 'Authenticate');
Route::get('/ajax/modal','DoencasController@modal_doencas')->middleware('AdministracaoEProfessor', 'Authenticate');

//Rotas de turmas
Route::resource('turmas','TurmasController')->middleware('AdministracaoEProfessor', 'Authenticate');
Route::get('/turmas_info/{id}','TurmasController@turma_info')->name('turma_info')->middleware('Authenticate');
Route::post('/turmas/ativar_inativar', 'TurmasController@turmas_ativar_inativar')->name('turmas_ativar_inativar')->middleware('AdministracaoEProfessor', 'Authenticate');

//Rotas de núcleos
Route::resource('nucleos','NucleosController')->middleware('AdministracaoEProfessor', 'Authenticate');
Route::get('/nucleos_info/{id}','NucleosController@nucleo_info')->name('nucleo_info')->middleware('Authenticate');
Route::get('/nucleos_turmas/{id}','NucleosController@turmas_cadastradas')->name('turmas_cadastradas')->middleware('AdministracaoEProfessor', 'Authenticate');
Route::post('/nucleos/ativar_inativar', 'NucleosController@nucleos_ativar_inativar')->name('nucleos_ativar_inativar')->middleware('AdministracaoEProfessor', 'Authenticate');

//Rotas de Audits
Route::get('/audits','AuditsController@index')->name('audits.index')->middleware('AdministracaoEProfessor', 'Authenticate');
Route::get('/audits/info/{id}','AuditsController@info')->name('audits_info')->middleware('AdministracaoEProfessor', 'Authenticate');

//Procurar

//1-professor
Route::any('/filtros_professor_turmas/{id}','Ferramentas\FiltersController@filtros_professor_turmas')->name('filtros_professor_turmas')->middleware('Authenticate');
Route::any('/professor_meus_alunos/procurar/', 'Ferramentas\FiltersController@professor_procurar_aluno')->name('professor_procurar_aluno')->middleware('Authenticate');
Route::any('/procurar/professor','Ferramentas\FiltersController@professor_procurar')->name('professor_procurar')->middleware('AdministracaoEProfessor', 'Authenticate');
//2-pessoas
Route::any('/procurar/pessoas','Ferramentas\FiltersController@pessoas_procurar')->name('pessoas_procurar')->middleware('AdministracaoEProfessor', 'Authenticate');
//3-anamneses
Route::any('/procurar/anamneses','Ferramentas\FiltersController@anamnese_procurar')->name('anamnese_procurar')->middleware('AdministracaoEProfessor', 'Authenticate');
//4-doencas
Route::any('/procurar/doencas', 'Ferramentas\FiltersController@doencas_procurar')->name('doencas_procurar')->middleware('AdministracaoEProfessor', 'Authenticate');
//5-turmas
Route::any('/procurar/turmas','Ferramentas\FiltersController@turmas_procurar')->name('turmas_procurar')->middleware('AdministracaoEProfessor', 'Authenticate');
//6-núcleos
Route::any('/procurar/nucleos','Ferramentas\FiltersController@nucleos_procurar')->name('nucleos_procurar')->middleware('AdministracaoEProfessor', 'Authenticate');
//7-audits
Route::any('/procurar/audits','Ferramentas\FiltersController@audits_procurar')->name('audits_procurar')->middleware('AdministracaoEProfessor', 'Authenticate');

//Quantidade de bloqueio
Route::get('/pessoa/quantidade','PessoasController@define_quantidade')->name('define_quantidade')->middleware('AdministracaoEProfessor', 'Authenticate');