@extends('layouts.app')

@section('breadcrumbs')
    <a href="{{route('home')}}" class="breadcrumb">Pessoas</a>
    <a href="{{route('pessoas_turmas', $pessoa->id)}}" class="breadcrumb">turmas</a>
@endsection
@section('title') Turmas <a href="#modalquantbloqueio" class="waves-effect waves-light btn blue modal-trigger btn-modal_ativar right">Quantidade limite <i class="material-icons right">https</i></a>@endsection
@section('content')
    <br><br>
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
    @if(Session::get('mensagem_red'))
        <div class="center-align sessao">
            <div class="chip red lighten-2">
                {{Session::get('mensagem_red')}}
                <i class="close material-icons">close</i>
            </div>
        </div>
        {{Session::forget('mensagem_red')}}
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
                        <form action="{{route('turmas_procurar')}}" method="GET">
                            @csrf
                            <input type="text" name="id" value="{{-$pessoa->id}}" hidden>
                            <div class="row">
                                <div class="input-field col s12 m5 l5">
                                    <i class="material-icons prefix">group</i>
                                    <input name="nome" id="icon_nome" type="text" class="validate">
                                    <label for="icon_nome">Nome da turma:</label>
                                </div>
                                <div class="input-field col s12 m5 l5">
                                    <i class="material-icons prefix">assignment</i>
                                    <input id="limite_search" type="number" class="validate" name="limite">
                                    <label for="limite_search">Limite:</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12 m5 l5">
                                    <i class="material-icons prefix">hourglass_full</i>
                                    <input name="horario_inicial" id="icon_horario_inicial" type="text" class="validate timepicker">
                                    <label for="icon_horario_inicial">Horário Inicial:</label>
                                </div>
                                <div class="input-field col s12 m5 l5">
                                    <i class="material-icons prefix">hourglass_empty</i>
                                    <input name="horario_final" id="icon_horario_final" type="text" class="validate timepicker">
                                    <label for="icon_horario_final">Horário Final:</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12 m5 l5">
                                    <i class="material-icons prefix">date_range</i>&emsp;&emsp; Dias da semana
                                    <select name="data_semanal[]" multiple>
                                        @foreach ($dias_semana as $dia)
                                            <option value="{{$dia}}">{{$dia}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="input-field col s12 m5 l5">
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
                                <div class="input-field col s12 m5 l5">
                                    <i class="material-icons prefix">beenhere</i>&emsp;&emsp; Opção de Página:
                                    <div style="margin-left: 30%;">
                                        <p>
                                            <label>
                                                <input value="3" name="pagina" type="radio"/>
                                                <span>Desvinculados</span>
                                            </label>
                                        </p>
                                        <p>
                                            <label>
                                                <input value="1" name="pagina" type="radio"/>
                                                <span>Ativos</span>
                                            </label>
                                        </p>
                                        <p>
                                            <label>
                                                <input value="2" name="pagina" type="radio"/>
                                                <span>Inativos</span>
                                            </label>
                                        </p>
                                    </div>
                                </div>
                                <div class="input-field col s12 m5 l5">
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
                        <th>Limite de alunos</th>
                        <th>Vinculo</th>
                        <th>Mudar vinculo</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($turmaslist as $turma)
                        <tr>
                            <td><p>{{$turma->nome}}</p></td>
                            <td><p>{{$turma->nucleo->nome}}</p> <a class="tooltipped" data-position="top" data-tooltip="Informações de {{$turma->nucleo->nome}}" href="{{route('nucleo_info', $turma->nucleo->id)}}"><i class="small material-icons">info_outline</i></a></td>
                            <td><p>{{$turma->quant_atual}} / {{$turma->limite}}</p><i class="small material-icons" @if($turma->qwuant_atual >= $turma->limite) style="color: yellow;" @else style="color: green;" @endif>sim_card_alert</i></td>
                            <td> 
                                <p>
                                    @if($turma->inativo == 2)
                                        @if($turma->nucleo->inativo == 2) Núcleo inativo
                                        @else Turma inativa @endif
                                    @else 
                                        @if($turma->nucleo->inativo == 2) Núcleo inativo
                                        @else Turma ativa @endif 
                                    @endif
                                </p>
                                <i class="small material-icons" 
                                    @if($turma->inativo == 2 || $turma->nucleo->inativo == 2)  
                                        style="color: red;" 
                                    @else 
                                        style="color: green;" 
                                    @endif>sim_card_alert
                                </i>
                            </td>
                            @php $ids = -1; @endphp
                            @if(isset($turma->pessoas)) 
                                @for ($i = 0; $i < count($turma->pessoas); $i++) 
                                    @if($turma->pessoas[$i]->id == $pessoa->id) @php $ids = $i; break; @endphp @endif
                                @endfor
                            @endif
                            @if ($ids == -1)
                                <td><p>Desvinculado</p><i class="small material-icons" style="color: red;" >sim_card_alert</i></td>
                                <td>
                                    <a class="waves-effect waves-light btn blue modal-trigger btn-modal_vincular" href="#modalidturmavincular"
                                        data-idusuario="{{$pessoa->id}}" data-idturma="{{$turma->id}}" data-nomeusuario="{{$pessoa->nome}}" data-nometurma="{{$turma->nome}}">
                                        <i class="material-icons right">lock_outline</i>Vincular
                                    </a>
                                </td>
                            @else
                                @if($turma->pessoas[$ids]->pivot->inativo == 1)
                                    <td><p>Ativado</p><i class="small material-icons" style="color: green;" >sim_card_alert</i></td>
                                    <td>
                                        <a class="waves-effect waves-light btn blue modal-trigger btn-modal_inativar" href="#modalidturmainativar"
                                            data-idusuario="{{$pessoa->id}}" data-idturma="{{$turma->id}}" data-nomeusuario="{{$pessoa->nome}}" data-nometurma="{{$turma->nome}}">
                                            <i class="material-icons right">speaker_notes_off</i>Inativar
                                        </a>
                                    </td>
                                @else
                                    <td><p>Inativado</p><i class="small material-icons" style="color: yellow;" >sim_card_alert</i></td>
                                    <td>
                                        <a class="waves-effect waves-light btn blue modal-trigger btn-modal_ativar" href="#modalidturmaativar"
                                            data-idusuario="{{$pessoa->id}}" data-idturma="{{$turma->id}}" data-nomeusuario="{{$pessoa->nome}}" data-nometurma="{{$turma->nome}}">
                                            <i class="material-icons right">speaker_notes</i>Ativar
                                        </a>
                                    </td>
                                @endif
                            @endif
                        </tr>
                    @endforeach 
                </tbody>
            </table>
            @if(isset($dataForm))
                {{$turmaslist->appends($dataForm)->links()}}
            @else
                {{$turmaslist->links()}}
            @endif
        </div>
    </div>

    <div id="modalidturmavincular" class="modal">
        <form action="{{route('pessoas_turmas_vincular')}}" method="POST">
            @csrf
            <input hidden class="validate" type="text" name="pessoa_id" id="id_modal_vincular">
            <input hidden class="validate" type="text" name="turma_id" id="id_turma_modal_vincular">
            <div class="modal-content">
                <h4>Vincular</h4>
                <h5 id="texto_id_vincular"></h5>
                <hr>
                <h5><b>Atenção:</b></h5>
                <div class="row">
                    <div class="input-field col s1">
                        <i class="medium material-icons" style="color: red;" >sim_card_alert</i>
                    </div>
                    <div class="input-field col s11">
                        <h6>Ao fazer o vinculo, a pessoa não poderá ser desvinculada, você terá opção somente de ativar e inativar a pessoa da turma!</h6>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s4">
                        <i class="material-icons prefix">fitness_center</i>&emsp;&emsp; A pessoa começará como:
                        <div style="margin-left: 20%;">
                            <p>
                                <label>
                                    <input value="1" name="inativo" type="radio" checked/>
                                    <span>Ativado</span>
                                </label>
                            </p>
                            <p>
                                <label>
                                    <input value="2" name="inativo" type="radio"/>
                                    <span>Inativado</span>
                                </label>
                            </p>
                        </div>
                    </div>
                    <div class="input-field col s7">
                        <i class="material-icons prefix">comment</i>&emsp;&emsp; Comentario do vinculo (opcional):
                        <textarea id="textarea1" class="materialize-textarea" name="comentario"></textarea>
                        <label for="textarea1"></label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn waves-effect waves-light green" type="submit" name="action">Vincular
                    <i class="material-icons right">send</i>
                </button>
            </div>
        </form>
    </div>

    <div id="modalidturmaativar" class="modal">
        <form action="{{route('pessoas_turmas_ativar_inativar')}}" method="POST">
            @csrf
            <input hidden class="validate" type="text" name="pessoa_id" id="id_modal_ativar">
            <input hidden class="validate" type="text" name="turma_id" id="id_turma_modal_ativar">
            <div class="modal-content">
                <h4>Ativar</h4>
                <h5 id="texto_id_ativar"></h5>
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
    
    <div id="modalidturmainativar" class="modal">
        <form action="{{route('pessoas_turmas_ativar_inativar')}}" method="POST">
            @csrf
            <input hidden class="validate" type="text" name="pessoa_id" id="id_modal_inativar">
            <input hidden class="validate" type="text" name="turma_id" id="id_turma_modal_inativar">
            <div class="modal-content">
                <h4>Inativar</h4>
                <h5 id="texto_id_inativar"></h5>
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
                <button class="btn waves-effect waves-light green" type="submit" name="action">Inativar
                    <i class="material-icons right">send</i>
                </button>
            </div>
        </form>
    </div>

    <div id="modalquantbloqueio" class="modal" style="width: 38%; height: 40%;">
        <div class="container">
            <div class="row">
                <p class="center"><b>Configuração de quantidade limite de permissão para adicionar um pessoa em turmas: </b></p>
                <hr>
                <h5><b>Quantidade possivel atual:&emsp;&emsp; {{$quantidade->quantidade}}</b></h5>
            </div>
            <br>
            <div class="row">
                <form action="{{route('define_quantidade')}}" action="GET">
                    @csrf
                    <input type="text" name="pessoa_id" value="{{$pessoa->id}}" hidden>
                    <div class="input-field col s6">
                            <i class="material-icons prefix">enhanced_encryption</i>
                            <input name="quantidade" id="quantidade" type="number" class="validate">
                            <label for="quantidade">Quantidade [bloqueio]: </label>
                    </div>
                    <div class="input-field col s4 right">
                        <button class="btn waves-effect waves-light light-blue darken-1" type="submit" name="action">Definir
                            <i class="material-icons right">send</i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection