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
Route::get('/professor_turmas/{id}','professorController@professor_turmas')->name('professor_turmas');
//Controle do professor
Route::get('/filtros_professor_turmas/{id}','professorController@filtros_professor_turmas')->name('filtros_professor_turmas');
Route::get('/professor_meus_alunos/procurar/', 'professorController@professor_procurar_aluno')->name('professor_procurar_aluno');
Route::get('/professor_meus_alunos/{idprofessor}/{idturma}','professorController@professor_meus_alunos')->name('professor_meus_alunos');
//Controle do administrador
Route::resource('professor','professorController')->middleware('AdministracaoEProfessor');
Route::get('/professors_info/{id}','professorController@professor_info')->name('professor_info')->middleware('AdministracaoEProfessor');
Route::get('/procurar/professor','professorController@professor_procurar')->name('professor_procurar')->middleware('AdministracaoEProfessor');
Route::get('/professor_turmas/vincular/{idprofessor}/{idturma}','professorController@professores_turmas_vincular')->name('professores_turmas_vincular')->middleware('AdministracaoEProfessor');
Route::get('/professor_turmas/desvincular/{idprofessor}/{idturma}','ProfessorController@professores_turmas_desvincular')->name('professores_turmas_desvincular')->middleware('AdministracaoEProfessor');

//Rotas de pessoas
Route::resource('pessoas','pessoasController')->middleware('AdministracaoEProfessor');
Route::get('/pessoas/pdf/{id}','pessoasController@pdfpessoas')->name('pdfpessoas')->middleware('AdministracaoEProfessor');
Route::get('/pessoas_info/{id}','pessoasController@pessoas_info')->name('pessoa_info')->middleware('AdministracaoEProfessor');
Route::get('/select/pessoas', 'pessoasController@pessoas_select')->name('pessoas_select')->middleware('AdministracaoEProfessor');
Route::get('/pessoas_turmas/{id}','pessoasController@pessoas_turmas')->name('pessoas_turmas')->middleware('AdministracaoEProfessor');
Route::get('/professor/deletar_pessoa/','pessoasController@deletarPessoaCriada')->name('recriar')->middleware('AdministracaoEProfessor');
Route::get('/procurar/pessoas','pessoasController@pessoas_procurar')->name('pessoas_procurar')->middleware('AdministracaoEProfessor');
Route::get('/pessoas_lista_anamneses/{id}','pessoasController@lista_anamnese')->name('lista_anamnese')->middleware('AdministracaoEProfessor');
Route::get('/pessoas_lista_anamneses_create/{id}','pessoasController@lista_anamnese_create')->name('lista_anamnese_create')->middleware('AdministracaoEProfessor');
Route::get('/pessoas_turmas/vincular/{idpessoa}/{idturma}','pessoasController@pessoas_turmas_vincular')->name('pessoas_turmas_vincular')->middleware('AdministracaoEProfessor');
Route::get('/pessoas_turmas/desvincular/{idpessoa}/{idturma}','pessoasController@pessoas_turmas_desvincular')->name('pessoas_turmas_desvincular')->middleware('AdministracaoEProfessor');

//Rotas de anamneses
Route::resource('anamneses','anamneseController')->middleware('AdministracaoEProfessor');
Route::get('/anamnese_create/{id}','anamneseController@anamnese_create')->name('anamnese_create')->middleware('AdministracaoEProfessor');
Route::get('/anamnese/pdf/{id}','anamneseController@pdfanamnese')->name('pdfanamnese')->middleware('AdministracaoEProfessor');
Route::get('/anamneses_antigas','anamneseController@index2')->name('anamneses.index2')->middleware('AdministracaoEProfessor');
Route::get('/anamneses_info/{id}','anamneseController@anamnese_info')->name('anamnese_info')->middleware('AdministracaoEProfessor');
Route::get('/procurar/anamneses','anamneseController@anamnese_procurar')->name('anamnese_procurar')->middleware('AdministracaoEProfessor');

//Rotas de doenças
Route::resource('doencas','doencasController')->middleware('AdministracaoEProfessor');
Route::get('/procurar/doencas', 'doencasController@doencas_procurar')->name('doencas_procurar')->middleware('AdministracaoEProfessor');

//Rotas de turmas
Route::resource('turmas','turmasController')->middleware('AdministracaoEProfessor');
Route::get('/turmas_info/{id}','turmasController@turma_info')->name('turma_info')->middleware('AdministracaoEProfessor');
Route::get('/procurar/turmas','turmasController@turmas_procurar')->name('turmas_procurar')->middleware('AdministracaoEProfessor');

//Rotas de núcleos
Route::resource('nucleos','nucleosController')->middleware('AdministracaoEProfessor');
Route::get('/nucleos_info/{id}','nucleosController@nucleo_info')->name('nucleo_info')->middleware('AdministracaoEProfessor');
Route::get('/procurar/nucleos','nucleosController@nucleos_procurar')->name('nucleos_procurar')->middleware('AdministracaoEProfessor');
Route::get('/nucleos_turmas/{id}','nucleosController@turmas_cadastradas')->name('turmas_cadastradas')->middleware('AdministracaoEProfessor');

//Rotas de Audits
Route::get('/audits','AuditsController@index')->name('audits.index')->middleware('AdministracaoEProfessor');
Route::get('/audits/info/{id}','AuditsController@info')->name('audits_info')->middleware('AdministracaoEProfessor');
Route::get('/procurar/audits','AuditsController@audits_procurar')->name('audits_procurar')->middleware('AdministracaoEProfessor');

//Softdeletes
Route::get('/restore/pessoas/{id}','deleteController@pessoas_restore')->name('pessoas_restore')->middleware('AdministracaoEProfessor');
Route::get('/softdeletes/pessoas','deleteController@pessoas_softdeletes')->name('pessoas_softdeletes')->middleware('AdministracaoEProfessor');
Route::get('/softdeletes/procurar/pessoas', 'deleteController@pessoas_procurar_softdelete')->name('pessoas_procurar_softdelete')->middleware('AdministracaoEProfessor');