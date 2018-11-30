@extends('layouts.app')

@section('css.personalizado')<link rel="stylesheet" href="{{asset('css/login.css')}}">@endsection
@section('js.personalizado')<script type="text/javascript" src="{{asset('js/login.js')}}"></script>@endsection
@section('breadcrumbs')
    <a href="{{route('register')}}" class="breadcrumb">Cadastrar</a>
@endsection
@section('title') <p style="color: black;">Cadastrar administrador</p> @endsection
@section('content')
    <div class="formulario">
        <form class="login-form" action="{{route('register')}}" method="post">
            @csrf
            <div class="login-wrap" style="min-height:650px;">
                <div class="login-html">
                    <h4>Cadastrar</h4>
                    <div class="login-form">
                        <div class="group">
                            <label for="identity" class="label">Username</label>
                            <input name="name" id="nome" type="text" class="validate input"/>
                        </div>
                        <div class="group">
                            <label for="identity" class="label">E-mail</label>
                            <input name="email" id="email" type="email" class="validate input"/>
                        </div>
                        <div class="group">
                            <label for="identity" class="label">Senha</label>
                            <input name="password" id="senha" type="password" class="validate input"/>
                        </div>
                        <div class="group">
                            <label for="identity" class="label">Confirmar Senha</label>
                            <input name="password_confirmation" id="c_senha" type="password" class="validate input"/>
                        </div>
                        <input value="1" name="admin_professor" type="text" hidden/>
                        <div class="group">
                            <input type="submit" class="button" value="Registrar">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

