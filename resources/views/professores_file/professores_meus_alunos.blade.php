@extends('layouts.app')

@section('content')
    <div class="section">
        <div class="container">
            <h4>Professores</h4>
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
                        @foreach ($alunos as $aluno)
                            <tr>
                                <td>{{$aluno->nome}}</td>
                                <td>
                                    @foreach ($aluno->turmas as $turmadoaluno)
                                        @foreach ($professor->turmas as $turmadoprofessor)
                                            @if($turmadoaluno->id == $turmadoprofessor->id)
                                                <td>{{$turmadoaluno->nome}}</td>
                                            @endif
                                        @endforeach
                                    @endforeach
                                </td>
                            </tr>
                        @endforeach 
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection