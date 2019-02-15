@extends('layouts.app')
@section('breadcrumbs')
    <a href="{{route('nucleos.index')}}" class="breadcrumb">Nucleos</a>
@endsection
@section('title') Núcleos registrados @endsection
@section('content')
    @include('layouts.Sessoes.mensagem_red')
    @include('layouts.Sessoes.mensagem_green')
    <div class="container z-depth-4">
        <div class="card-panel">
            @include('layouts.Sessoes.quant')
            <ul class="collapsible">
                <li>
                    <div class="collapsible-header"><i class="material-icons">filter_list</i>Filtros</div>
                    <div class="collapsible-body">
                        <form action="{{route('nucleos_procurar')}}" method="GET">
                            @csrf
                            <div class="row">
                                <div class="input-field col s10 xl5">
                                    <i class="material-icons prefix">filter_tilt_shift</i>
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
                                <div class="input-field col s10 xl4">
                                    <i class="material-icons prefix">location_city</i>&emsp;&emsp; Bairros
                                    <select name="bairro">
                                        <option value="" selected disabled>Selecione o núcleo</option>
                                        @foreach ($bairroslist as $bairro)
                                            <option value="{{$bairro}}">{{$bairro}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="input-field col s10 xl3">
                                    <i class="material-icons prefix">confirmation_number</i>
                                    <input name="rua" id="icon_rua" type="text" class="validate">
                                    <label for="icon_rua">Rua:</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s10 xl4">
                                    <i class="material-icons prefix">location_on</i>
                                    <input name="numero_endereco" id="icon_numero_endereco" type="number" class="validate">
                                    <label for="icon_numero_endereco">Numero de endereço:</label>
                                </div>
                                <div class="input-field col s10 xl3">
                                    <i class="material-icons prefix">location_city</i>
                                    <input onkeydown="javascript: fMasc(this, mCEP)" name="cep" id="icon_cep" type="text" class="validate">
                                    <label for="icon_cep">CEP:</label>
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
                        <th>Endereço</th>
                        <th>Situação</th>
                        <th>Mudar estado</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($nucleoslist as $nucleo)
                        <tr>
                            <td>{{$nucleo->nome}}</td>
                            <td><p>{{$nucleo->bairro}} <br> {{$nucleo->rua}} <br> {{$nucleo->numero_endereco}}</p></td>
                            <td>@if($nucleo->inativo == 2) Inativo @else Ativo @endif <br><i class="small material-icons" @if($nucleo->inativo == 2) style="color: red;" @else style="color: green;" @endif>sim_card_alert</i></td>
                            @if ($nucleo->inativo == 2)
                                <td>
                                    <a class="waves-effect waves-light btn blue modal-trigger" id="btn-modal_ativar_objeto" href="#modalobjetoativar"
                                        data-idobjeto="{{$nucleo->id}}" data-nomeobjeto="{{$nucleo->nome}}">
                                        <i class="material-icons right">lock_open</i>Ativar
                                    </a>
                                </td>
                            @else
                                <td>
                                    <a class="waves-effect waves-light btn blue modal-trigger" id="btn-modal_inativar_objeto" href="#modalobjetoinativar"
                                        data-idobjeto="{{$nucleo->id}}" data-nomeobjeto="{{$nucleo->nome}}">
                                        <i class="material-icons right">lock_outline</i>Inativar
                                    </a>
                                </td>
                            @endif
                            <td>
                                <a class="tooltipped" data-position="top" data-tooltip="Informações de {{$nucleo->nome}}" href="{{route('nucleo_info', $nucleo->id)}}"><i class="small material-icons">info</i></a>
                                <a class="tooltipped" data-position="top" data-tooltip="Editar {{$nucleo->nome}}" href="{{Route('nucleos.edit', $nucleo->id)}}"><i class="small material-icons">edit</i></a>
                                <a class="tooltipped modal-trigger" data-position="top" data-tooltip="Deletar {{$nucleo->nome}}" id="btn-delete" data-id="{{$nucleo->id}}" data-nome="{{$nucleo->nome}}" href="#modaldelete"><i class="small material-icons">delete</i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @if(isset($dataForm))
                {{$nucleoslist->appends($dataForm)->links()}}
            @else
                {{$nucleoslist->links()}}
            @endif
            <br>
            <div class="container">
                <a class="tooltipped btn-floating btn-large waves-effect waves-light light-blue darken-1" data-position="top" data-tooltip="Adicionar núcleo" href="{{route('nucleos.create')}}"><i class="material-icons">add</i></a>
            </div>
        </div>
    </div>

    <div id="modaldelete" class="modal">
        <form action="{{route('nucleos.destroy', 'delete')}}" method="POST">
            @method('DELETE')
            @csrf
            <div class="modal-content">
                <h4>Deletar</h4>
                <p>Você tem certeza que deseja deletar o núcleo abaixo?</p>
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

    <div id="modalobjetoativar" class="modal">
            <form action="{{Route('nucleos_ativar_inativar')}}" method="POST">
                @csrf
                <input class="validate" type="text" name="nucleo_id" id="id_modal_ativar" hidden>
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
            <form action="{{Route('nucleos_ativar_inativar')}}" method="POST">
                @csrf
                <input class="validate" type="text" name="nucleo_id" id="id_modal_inativar" hidden>
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
                    <button class="btn waves-effect waves-light green" type="submit" name="action">Inativar
                        <i class="material-icons right">send</i>
                    </button>
                </div>
            </form>
        </div>
@endsection