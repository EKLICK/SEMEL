@extends('layouts.app')
@section('breadcrumbs')
    <a class="breadcrumb" href="{{route('users.index')}}">Administradores</a>
@endsection
@section('title') Usuários registrados @endsection
@section('content')
    @include('layouts.Sessoes.mensagem_green')
    <div class="container z-depth-4">
        <div class="card-panel">
            @include('layouts.Sessoes.quant')
            <table class="centered responsive-table highlight bordered">
                <thead>
                    <tr>
                        <th>Nome do Usuário</th>
                        <th>Email</th>
                        <th>Estado</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($userslist as $user)
                        <tr>
                            <td><p>{{$user->nick}}</p></td>
                            <td><p>{{$user->email}}</p></td>
                            <td><p>@if($user->admin_professor == 1) Administrador @else Professor @endif</p></td>
                            <td>
                                <a class="tooltipped" data-position="top" data-tooltip="Informações de {{$user->nick}}" href="{{Route('users.edit', $user->id)}}"><i class="small material-icons">edit</i></a>
                                <a id="btn_delete" class="tooltipped modal-trigger" data-position="top" data-tooltip="Delete {{$user->nick}}" 
                                   data-id="{{$user->id}}" data-name="{{$user->nick}}" data-tipo="{{$user->admin_professor}}" href="#modaldelete"><i class="small material-icons">delete</i></a>
                            </td>
                        </tr>
                    @endforeach 
                </tbody>
            </table>
            <br>
            <div class="container">
                <a class="tooltipped btn-floating btn-large waves-effect waves-light light-blue darken-1" data-position="top" data-tooltip="Adicionar Usuário" href="{{route('register')}}"><i class="material-icons">add</i></a>
            </div>
        </div>
    </div>

    <div id="modaldelete" class="modal">
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
                    <div class="input-field col s6">
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
@endsection