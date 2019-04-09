@extends('layouts.app')

@section('breadcrumbs')
    <a href="{{route('home')}}" class="breadcrumb">Home</a>
    <a class="breadcrumb" href="{{route('users.index')}}">Administradores</a>
    <a class="breadcrumb" href="{{route('secretario_register')}}">Criar</a>
@endsection
@section('title') Registrar novo secretario @endsection
@section('content')
    @include('layouts.Sessoes.mensagem_green')
    <div class="container z-depth-4">
        <div class="card-panel">
            @include('layouts.Sessoes.errors')
            <div class="container">
                <div class="row">
                    <form class="col s12" action="{{route('secretario_store')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="input-field col s12 m5">
                                <i class="material-icons prefix">person_pin</i>
                                <input name="nick" id="icon_nick" type="text" class="validate" value="{{old('nick')}}" maxlength="30" required>
                                <label for="icon_nick">Nome do Secretario: <span style="color: red;">*</span></label>
                            </div>
                            <div class="input-field col s12 m5">
                                <i class="material-icons prefix">email</i>
                                <input name="email" id="icon_email" type="email" class="validate" value="{{old('email')}}" maxlength="30" required>
                                <label for="icon_email">E-mail: <span style="color: red;">*</span></label>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="input-field col s12 m5">
                                <i class="material-icons prefix">perm_contact_calendar</i>
                                <input name="name" id="icon_name" type="text" class="validate" maxlength="30" required>
                                <label for="icon_name">Usuário: <span style="color: red;">*</span></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12 m5">
                                <i class="material-icons prefix">lock_outline</i>
                                <input name="password" id="icon_lockout" type="password" class="validate" maxlength="30" required>
                                <label for="icon_lockout">Senha: <span style="color: red;">*</span></label>
                            </div>
                            <div class="input-field col s12 m5">
                                <i class="material-icons prefix">lock</i>
                                <input name="confirm_password" id="icon_lock" type="password" class="validate" maxlength="30" required>
                                <label for="icon_lock">Confirmar senha: <span style="color: red;">*</span></label>
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
        </div>
    </div>
@endsection