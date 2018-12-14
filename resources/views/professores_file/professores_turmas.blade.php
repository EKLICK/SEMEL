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
                    <div class="collapsible-header"><i class="material-icons">filter_list</i>Filtros</div>
                    <div class="collapsible-body">
                        <form action="{{route('filtros_professor_turmas', $professor->id)}}" method="POST">
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
                        <th>Núcleo pertencente</th>
                        @if(auth()->user()->admin_professor == 1)
                            <th>Estado</th>
                            <th>Vinculo</th>
                            <th>Mudar vinculo</th>
                        @else
                            <th>Estado</th>
                            <th>Limite</th>
                            <th>Ações</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($turmaslist as $turma)
                        <tr>
                            <td><p>{{$turma->nome}}</p></td>
                            <td><p>{{$turma->nucleo->nome}}</p> <a class="tooltipped" data-position="top" data-tooltip="Informações de {{$turma->nucleo->nome}}" href="{{route('nucleo_info', $turma->nucleo->id)}}"><i class="small material-icons" style="color: #039be5;">info_outline</i></a></td>
                            <td> 
                                <p>
                                    @if($turma->inativo == 0)
                                        @if($turma->nucleo->inativo == 0) Núcleo inativo
                                        @else Turma inativa @endif
                                    @else 
                                        @if($turma->nucleo->inativo == 0) Núcleo inativo
                                        @else Turma ativa @endif @endif
                                </p>
                                <i class="small material-icons" 
                                    @if($turma->inativo == 0 || $turma->nucleo->inativo == 0)  
                                        style="color: red;" 
                                    @else 
                                        style="color: green;" 
                                    @endif>sim_card_alert
                                </i>
                            </td>
                            @if(auth()->user()->admin_professor == 1)
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
                            @else
                                <td><p>{{count($turma->pessoas)}} / {{$turma->limite}}</p><i class="small material-icons" @if(count($turma->pessoas) >= $turma->limite) style="color: yellow;" @else style="color: green;" @endif>sim_card_alert</i></td>
                                <td>
                                    <a class="tooltipped" data-position="top" data-tooltip="Alunos da {{$turma->nome}}" href="{{route('professor_meus_alunos', [$professor->id,$turma->id])}}"><i class="small material-icons" style="color: #039be5;">group</i></a>
                                    <a class="tooltipped" data-position="top" data-tooltip="Informações de {{$turma->nome}}" href="{{route('turma_info', $turma->id)}}"><i class="small material-icons" style="color: #039be5;">info</i></a>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{$turmaslist->links()}}
        </div>
    </div>
@endsection