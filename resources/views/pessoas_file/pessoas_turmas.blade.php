@extends('layouts.app')

@section('breadcrumbs')
    <a href="{{route('home')}}" class="breadcrumb">Pessoas</a>
    <a href="{{route('pessoas_turmas', $pessoa->id)}}" class="breadcrumb">turmas</a>
@endsection
@section('title') Turmas @endsection
@section('content')
    @if(Session::get('mensagem_green'))
        <div class="center-align sessao">
            <div class="chip green lighten-2">
                {{Session::get('mensagem_green')}}
                <i class="close material-icons">close</i>
            </div>
        </div>
        {{Session::forget('mensagem_green')}}
    @endif
    @if(Session::get('mensagem_yellow'))
        <div class="center-align sessao">
            <div class="chip yellow darken-2">
                {{Session::get('mensagem_yellow')}}
                <i class="close material-icons">close</i>
            </div>
        </div>
        {{Session::forget('mensagem_yellow')}}
    @endif
    <div class="container z-depth-4">
        <div class="card-panel">
            <ul class="collapsible">
                <li>
                    <div class="collapsible-header"><i class="material-icons">filter_list</i>Filtros</div>
                    <div class="collapsible-body">
                        <form action="{{route('turmas_procurar')}}" method="GET">
                            @csrf
                            <input type="text" name="id" value="{{-$pessoa->id}}" hidden>
                            <div class="row">
                                <div class="input-field col s5">
                                    <i class="material-icons prefix">group</i>
                                    <input name="nome" id="icon_nome" type="text" class="validate">
                                    <label for="icon_nome">Nome da turma:</label>
                                </div>
                                <div class="input-field col s3"></div>
                                <div class="input-field col s4">
                                    <i class="material-icons prefix">sim_card_alert</i>&emsp;&emsp; Núcleo ativo | inativo:
                                    <div style="margin-left: 30%;">
                                        <p>
                                            <label>
                                                <input value="1" name="inativo" type="radio"/>
                                                <span>Ativo</span>
                                            </label>
                                        </p>
                                        <p>
                                            <label>
                                                <input value="0" name="inativo" type="radio"/>
                                                <span>Inativo</span>
                                            </label>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s2">
                                    <i class="material-icons prefix">assignment</i>
                                    <input id="limite_search" type="number" class="validate" name="limite">
                                    <label for="limite_search">Limite:</label>
                                </div>
                                <div class="input-field col s3">
                                    <i class="material-icons prefix">hourglass_full</i>
                                    <input name="horario_inicial" id="icon_horario_inicial" type="text" class="validate timepicker">
                                    <label for="icon_horario_inicial">Horário Inicial:</label>
                                </div>
                                <div class="input-field col s3">
                                    <i class="material-icons prefix">hourglass_empty</i>
                                    <input name="horario_final" id="icon_horario_final" type="text" class="validate timepicker">
                                    <label for="icon_horario_final">Horário Final:</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s4">
                                    <i class="material-icons prefix">date_range</i>&emsp;&emsp; Dias da semana
                                    <select name="data_semanal[]" multiple>
                                        @foreach ($dias_semana as $dia)
                                            <option value="{{$dia}}">{{$dia}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="input-field col s4">
                                    <i class="material-icons prefix">filter_tilt_shift</i>&emsp;&emsp; Núcleos
                                    <select name="nucleo_id">
                                        <option value="" selected disabled>Selecione o núcleo</option>
                                        @foreach ($nucleoslist as $nucleo)
                                            <option value="{{$nucleo->id}}">{{$nucleo->nome}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s3">
                                    <button class="btn waves-effect waves-light" type="submit" name="action">Procurar
                                        <i class="material-icons right">search</i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>
            </ul>
            <table class="centered">
                <thead>
                    <tr>
                        <th>Nome da turma</th>
                        <th>Limite de alunos</th>
                        <th>Vinculo</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($turmaslist as $turma)
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
@endsection