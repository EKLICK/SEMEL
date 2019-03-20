@extends('layouts.app')

@section('breadcrumbs')
    <a href="{{route
    
    
    
    
    
    
    ('home')}}" class="breadcrumb">Home</a>
    <a class="breadcrumb" href="{{route('users.index')}}">Administradores</a>
    <a class="breadcrumb" href="{{route('register')}}">Cadastrar</a>
@endsection
@section('title') Cadastrar administrador @endsection
@section('content')
    @include('layouts.Sessoes.errors')
    <div class="container">
        <div class="row">
            <form class="col s12" action="{{route('users.create')}}" method="post">
                @csrf
                <div class="row">
                    <div class="input-field col s12 m5">
                        <i class="material-icons prefix">person_pin</i>
                        <input name="nick" id="icon_nick" type="text" class="validate" value="{{old('nick')}}" maxlength="30" required>
                        <label for="icon_nick">Nome do administrador:</label>
                    </div>
                    <div class="input-field col s12 m5">
                        <i class="material-icons prefix">email</i>
                        <input name="email" id="icon_email" type="tel" class="validate" value="{{old('email')}}" maxlength="30" required>
                        <label for="icon_email">E-mail:</label>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="input-field col s12 m5">
                        <i class="material-icons prefix">perm_contact_calendar</i>
                        <input name="name" id="icon_name" type="password" class="validate" maxlength="30" required>
                        <label for="icon_name">Usuário:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m5">
                        <i class="material-icons prefix">lock_outline</i>
                        <input name="password" id="icon_lockout" type="password" class="validate" maxlength="30" required>
                        <label for="icon_lockout">Senha:</label>
                    </div>
                    <div class="input-field col s12 m5">
                        <i class="material-icons prefix">lock</i>
                        <input name="password_confirmation" id="icon_lock" type="password" class="validate" maxlength="30" required>
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

