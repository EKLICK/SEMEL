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
                        <div class="collapsible-header"><i class="material-icons">location_searching</i>Filtros</div>
                        <div class="collapsible-body">
                            <form action="{{route('nucleos_procurar')}}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col s2"><label>Nome do núcleo:</label></div>
                                    <div class="input-field col s4">
                                        <input id="nome_search" type="text" class="validate" name="nome">
                                        <label for="nome_search">Nome:</label>
                                    </div>
                                    <div class="col s2"><label>Bairro do núcleo:</label></div>
                                    <div class="input-field col s2">
                                        <input id="bairro_search" type="text" class="validate" name="bairro">
                                        <label for="bairro_search">Bairro:</label>
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
                        <th>Bairro</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($nucleoslist as $nucleo)
                            <td><p>{{$nucleo->nome}}</p></td>
                            <td><p>{{$nucleo->bairro}}</p></td>
                            <td>
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