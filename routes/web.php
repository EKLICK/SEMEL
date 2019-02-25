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
//ROTAS DE ADMINISTAÇÃO GERAL: |------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
//Rota welcome: Utilizado para Logar no sistema com uma conta.
Route::get('/', function(){return redirect()->route('login');})->name('welcome');

//Rota de Logs: Utilizado para entrar na página de login.
Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

//Rota Decompose: Utilizado para abrir registro de todas as bibliotecas instaladas.
Route::get('decompose','\Lubusin\Decomposer\Controllers\DecomposerController@index');

//Rotas de Auditorias: Utilizado para acessar controle de auditorias.
Auth::routes();

//Rota Home: Utilizado para acessar a página home padrão.
Route::get('/home', 'HomeController@index')->name('home');

//Rota define_quantidade: Utilizado para editar a quantidade limite de turmas que uma pessoa pode ter ativas ao mesmo tempo.
Route::get('/pessoa/quantidade','PessoasController@define_quantidade')->name('define_quantidade')->middleware('AdministracaoEProfessor', 'Authenticate');


//CONTROLE DE PROFESSORES: |----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
//RotaS de professores: Utilizado para acessar controle padrão de professores.
Route::resource('professor','ProfessorController')->middleware('AdministracaoEProfessor');

//Rota Professor_info: Utilizado para entrar na página de informações do professor (Página com acesso de professores).
Route::get('/professors_info/{id}','ProfessorController@professor_info')->name('professor_info')->middleware('Authenticate');

//Rota Professor_turmas: Utilizado para entrar na página de professor e turmas (Página com acesso de professores).
Route::get('/professor_turmas/{id}','ProfessorController@professor_turmas')->name('professor_turmas')->middleware('Authenticate');

//Rota Professor_meus_alunos: Utilizado para entrar na página de alunos do professor (Página com acesso de professores).
Route::get('/professor_meus_alunos/{idprofessor}/{idturma}','ProfessorController@professor_meus_alunos')->name('professor_meus_alunos')->middleware('Authenticate');

//Rotas professores_turmas_vincular: Utilizado para vincular professores em turmas.
Route::post('/professor_turmas/vincular','ProfessorController@professores_turmas_vincular')->name('professores_turmas_vincular')->middleware('AdministracaoEProfessor', 'Authenticate');

//Rotas professores_turmas_ativar_inativar: Utilizado para ativar ou inativar professores em turmas.
Route::post('/professores_turmas/ativar_inativar','ProfessorController@professores_turmas_ativar_inativar')->name('professores_turmas_ativar_inativar')->middleware('AdministracaoEProfessor', 'Authenticate');


//CONTROLE DE PESSOAS: |--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
//Rotas de pessoas: Utilizado para acessar controle padrão de pessoas.
Route::resource('pessoas','PessoasController')->middleware('Authenticate');

//Rota pessoa_info: Utilizado para entrar na página de informações da pessoa.
Route::get('/pessoas_info/{id}','PessoasController@pessoas_info')->name('pessoa_info')->middleware('AdministracaoEProfessor', 'Authenticate');

//Rota pessoas_turmas: Utilizado para entrar na página de pessoas e turmas.
Route::get('/pessoas_turmas/{id}','PessoasController@pessoas_turmas')->name('pessoas_turmas')->middleware('AdministracaoEProfessor', 'Authenticate');

//Rota pessoas_turmas_vincular: Utilizado para vincular pessoas em turmas.
Route::post('/pessoas_turmas/vincular','PessoasController@pessoas_turmas_vincular')->name('pessoas_turmas_vincular')->middleware('AdministracaoEProfessor', 'Authenticate');

//Rotas pessoas_turmas_ativar_inativar: Utilizado para ativar ou inativar pessoas em turmas.
Route::post('/pessoas_turmas/ativar_inativar','PessoasController@pessoas_turmas_ativar_inativar')->name('pessoas_turmas_ativar_inativar')->middleware('AdministracaoEProfessor', 'Authenticate');

//Rotas pdfpessoas: Utilizado para entrar na página de PDF da pessoa.
Route::get('/pessoas/pdf/{id}','PessoasController@pdfpessoas')->name('pdfpessoas')->middleware('AdministracaoEProfessor', 'Authenticate');


//CONTROLE DE ANAMNESES: |------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
//Rotas de anamneses: Utilizado para acessar controle padrão de anamneses.
Route::resource('anamneses','AnamneseController')->middleware('AdministracaoEProfessor', 'Authenticate');

//Rotas de anamnese_create: Utilizado para substituir função padrão de criação de anamneses.
Route::get('/anamnese_create/{id}','AnamneseController@anamnese_create')->name('anamnese_create')->middleware('AdministracaoEProfessor', 'Authenticate');

//Rota anamnese_info: Utilizado para entrar na página de informações da anamnese.
Route::get('/anamneses_info/{id}','AnamneseController@anamnese_info')->name('anamnese_info')->middleware('Authenticate');

//Rota pdfanamnese: Utilizado para entrar na página de PDF da anamnese.
Route::get('/anamnese/pdf/{id}','AnamneseController@pdfanamnese')->name('pdfanamnese')->middleware('AdministracaoEProfessor', 'Authenticate');


//CONTROLE DE DOENÇAS: |--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
//Rotas de doenças: Utilizado para acessar controle padrão de doenças.
Route::resource('doencas','DoencasController')->middleware('AdministracaoEProfessor', 'Authenticate');

