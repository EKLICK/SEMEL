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
                            <td><p>@if($user->admin_professor == 0) Administrador @else Professor @endif</p></td>
                            <td>
                                <a class="tooltipped" data-position="top" data-tooltip="Informações de {{$user->nick}}" href="{{Route('users.edit', $user->id)}}"><i class="small material-icons">edit</i></a>
                                <a class="tooltipped" data-position="top" data-tooltip="Informações de {{$user->nick}}" href="{{Route('doencas.edit', $user->id)}}"><i class="small material-icons">delete</i></a>
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

    <div id="modal1" class="modal">
        <form action="{{route('musicas.destroy', 'delete')}}" method="POST">
            @method('DELETE')
            @csrf
            <div class="modal-content">
                <h4>Deletar</h4>
                <p>Você tem certeza que deseja deletar a musica abaixo?</p>
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