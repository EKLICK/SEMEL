@extends('layouts.app')

@section('breadcrumbs')
    <a href="{{route('professor.index')}}" class="breadcrumb">Professores</a>
    <a href="{{Route('professor.edit', $professorid)}}" class="breadcrumb">Alunos</a>
@endsection
@section('title') <h4>Alunos de: {{$turma->nome}}</h4> @endsection
@section('content')
    <div class="container z-depth-4">
        <div class="card-panel">
            <ul class="collapsible">
                <li>
                    <div class="collapsible-header"><i class="material-icons">location_searching</i>Filtros</div>
                    <div class="collapsible-body">
                        <form action="{{route('pessoas_procurar')}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="input-field col s6">
                                    <input placeholder="Nome" id="nome_search" type="text" class="validate" name="nome">
                                    <label for="nome_search">Nome da pessoa</label>
                                </div>
                                <div class="col s1"><label>Idade:</label></div>
                                <div class="input-field col s2">
                                    <input id="de_search" type="number" class="validate" name="de">
                                    <label for="de_search">De:</label>
                                </div>
                                <div class="input-field col s2">
                                    <input id="ate_search" type="number" class="validate" name="ate">
                                    <label for="ate_search">Até:</label>
                                </div>  
                            </div>
                            <div class="row">
                                <div class="input-field col s3">
                                    <input placeholder="RG" id="rg_search" type="text" class="validate" name=rg>
                                    <label for="rg_search">RG</label>
                                </div>
                                <div class="input-field col s3">
                                    <input placeholder="CPF" id="cpf_search" type="text" class="validate" name="cpf">
                                    <label for="cpf_search">CPF</label>
                                </div>
                                <div class="input-field col s3">
                                    <input placeholder="Bairro" id="bairro_search" type="text" class="validate" name="bairro">
                                    <label for="bairro_search">Bairro</label>
                                </div>
                                <div class="input-field col s3">
                                    <input placeholder="Telefone" id="telefone_search" type="text" class="validate" name="telefone">
                                    <label for="telefone_search">Telefone</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s1"><label>Sexo:</label></div>
                                <div class="input-field col s3">
                                    <p>
                                        <label>
                                            <input value="F" name="sexo" type="radio"/>
                                            <span>Feminino</span>
                                        </label>
                                    </p>
                                    <p>
                                        <label>
                                            <input value="M" name="sexo" type="radio"/>
                                            <span>Masculino</span>
                                        </label>
                                    </p>
                                </div>
                                <div class="input-field col s2"><label>Estado civil:</label></div>
                                <div class="input-field col s3">
                                    <p>
                                        <label>
                                            <input value="Casado" name="estado_civil" type="radio"/>
                                            <span>Casado</span>
                                        </label>
                                    </p>
                                    <p>
                                        <label>
                                            <input value="Solteiro" name="estado_civil" type="radio"/>
                                            <span>Solteiro</span>
                                        </label>
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s3">
                                    <button class="btn waves-effect waves-light" type="submit" name="action">Procurar
                                        <i class="material-icons right">search</i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>
            </ul>
            <table class="centered">
                <thead>
                    <tr>
                        <th>Nome do Alunos</th>
                        <th>Turmas vinculadas</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($turma->pessoas as $aluno)
                        <tr>
                            <td>{{$aluno->nome}}</td>
                            <td>{{$aluno->telefone}}</td>
                        </tr>
                    @endforeach 
                </tbody>
            </table>
        </div>
    </div>
@endsection