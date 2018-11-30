@extends('layouts.app')
@section('breadcrumbs')
    <a href="{{route('home')}}" class="breadcrumb">Pessoas</a>
@endsection
@section('title') Pessoas registradas @endsection
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
            <table class="centered">
                <thead>
                    <tr>
                        <th>Nome da pessoa</th>
                        <th>Atualizações</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pessoaslist as $pessoa)
                        <tr>
                            <td><p>{{$pessoa->nome}}</p></td>
                            <td><p>{{$pessoa->anamneses->last()->ano}}</p><i class="small material-icons" @if($pessoa->anamneses->last()->ano != $ano) style="color: red;" @else style="color: green;"  @endif>sim_card_alert</i></td>
                            <td>
                                <a class="tooltipped" data-position="top" data-tooltip="Informações de {{$pessoa->nome}}" href="{{Route('pessoa_info', $pessoa->id)}}"><i class="small material-icons" style="color: #039be5;">info</i></a>
                                <a class="tooltipped" data-position="top" data-tooltip="Lista de anamneses de {{$pessoa->nome}}" href="{{Route('lista_anamnese', $pessoa->id)}}"><i class="small material-icons" style="color: #039be5;">description</i></a>
                                <a class="tooltipped" data-position="top" data-tooltip="Lista de turmas de {{$pessoa->nome}}" href="{{Route('pessoas_turmas', $pessoa->id)}}"><i class="small material-icons" style="color: #039be5;">group</i></a>
                                <a class="tooltipped" data-position="top" data-tooltip="Editar {{$pessoa->nome}}" href="{{Route('pessoas.edit', $pessoa->id)}}"><i class="small material-icons" style="color: #039be5;">edit</i></a>
                                <a class="tooltipped modal-trigger" data-position="top" data-tooltip="Deletar {{$pessoa->nome}}" id="btn-delete" data-id="{{$pessoa->id}}" data-nome="{{$pessoa->nome}}" href="#modaldelete"><i class="small material-icons" style="color: #039be5;">delete</i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{$pessoaslist->links()}}
            <a class="tooltipped" data-position="top" data-tooltip="Adicionar pessoa" href="{{route('pessoas.create')}}"><i class="medium material-icons" style="color: #039be5;">add_circle_outline</i></a>
        </div>
    </div>

    <div id="modaldelete" class="modal">
        <form action="{{route('pessoas.destroy', 'delete')}}" method="POST">
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