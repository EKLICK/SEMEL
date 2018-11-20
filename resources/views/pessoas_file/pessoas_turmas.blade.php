@extends('layouts.app')

@section('content')
    @if(Session::get('mensagem_green'))
        <div class="center-align">
            <div class="chip green lighten-2">
                {{Session::get('mensagem_green')}}
                <i class="close material-icons">close</i>
            </div>
        </div>
        {{Session::forget('mensagem_green')}}
    @endif
    @if(Session::get('mensagem_yellow'))
        <div class="center-align">
            <div class="chip yellow darken-2">
                {{Session::get('mensagem_yellow')}}
                <i class="close material-icons">close</i>
            </div>
        </div>
        {{Session::forget('mensagem_yellow')}}
    @endif

    <div class="white container" style="margin-top: 3%;">
        <table class="centered">
            <thead>
                <tr>
                    <th>Nome da turma</th>
                    <th>Limite de alunos</th>
                    <th>Vinculo</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($turmas as $turma)
                    <tr @if(count($turma->pessoas) >= $turma->limite) class="yellow darken-2" @endif>
                        <td><h5>{{$turma->nome}}</h4></td>
                        <td><h5>{{count($turma->pessoas)}} / {{$turma->limite}}</h5></td>
                        <td>
                            @if (!isset($pessoasTurmas))
                                <a href="{{Route('pessoas_turmas_vincular', [$pessoa->id, $turma->id])}}" class="waves-effect waves-light btn green" style="width: 160px;"><i class="material-icons right">send</i>Vincular</a>
                            @else
                                @if(in_array($turma->id, $pessoasTurmas))
                                    <a href="{{Route('pessoas_turmas_desvincular', [$pessoa->id, $turma->id])}}" class="waves-effect waves-light btn red"><i class="material-icons right">send</i>Desvincular</a>
                                @else
                                    <a href="{{Route('pessoas_turmas_vincular', [$pessoa->id, $turma->id])}}" class="waves-effect waves-light btn green" style="width: 160px;"><i class="material-icons right">send</i>Vincular</a>
                                @endif
                            @endif
                        </td>
                    </tr>
                @endforeach 
            </tbody>
        </table>
    </div>
@endsection