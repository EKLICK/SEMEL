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
            <h4>Turmas</h4>
            <div class="divider"></div>
        </div>
        
        <div class="container z-depth-4">
            <div class="card-panel">
                <table class="centered">
                    <thead>
                        <tr>
                            <th>Nome da turma</th>
                            <th>Quantidade de professores</th>
                            <th>Vinculo</th>
                        </tr>
                    </thead>
                    <tbody>
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
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection