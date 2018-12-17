@extends('layouts.app')
@section('breadcrumbs')
    <a href="{{route('nucleos.index')}}" class="breadcrumb">Nucleos</a>
@endsection
@section('title') Núcleos registrados @endsection
@section('content')
    @if(Session::get('mensagem_red'))
        <div class="center-align sessao">
            <div class="chip red lighten-2">
                {{Session::get('mensagem_red')}}
                <i class="close material-icons">close</i>
            </div>
        </div>
        {{Session::forget('mensagem_red')}}
    @endif
    @if(Session::get('mensagem_green'))
        <div class="center-align sessao">
            <div class="chip green lighten-2">
                {{Session::get('mensagem_green')}}
                <i class="close material-icons">close</i> 
            </div>
        </div>
        {{Session::forget('mensagem_green')}}
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
                            <form action="{{route('nucleos_procurar')}}" method="GET">
                                @csrf
                                <div class="row">
                                    <div class="input-field col s4">
                                        <i class="material-icons prefix">filter_tilt_shift</i>
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
                                    <div class="row">
                                        <div class="input-field col s4">
                                            <i class="material-icons prefix">location_city</i>
                                            <input name="bairro" id="icon_bairro" type="text" class="validate">
                                            <label for="icon_bairro">Bairro:</label>
                                        </div>
                                        <div class="input-field col s3">
                                            <i class="material-icons prefix">confirmation_number</i>
                                            <input name="rua" id="icon_rua" type="text" class="validate">
                                            <label for="icon_rua">Rua:</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s4">
                                        <i class="material-icons prefix">location_on</i>
                                        <input name="numero_endereco" id="icon_numero_endereco" type="number" class="validate">
                                        <label for="icon_numero_endereco">Numero de endereço:</label>
                                    </div>
                                    <div class="input-field col s3">
                                        <i class="material-icons prefix">location_city</i>
                                        <input name="cep" id="icon_cep" type="text" class="validate">
                                        <label for="icon_cep">CEP:</label>
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
                        <th>Endereço</th>
                        <th>Estado</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($nucleoslist as $nucleo)
                            <td><p>{{$nucleo->nome}}</p></td>
                            <td><p>{{$nucleo->bairro}} <br> {{$nucleo->rua}} <br> {{$nucleo->numero_endereco}}</p></td>
                            <td>@if($nucleo->inativo == 0) Inativo @else Ativo @endif <br><i class="small material-icons" @if($nucleo->inativo == 0) style="color: red;" @else style="color: green;" @endif>sim_card_alert</i></td>
                            <td>
                                <a class="tooltipped" data-position="top" data-tooltip="Informações de {{$nucleo->nome}}" href="{{route('nucleo_info', $nucleo->id)}}"><i class="small material-icons" style="color: #039be5;">info</i></a>
                                <a class="tooltipped" data-position="top" data-tooltip="Turmas de {{$nucleo->nome}}" href="{{route('turmas_cadastradas', $nucleo->id)}}"><i class="small material-icons" style="color: #039be5;">people</i></a>
                                <a class="tooltipped" data-position="top" data-tooltip="Editar {{$nucleo->nome}}" href="{{Route('nucleos.edit', $nucleo->id)}}"><i class="small material-icons" style="color: #039be5;">edit</i></a>
                                <a class="tooltipped modal-trigger" data-position="top" data-tooltip="Deletar {{$nucleo->nome}}" id="btn-delete" data-id="{{$nucleo->id}}" data-nome="{{$nucleo->nome}}" href="#modaldelete"><i class="small material-icons" style="color: #039be5;">delete</i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{$nucleoslist->links()}}
            <a class="tooltipped" data-position="top" data-tooltip="Adicionar núcleo" href="{{route('nucleos.create')}}"><i class="medium material-icons" style="color: #039be5;">add_circle_outline</i></a>
        </div>
    </div>

    <div id="modaldelete" class="modal">
        <form action="{{route('nucleos.destroy', 'delete')}}" method="POST">
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