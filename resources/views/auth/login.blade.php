@extends('layouts.app')

@section('css.personalizado')
@endsection

@section('content')
    <div class="login-page">
        <div class="form">
            <form class="login-form" action="{{route('login')}}" method="post">
                @csrf
                <input name="identity" id="identity" type="text" class="validate" placeholder="usuario"/>
                <input name="password" id="senha" type="password" class="validate" placeholder="senha"/>
                <button type="submit">login</button>
                <p class="message">Não é registrado? <a href="{{route('register')}}">Crie uma conta</a></p>
            </form>
        </div>
    </div>
@endsection
