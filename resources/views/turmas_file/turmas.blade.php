@extends('layouts.app')
@section('breadcrumbs')
    <a href="{{route('home')}}" class="breadcrumb">Home</a> 
    <a href="{{route('turmas.index')}}" class="breadcrumb">Turmas</a>
@endsection
@section('title') Turmas registradas @endsection
@section('content')
    @include('layouts.Sessoes.mensagem_green')
    <div class="container z-depth-4">
        <div class="card-panel">
            @include('layouts.Sessoes.quant')
            <ul class="collapsible">
                <li>
                    <div class="collapsible-header"><i class="material-icons">filter_list</i>Filtros</div>
                    <div class="collapsible-body">
                        <form action="{{route('turmas_procurar')}}" method="GET">
                            @csrf
                            <input type="text" name="id" value="x" hidden>
                            <div class="row">
                                <div class="input-field col s10 xl5">
                                    <i class="material-icons prefix">group</i>
                                    <input name="nome" id="icon_nome" type="text" class="validate">
                                    <label for="icon_nome">Nome da turma:</label>
                                </div>
                                <div class="input-field col s10 xl5 right">
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
                                                <input value="2" name="inativo" type="radio"/>
                                                <span>Inativo</span>
                                            </label>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s10 xl2">
                                    <i class="material-icons prefix">assignment</i>
                                    <input id="limite_search" type="number" class="validate" name="limite">
                                    <label for="limite_search">Limite:</label>
                                </div>
                                <div class="input-field col s10 xl3">
                                    <i class="material-icons prefix">hourglass_full</i>
                                    <input name="horario_inicial" id="icon_horario_inicial" type="text" class="validate timepicker">
                                    <label for="icon_horario_inicial">Horário Inicial:</label>
                                </div>
                                <div class="input-field col s10 xl3">
                                    <i class="material-icons prefix">hourglass_empty</i>
                                    <input name="horario_final" id="icon_horario_final" type="text" class="validate timepicker">
                                    <label for="icon_horario_final">Horário Final:</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s10 xl4">
                                    <i class="material-icons prefix">date_range</i>&emsp;&emsp; Dias da semana
                                    <select name="data_semanal[]" multiple>
                                        @foreach ($dias_semana as $dia)
                                            <option value="{{$dia}}">{{$dia}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="input-field col s10 xl4">
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
                                    <button class="btn waves-effect waves-light light-blue darken-1" type="submit" name="action">Procurar
                                        <i class="material-icons right">search</i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>
            </ul>
            <table class="centered responsive-table highlight bordered">
                <thead>
                    <tr>
                        <th>Nome da turma</th>
                        <th>Núcleo pertencente</th>
                        <th>Estado</th>
                        @if(auth()->user()->id == 1)<th>Mudar estado</th>@endif
                        @if(auth()->user()->id == 1)<th>Ações</th>@else<th>Informações</th>@endif
                    </tr>
                </thead>
                <tbody>
                    @php $arrayturmas = []; @endphp
                    @foreach ($turmaslist as $turma)
                        @php array_push($arrayturmas, $turma->id); @endphp
                        <tr>
                            <td><p>{{$turma->nome}}</p></td>
                            <td><p>{{$turma->nucleo->nome}}</p> <a class="tooltipped" data-position="top" data-tooltip="Informações de {{$turma->nucleo->nome}}" href="{{route('nucleo_info', $turma->nucleo->id)}}"><i class="small material-icons">info_outline</i></a></td>
                            <td> 
                                <p>
                                    @if($turma->inativo == 2)
                                        @if($turma->nucleo->inativo == 2) Núcleo inativo
                                        @else Turma inativa @endif
                                    @else 
                                        @if($turma->nucleo->inativo == 2) Núcleo inativo
                                        @else Turma ativa @endif @endif
                                </p>
                                <i class="small material-icons" 
                                    @if($turma->inativo == 2 || $turma->nucleo->inativo == 2)  
                                        style="color: red;" 
                                    @else 
                                        style="color: green;" 
                                    @endif>sim_card_alert
                                </i>
                            </td>
                            @if(auth()->user()->id == 1)
                                @if ($turma->inativo == 2)
                                    <td>
                                        <a class="waves-effect waves-light btn blue modal-trigger" id="btn-modal_ativar_objeto" href="#modalobjetoativar"
                                            data-idobjeto="{{$turma->id}}" data-nomeobjeto="{{$turma->nome}}">
                                            <i class="material-icons right">lock_open</i>Ativar
                                        </a>
                                    </td>
                                @else
                                    <td>
                                        <a class="waves-effect waves-light btn blue modal-trigger" id="btn-modal_inativar_objeto" href="#modalobjetoinativar"
                                            data-idobjeto="{{$turma->id}}" data-nomeobjeto="{{$turma->nome}}">
                                            <i class="material-icons right">lock_outline</i>Inativar
                                        </a>
                                    </td>
                                @endif
                            @endif
                            <td>
                                <a class="tooltipped" data-position="top" data-tooltip="Informações de {{$turma->nome}}" href="{{route('turma_info', $turma->id)}}"><i class="small material-icons">info</i></a>
                                @if(auth()->user()->id == 1)<a class="tooltipped" data-position="top" data-tooltip="Editar {{$turma->nome}}" href="{{Route('turmas.edit', $turma->id)}}"><i class="small material-icons">edit</i></a>@endif
                            </td>
                        </tr>
                    @endforeach 
                </tbody>
            </table>
            {{$turmaslist->links()}}
            @if(auth()->user()->id == 1)
                <br>
                <div class="container">
                    <a class="tooltipped btn-floating btn-large waves-effect waves-light light-blue darken-1" data-position="top" data-tooltip="Adicionar turma" href="{{Route('turmas.create')}}"><i class="material-icons">add_to_queue</i></a>
                    &emsp;&emsp;
                    <a class="tooltipped btn-floating btn-large waves-effect waves-light light-blue darken-1" data-position="top" data-tooltip="Relatório de turmas" href="{{route('menu_turmas_pdf', json_encode($arrayturmas))}}"><i class="material-icons">assessment</i></a>
                </div>
            @endif
        </div>
    </div>
    @if(auth()->user()->id == 1)
        <div id="modalobjetoativar" class="modal">
            <div class="col s1.5 right">
                <a class="modal-close"><i class="material-icons medium" style="color: red;">cancel</i></a>
            </div>
            <form action="{{Route('turmas_ativar_inativar')}}" method="POST">
                @csrf
                <input class="validate" type="text" name="turma_id" id="id_modal_ativar" hidden>
                <div class="modal-content">
                    <h4>Ativar</h4>
                    <h5 id="texto_ativar"></h5>
                    <hr>
                    <br>
                    <div class="row">
                        <div class="input-field col s7">
                            <i class="material-icons prefix">comment</i>&emsp;&emsp; Comentario para Ativação (opcional):
                            <textarea id="textarea1" class="materialize-textarea" name="comentario"></textarea>
                            <label for="textarea1"></label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn waves-effect waves-light green" type="submit" name="action">Ativar
                        <i class="material-icons right">send</i>
                    </button>
                </div>
            </form>
        </div>
        
        <div id="modalobjetoinativar" class="modal">
            <div class="col s1.5 right">
                <a class="modal-close"><i class="material-icons medium" style="color: red;">cancel</i></a>
            </div>
            <form action="{{Route('turmas_ativar_inativar')}}" method="POST">
                @csrf
                <input class="validate" type="text" name="turma_id" id="id_modal_inativar" hidden>
                <div class="modal-content">
                    <h4>Inativar</h4>
                    <h5 id="texto_inativar"></h5>
                    <hr>
                    <br>
                    <div class="row">
                        <div class="input-field col s7">
                            <i class="material-icons prefix">comment</i>&emsp;&emsp; Comentario para Inativação (obrigatório):
                            <textarea id="textarea1" class="materialize-textarea" name="comentario" required></textarea>
                            <label for="textarea1"></label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn waves-effect waves-light green" type="submit" name="action">Ativar
                        <i class="material-icons right">send</i>
                    </button>
                </div>
            </form>
        </div>
    @endif
@endsection