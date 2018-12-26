@extends('layouts.app')
@section('breadcrumbs')
    <a href="{{route('register')}}" class="breadcrumb">Cadastrar</a>
@endsection
@section('title') <p style="color: black;">Cadastrar administrador</p> @endsection
@section('content')
    <div class="container" style="margin-top: 3%;">
        <div class="card">
            <form class="col s12" action="{{route('professor.store')}}" method="post">
                @csrf
                <h6>Registro da conta:</h6>
                <div class="row">
                    <div class="input-field col s4">
                        <i class="material-icons prefix">perm_contact_calendar</i>
                        <input name="usuario" id="icon_usuario" type="password" class="validate">
                        <label for="icon_usuario">Usuário:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s4">
                        <i class="material-icons prefix">email</i>
                        <input name="email" id="icon_email" type="tel" class="validate" value="{{old('email')}}">
                        <label for="icon_email">E-mail:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s4">
                        <i class="material-icons prefix">lock_outline</i>
                        <input name="password" id="icon_lockout" type="password" class="validate">
                        <label for="icon_lockout">Senha:</label>
                    </div>
                    <div class="input-field col s4">
                        <i class="material-icons prefix">lock</i>
                        <input name="confirm_password" id="icon_lock" type="password" class="validate" >
                        <label for="icon_lock">Confirmar senha:</label>
                    </div>
                </div>
                <button style="margin-bottom: 2%;" class="btn waves-effect waves-light" type="submit" name="action">Enviar
                    <i class="material-icons right">send</i>
                </button>
            </form>
        </div>
    </div>
@endsection

