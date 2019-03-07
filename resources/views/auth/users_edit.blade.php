@extends('layouts.app')
@section('breadcrumbs')
    <a class="breadcrumb" href="{{route('users.index')}}">Administradores</a>
    <a class="breadcrumb" href="{{route('users.edit', $user->id)}}">Editar</a>
@endsection
@section('title') Editar administrador @endsection
@section('content')
    <div class="container">
        <div class="row">
            <form class="col s12" action="{{route('users.update', $user->id)}}" method="post">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <div class="row">
                    <div class="input-field col s12 m5">
                        <i class="material-icons prefix">person_pin</i>
                        <input name="nick" id="icon_nick" type="text" class="validate" value="@if(is_null(old('nick'))) {{$user->nick}} @else {{old('nick')}} @endif" required>
                        <label for="icon_nick">Nome do administrador:</label>
                    </div>
                    <div class="input-field col s12 m5">
                        <i class="material-icons prefix">email</i>
                        <input name="email" id="icon_email" type="tel" class="validate" value="@if(is_null(old('email'))) {{$user->email}} @else {{old('email')}} @endif" required>
                        <label for="icon_email">E-mail:</label>
                    </div>
                </div>
                <br><br><br>
                    <div class="card">
                        <div class="card-content ">
                            <h6>Caso queira trocar a senha ou usuário é necessário confirmar o usuário e senha antigas.</h6>
                        </div>
                    </div>
                <br>
                <div class="row">
                    <div class="input-field col s12 m5">
                        <i class="material-icons prefix">perm_contact_calendar</i>
                        <input name="usuario_antigo" id="icon_usuario_antigo" type="password" class="validate">
                        <label for="icon_usuario_antigo">Usuário antigo:</label>
                    </div>
                    <div class="input-field col s12 m5">
                        <i class="material-icons prefix">lock_outline</i>
                        <input name="password_antiga" id="icon_lockout_antiga" type="password" class="validate">
                        <label for="icon_lockout_antiga">Senha antiga:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m5">
                        <i class="material-icons prefix">lock_outline</i>
                        <input name="password" id="icon_lockout" type="password" class="validate">
                        <label for="icon_lockout">Nova Senha:</label>
                    </div>
                    <div class="input-field col s12 m5">
                        <i class="material-icons prefix">lock</i>
                        <input name="confirm_password" id="icon_lock" type="password" class="validate">
                        <label for="icon_lock">Confirmar senha:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="container">
                        <button class="btn-floating btn-large waves-effect waves-light light-blue darken-1" type="submit" name="action">
                            <i class="large material-icons left">add</i>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection