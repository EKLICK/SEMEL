@extends('layouts.app')

@section('breadcrumbs')
    <a href="{{route('home')}}" class="breadcrumb">Home</a>
    <a class="breadcrumb" href="{{route('users.index')}}">Administradores</a>
@endsection
@section('title') Usuários registrados 
    @if(auth()->user()->id == 1)<a href="#modalreset" class="waves-effect waves-light btn blue modal-trigger btn-modal_ativar right">&emsp;Inativar em lote <i class="material-icons right">access_time</i>@endif</a>
    <br>
    @if(auth()->user()->id == 1)<a href="#modalquantbloqueio" class="waves-effect waves-light btn blue modal-trigger btn-modal_ativar right">Quantidade limite<i class="material-icons right">https</i>@endif</a>
@endsection
@section('content')
    @include('layouts.Sessoes.mensagem_green')
    <div class="container z-depth-4">
        <div class="card-panel">
            @include('layouts.Sessoes.quant')
            <table class="centered responsive-table highlight bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome do Usuário</th>
                        <th>Email</th>
                        <th>Tipo de usuário</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($userslist as $user)
                        <tr>
                            <td><p>{{$user->id}}</p></td>
                            <td><p>{{$user->nick}}</p></td>
                            <td><p>{{$user->email}}</p></td>
                            <td><p>@if($user->admin_professor == 1) Administrador @else Professor @endif</p></td>
                            <td>
                                    <a class="tooltipped" data-position="top" data-tooltip="Informações de {{$user->name}}" href="{{Route('user_info', $user->id)}}"><i class="small material-icons">info</i></a>
                                <a class="tooltipped" data-position="top" data-tooltip="Informações de {{$user->nick}}" href="{{Route('users.edit', $user->id)}}"><i class="small material-icons">edit</i></a>
                                <a id="btn_delete" class="tooltipped modal-trigger" data-position="top" data-tooltip="Delete {{$user->nick}}" href="#modaldelete"
                                   data-id="{{$user->id}}" data-name="{{$user->nick}}" data-tipo="{{$user->admin_professor}}">
                                   <i class="small material-icons">delete</i></a>
                            </td>
                        </tr>
                    @endforeach 
                </tbody>
            </table>
            <br>
            <div class="container">
                <a class="tooltipped btn-floating btn-large waves-effect waves-light light-blue darken-1" data-position="top" data-tooltip="Adicionar Usuário" href="{{route('register')}}"><i class="material-icons">add_to_queue</i></a>
            </div>
        </div>
    </div>

    <div id="modaldelete" class="modal"  style="width: 30%;">
        <div class="col s1.5 right">
            <a class="modal-close"><i class="material-icons medium" style="color: red;">cancel</i></a>
        </div>
        <form action="{{route('users.destroy', 'delete')}}" method="POST">
            @method('DELETE')
            @csrf
            <input class="validate" name="id" type="number" id="id_delete" hidden>
            <div class="modal-content">
                <div class="row">
                    <h4>Deletar</h4>
                    <h6>Você tem certeza que deseja deletar o usuário abaixo?</h6>
                </div>
                <hr>
                <br>
                <div class="row">
                    <div class="input-field col s12">
                        <table>
                            <tr>
                                <td><b>Nome:</b></td>
                                <td><p><span id="name_delete"></span></p></td>
                            </tr>
                            <tr>
                                <td><b>Tipo de usuário:</b></td>
                                <td><p><span id="tipo_delete"></span></p></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn waves-effect waves-light blue" type="submit" name="action">Deletar
                    <i class="material-icons right">send</i>
                </button>
            </div>
        </form>
    </div>

    <div id="modalreset" class="modal" style="width: 55%; height: 45%;">
        <div class="col s1.5 right">
            <a class="modal-close"><i class="material-icons medium" style="color: red;">cancel</i></a>
        </div>
        <div class="container">
            <div class="row">
                <p class="center"><b>Ferramenta utilizada para retirar todas as pessoas de todas as turmas do sistema, confirmando esta requisição, não terá como voltar atrás: </b></p>
                <hr>
                <h5><b>Confirme o usuário e senha do administrador raiz:</b></h5>
            </div>
            <br>
            <div class="row">
                <form action="{{route('reset_sistema')}}" method="POST">
                    @csrf
                    <div class="input-field col s6">
                        <i class="material-icons prefix">perm_contact_calendar</i>
                        <input name="name" id="icon_name" type="text" class="validate"  required>
                        <label for="icon_name">Usuário:</label>
                    </div>
                    <div class="input-field col s6">
                        <i class="material-icons prefix">lock_outline</i>
                        <input name="password" id="icon_lockout" type="password" class="validate" required>
                        <label for="icon_lockout">Senha:</label>
                    </div>
                    <br>
                    <div class="input-field col s12 center">
                        <button class="btn waves-effect waves-light light-blue darken-1" type="submit" name="action">Resetar sistema
                            <i class="material-icons right">send</i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="modalquantbloqueio" class="modal" style="width: 38%; height: 40%;">
        <div class="col s1.5 right">
            <a class="modal-close"><i class="material-icons medium" style="color: red;">cancel</i></a>
        </div>
        <div class="container">
            <div class="row">
                <p class="center"><b>Configuração de quantidade limite de permissão para adicionar pessoas em turmas: </b></p>
                <hr>
                <h5><b>Quantidade possível atual:&emsp;&emsp; {{$quantidade->quantidade}}</b></h5>
            </div>
            <br>
            <div class="row">
                <form action="{{route('define_quantidade')}}" method="POST">
                    @csrf
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