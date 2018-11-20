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
                    <th>Limite de alunos</th>
                    <th>Vinculo</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($turmas as $turma)
                    <tr>
                        <td><h5>{{$turma->nome}}</h4></td>
                        <td><h5>{{$turma->limite}}</h5></td>
                        @foreach ($turma->pessoas as $pessoanaturma)
                            @if ($pessoanaturma->id == $pessoa->id)
                                <a href="" class="waves-effect waves-light btn green"><i class="material-icons right">send</i>Vincular</a>
                            @else
                                <a href="" class="waves-effect waves-light btn green"><i class="material-icons right">send</i>Desvincular</a>
                            @endif
                        @endforeach
                        <td>
                    </tr>
                @endforeach 
            </tbody>
        </table>
    </div>
@endsection