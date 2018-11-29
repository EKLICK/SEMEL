@extends('layouts.app')

@section('breadcrumbs')
    <a href="{{route('professor.index')}}" class="breadcrumb">Professores</a>
    <a href="{{Route('professor.edit', $professorid)}}" class="breadcrumb">Alunos</a>
@endsection
@section('title') <h4>Alunos de: {{$turma->nome}}</h4> @endsection
@section('content')
    <div class="container z-depth-4">
        <div class="card-panel">
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