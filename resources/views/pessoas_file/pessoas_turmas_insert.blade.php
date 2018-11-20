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
                </tr>
            </thead>
            <tbody>
                @foreach ($turmaslist as $turma)
                    <tr>
                        <td><h5>{{$turma->nome}}</h4></td>
                        <td><h5>{{$turma->limite}}</h5></td>
                        <a href="" class="waves-effect waves-light btn"><i class="material-icons right">send</i>Vincular</a>
                    </tr>
                @endforeach 
            </tbody>
        </table>
    </div>
@endsection