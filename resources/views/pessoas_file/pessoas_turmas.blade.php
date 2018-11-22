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

    <div class="section">
        <div class="container">
            <h4>Turmas que {{$pessoa->nome}} está registrado(a)</h4>
            <div class="divider"></div>
        </div>
        <div class="container z-depth-4">
            <div class="card-panel">
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
                                <td><p>{{$turma->nome}}</p></td>
                                <td><p>{{count($turma->pessoas)}} / {{$turma->limite}}</p><i class="small material-icons" @if(count($turma->pessoas) >= $turma->limite) style="color: yellow;" @else style="color: green;" @endif>sim_card_alert</i></td>
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
        </div>
    </div>
@endsection