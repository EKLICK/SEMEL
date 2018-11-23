@extends('layouts.app')

@section('content')
    @if(Session::get('mensagem'))
        <div class="center-align">
            <div class="chip green lighten-2">
                {{Session::get('mensagem')}}
                <i class="close material-icons">close</i>
            </div>
        </div>
        {{Session::forget('mensagem')}}
    @endif

    <div class="section">
        <div class="container">
            @if(auth()->user()->admin_professor == 1)
                <h4>Turmas</h4>
            @else
                <h4>Suas turmas</h4>
            @endif
            <div class="divider"></div>
        </div>
        
        <div class="container z-depth-4">
            <div class="card-panel">
                <table class="centered">
                    <thead>
                        <tr>
                            <th>Nome da turma</th>
                            <th>Quantidade de professores</th>
                            @if(auth()->user()->admin_professor == 1)
                                <th>Vinculo</th>
                            @else
                                <th>Quantidade de alunos</th>
                                <th>Alunos da turma</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @if(auth()->user()->admin_professor == 1)
                            @foreach ($turmas as $turma)
                                <tr>
                                    <td><p>{{$turma->nome}}</p></td>
                                    <td><p>{{count($turma->professores)}}</p></td>
                                    <td>
                                        @if (!isset($professorTurmas))
                                            <a href="{{Route('professores_turmas_vincular', [$professor->id, $turma->id])}}" class="waves-effect waves-light btn green" style="width: 160px;"><i class="material-icons right">send</i>Vincular</a>
                                        @else
                                            @if(in_array($turma->id, $professorTurmas))
                                                <a href="{{Route('professores_turmas_desvincular', [$professor->id, $turma->id])}}" class="waves-effect waves-light btn red"><i class="material-icons right">send</i>Desvincular</a>
                                            @else
                                                <a href="{{Route('professores_turmas_vincular', [$professor->id, $turma->id])}}" class="waves-effect waves-light btn green" style="width: 160px;"><i class="material-icons right">send</i>Vincular</a>
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                            @endforeach 
                        @else
                            @foreach ($professor->turmas as $turma)
                                <tr>
                                    <td><p>{{$turma->nome}}</p></td>
                                    <td><p>{{count($turma->professores)}}</p></td>
                                    <td><p>{{count($turma->pessoas)."/".$turma->limite}}</p></td>
                                    <td><a href="{{Route('professor_meus_alunos', $turma->id)}}"><i class="small material-icons" style="color: #039be5;">group</i></a></td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection