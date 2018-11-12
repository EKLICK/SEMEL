@extends('layouts.app')

@section('content')
    <div class="login-page">
        <div class="form">
            <form class="login-form" action="{{route('register')}}" method="post">
                @csrf
                <input name="name" id="nome" type="text" class="validate" placeholder="usuario"/>
                <input name="email" id="email" type="email" class="validate" placeholder="endereço de email"/>
                <input name="password" id="senha" type="password" class="validate" placeholder="senha"/>
                <input name="password_confirmation" id="c_senha" type="password" class="validate" placeholder="confirmar senha"/>
                <button type="submit">Criar</button>
                <p class="message">Já possui uma conta? <a href="{{route('login')}}">Login</a></p>
            </form>
        </div>
    </div>
@endsection
