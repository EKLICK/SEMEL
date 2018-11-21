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

    <div class="white container" style="margin-top: 3%;">
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
                        <td><h5>{{$turma->nome}}</h4></td>
                        <td><h5>{{count($turma->professores)}}</h5></td>
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
@endsection