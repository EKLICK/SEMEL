@extends('layouts.app')
@section('breadcrumbs')
    <a href="{{route('turmas.index')}}" class="breadcrumb">Turmas</a>
@endsection
@section('title') Turmas registradas @endsection
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
                                <div class="row">
                                    <div class="input-field col s5">
                                        <i class="material-icons prefix">group</i>
                                        <input name="nome" id="icon_nome" type="text" class="validate">
                                        <label for="icon_nome">Nome da turma:</label>
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
                        <th>Limite de alunos</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($turmaslist as $turma)
                        <tr>
                            <td><p>{{$turma->nome}}</p></td>
                            <td><p>{{count($turma->pessoas)}} / {{$turma->limite}}</p><i class="small material-icons" @if(count($turma->pessoas) >= $turma->limite) style="color: yellow;" @else style="color: green;" @endif>sim_card_alert</i></td>
                            <td>
                                <a class="tooltipped" data-position="top" data-tooltip="Editar {{$turma->nome}}" href="{{Route('turmas.edit', $turma->id)}}"><i class="small material-icons" style="color: #039be5;">edit</i></a>
                                <a class="tooltipped modal-trigger" data-position="top" data-tooltip="Deletar {{$turma->nome}}" id="btn-delete" data-id="{{$turma->id}}" data-nome="{{$turma->nome}}" href="#modaldelete"><i class="small material-icons" style="color: #039be5;">delete</i></a>
                            </td>
                        </tr>
                    @endforeach 
                </tbody>
            </table>
            {{$turmaslist->links()}}
            <a class="tooltipped" data-position="top" data-tooltip="Adicionar turma" href="{{Route('turmas.create')}}"><i class="medium material-icons" style="color: #039be5;">add_circle_outline</i></a>
        </div>
    </div>

    <div id="modaldelete" class="modal">
        <form action="{{Route('turmas.destroy', 'delete')}}" method="POST">
            @method('DELETE')
            @csrf
            <div class="modal-content">
                <h4>Deletar</h4>
                <p>Você tem certeza que deseja deletar o professor abaixo?</p>
                <div class="row">
                    <label for="name_delete">Nome:</label>
                    <div class="input-field col s12">
                        <input class="validate" hidden name="id" type="number" id="id_delete">
                        <input disabled class="validate" type="text" id="name_delete">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn red delete" type="submit">Sim</button>
            </div>
        </form>
    </div>
@endsection