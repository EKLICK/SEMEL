@extends('layouts.app')

@section('breadcrumbs')
    <a href="{{route('professor_turmas', 1)}}" class="breadcrumb">Professor</a>
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
                        <form action="{{route('professor_procurar_aluno')}}" method="POST">
                            @csrf
                            <input type="text" name="professorid" value="{{$professorid}}" hidden>
                            <input type="text" name="idturma" value="{{$turma->id}}" hidden>
                            <div class="row">
                                <div class="input-field col s5">
                                    <i class="material-icons prefix">account_circle</i>
                                    <input id="nome_search" type="text" class="validate" name="nome">
                                    <label for="nome_search">Nome:</label>
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
                                <div class="input-field col s4">
                                    <i class="material-icons prefix">phone</i>
                                    <input name="telefone" id="icon_telephone" type="tel" class="validate">
                                    <label for="icon_telephone">Telephone:</label>
                                </div>
                                <div class="input-field col s1"></div>
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
                        <th>Data de nascimento</th>
                        <th>Telefone</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pessoaslist as $aluno)
                        <tr>
                            <td>{{$aluno->nome}}</td>
                            <td>{{$aluno->nascimento}}</td>
                            <td>{{$aluno->telefone}}</td>
                        </tr>
                    @endforeach 
                </tbody>
            </table>
            {{$pessoaslist->links()}}
        </div>
    </div>
@endsection