//Rota criacao_ajax_doenca: Utilizado para criar doenças dinamicamente na página de criação de pessoas.
Route::get('/ajax/doenca','DoencasController@criar_doenca_ajax')->name('criacao_ajax_doenca')->middleware('AdministracaoEProfessor', 'Authenticate');


//CONTROLE DE TURMAS: |---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
//Rotas de turmas: Utilizado para acessar controle padrão de turmas.
Route::resource('turmas','TurmasController')->middleware('AdministracaoEProfessor', 'Authenticate');

//Rota turma_info: Utilizado para entrar na página de informações da turma.
Route::get('/turmas_info/{id}','TurmasController@turma_info')->name('turma_info')->middleware('AdministracaoEProfessor', 'Authenticate');

//Rotas turmas_ativar_inativar: Utilizado para ativar ou inativar uma turma.
Route::post('/turmas/ativar_inativar', 'TurmasController@turmas_ativar_inativar')->name('turmas_ativar_inativar')->middleware('AdministracaoEProfessor', 'Authenticate');


//CONTROLE DE NÚCLEOS: |--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
//Rotas de núcleos: Utilizado para acessar controle padrão de núcleos.
Route::resource('nucleos','NucleosController')->middleware('AdministracaoEProfessor', 'Authenticate');

//Rota nucleo_info: Utilizado para entrar na página de informações de núcleo.
Route::get('/nucleos_info/{id}','NucleosController@nucleo_info')->name('nucleo_info')->middleware('AdministracaoEProfessor', 'Authenticate');

//Rotas nucleos_ativar_inativar: Utilizado para ativar ou inativar um núcleo.
Route::post('/nucleos/ativar_inativar', 'NucleosController@nucleos_ativar_inativar')->name('nucleos_ativar_inativar')->middleware('AdministracaoEProfessor', 'Authenticate');


//CONTROLE DE AUDITORIAS: |-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
//Rotas de audits.index: Utilizado para acessar controle expecifico de apresentação de auditorias..
Route::get('/audits','AuditsController@index')->name('audits.index')->middleware('AdministracaoEProfessor', 'Authenticate');

//Rota audits_info: Utilizado para entrar na página de informações da auditoria.
Route::get('/audits/info/{id}','AuditsController@info')->name('audits_info')->middleware('AdministracaoEProfessor', 'Authenticate');

//CONTROLE DE FILTROS: |--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|

//FILTROS DE PROFESSORES
//Rota filtros_professor_turmas: Utilizado para filtrar registro de turmas na página de professores e turmas.
Route::any('/filtros_professor_turmas/{id}','Ferramentas\FiltersController@filtros_professor_turmas')->name('filtros_professor_turmas')->middleware('Authenticate');

//Rota professor_procurar_aluno: Utilizado para filtrar registro de pessoas na página de alunos do professor.
Route::any('/professor_meus_alunos/procurar/', 'Ferramentas\FiltersController@professor_procurar_aluno')->name('professor_procurar_aluno')->middleware('Authenticate');

//Rota professor_procurar: Utilizado para filtrar registro de professores na página de registros de professores.
Route::any('/procurar/professor','Ferramentas\FiltersController@professor_procurar')->name('professor_procurar')->middleware('AdministracaoEProfessor', 'Authenticate');

//FILTRO DE PESSOAS
//Rota pessoas_procurar: Utilizado para filtrar registro de pessoas na página de registros de pessoas.
Route::any('/procurar/pessoas','Ferramentas\FiltersController@pessoas_procurar')->name('pessoas_procurar')->middleware('AdministracaoEProfessor', 'Authenticate');

//FILTRO DE ANAMNESES
//Rota anamneses_procurar: Utilizado para filtrar registro de pessoas na página de registros de anamneses.
Route::any('/procurar/anamneses','Ferramentas\FiltersController@anamnese_procurar')->name('anamnese_procurar')->middleware('AdministracaoEProfessor', 'Authenticate');

//FILTRO DE DOENÇAS
//Rota doencas_procurar: Utilizado para filtrar registro de pessoas na página de registros de doenças.
Route::any('/procurar/doencas', 'Ferramentas\FiltersController@doencas_procurar')->name('doencas_procurar')->middleware('AdministracaoEProfessor', 'Authenticate');

//FILTRO DE TURMAS
//Rota turmas_procurar: Utilizado para filtrar registro de pessoas na página de registros de turmas.
Route::any('/procurar/turmas','Ferramentas\FiltersController@turmas_procurar')->name('turmas_procurar')->middleware('AdministracaoEProfessor', 'Authenticate');

//FILTRO DE NÚCLEOS
//Rota nucleos_procurar: Utilizado para filtrar registro de pessoas na página de registros de nÚcleos.
Route::any('/procurar/nucleos','Ferramentas\FiltersController@nucleos_procurar')->name('nucleos_procurar')->middleware('AdministracaoEProfessor', 'Authenticate');

//FILTRO DE AUDITORIAS
//Rota audits_procurar: Utilizado para filtrar registro de pessoas na página de registros de auditorias.
Route::any('/procurar/audits','Ferramentas\FiltersController@audits_procurar')->name('audits_procurar')->middleware('AdministracaoEProfessor', 'Authenticate');