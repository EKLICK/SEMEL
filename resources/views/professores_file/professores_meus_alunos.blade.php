@extends('layouts.app')

@section('content')
    <div class="section">
        <div class="container">
            <h4>Nome da turma: {{$turma->nome}}</h4>
            <div class="divider"></div>
        </div>
        
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
    </div>
@endsection