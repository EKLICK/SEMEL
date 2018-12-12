@extends('layouts.app')

@section('breadcrumbs')
    @if(auth()->user()->admin_professor == 1)
        <a href="{{route('professor.index')}}" class="breadcrumb">Professores</a>
    @endif
    <a href="{{route('professor_turmas', $professor->id)}}" class="breadcrumb">Turmas</a>
@endsection
@section('title') @if(auth()->user()->admin_professor == 1) <h4>Turmas</h4> @else <h4>Suas turmas</h4> @endif @endsection
@section('content')
    @if(Session::get('mensagem'))
        <div class="center-align sessao">
            <div class="chip green lighten-2">
                {{Session::get('mensagem')}}
                <i class="close material-icons">close</i>
            </div>
        </div>
        {{Session::forget('mensagem')}}
    @endif   
    <div class="container z-depth-4">
        <div class="card-panel">
            @if(Session::get('quant'))
                <div class="center-align quantmens">
                    <div class="chip light-blue accent-2 lighten-2">
                        {{Session::get('quant')}}
                        <i class="close material-icons">close</i>
                    </div>
                </div>
                {{Session::forget('quant')}}
            @endif
            <ul class="collapsible">
                <li>
                    <div class="collapsible-header"><i class="material-icons">location_searching</i>Filtros</div>
                    <div class="collapsible-body">
                        <form action="{{route('turmas_procurar')}}" method="POST">
                            @csrf
                            <input type="text" name="id" value="{{$professor->id}}" hidden>
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
                                    <label for="icon_horario_inicial">Horário:</label>
                                </div>
                                <div class="input-field col s3">
                                    <i class="material-icons prefix">hourglass_empty</i>
                                    <input name="horario_final" id="icon_horario_final" type="text" class="validate timepicker">
                                    <label for="icon_horario_final">Horário:</label>
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
                        <th>Quantidade de professores</th>
                        @if(auth()->user()->admin_professor == 1)
                            <th>Estado</th>
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
                                @if (!isset($professorTurmas))
                                    <td><p>Desvinculado</p><i class="small material-icons" style="color: red;" >sim_card_alert</i></td>
                                    <td><a href="{{Route('professores_turmas_vincular', [$professor->id, $turma->id])}}" class="waves-effect waves-light btn green" style="width: 160px;"><i class="material-icons right">send</i>Vincular</a></td>
                                @else
                                    @if(in_array($turma->id, $professorTurmas))
                                        <td><p>Vinculado</p><i class="small material-icons" style="color: green;" >sim_card_alert</i></td>
                                        <td><a href="{{Route('professores_turmas_desvincular', [$professor->id, $turma->id])}}" class="waves-effect waves-light btn red"><i class="material-icons right">send</i>Desvincular</a></td>
                                    @else
                                        <td><p>Desvinculado</p><i class="small material-icons" style="color: red;" >sim_card_alert</i></td>
                                        <td><a href="{{Route('professores_turmas_vincular', [$professor->id, $turma->id])}}" class="waves-effect waves-light btn green" style="width: 160px;"><i class="material-icons right">send</i>Vincular</a></td>
                                    @endif
                                @endif
                            </tr>
                        @endforeach 
                    @else
                        @foreach ($turmas as $turma)
                            <tr>
                                <td><p>{{$turma->nome}}</p></td>
                                <td><p>{{count($turma->professores)}}</p></td>
                                <td><p>{{count($turma->pessoas)."/".$turma->limite}}</p></td>
                                <td><a class="tooltipped" data-position="top" data-tooltip="Alunos da {{$turma->nome}}" href="{{Route('professor_meus_alunos', [$professor->id,$turma->id])}}"><i class="small material-icons" style="color: #039be5;">group</i></a></td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection