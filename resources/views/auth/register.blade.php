@extends('layouts.app')
@section('breadcrumbs')
    <a href="{{route('register')}}" class="breadcrumb">Cadastrar</a>
@endsection
@section('title') Cadastrar administrador @endsection
@section('content')
    <br><br>
    <div class="container">
        <div class="row">
            <form class="col s12" action="{{route('professor.store')}}" method="post">
                @csrf
                <div class="row">
                    <div class="input-field col s12 m5">
                        <i class="material-icons prefix">perm_contact_calendar</i>
                        <input name="usuario" id="icon_usuario" type="password" class="validate">
                        <label for="icon_usuario">Usuário:</label>
                    </div>
                    <div class="input-field col s12 m5">
                        <i class="material-icons prefix">email</i>
                        <input name="email" id="icon_email" type="tel" class="validate" value="{{old('email')}}">
                        <label for="icon_email">E-mail:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m5">
                        <i class="material-icons prefix">lock_outline</i>
                        <input name="password" id="icon_lockout" type="password" class="validate">
                        <label for="icon_lockout">Senha:</label>
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

