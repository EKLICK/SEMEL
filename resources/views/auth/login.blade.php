@extends('layouts.app')
@section('css.personalizado')
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
@endsection
@section('js.personalizado')
    <script type="text/javascript" src="{{asset('js/login.js')}}"></script>
@endsection

@section('content')
    <form class="login-form" action="{{route('login')}}" method="post">
        @csrf
        <div class="login-wrap">
            <div class="login-html">
                <h4>Login</h4>
                <div class="login-form">
                    <div class="group">
                        <label for="identity" class="label">Username</label>
                        <input name="identity" id="identity" type="text" class="input">
                    </div>
                    <div class="group">
                        <label for="senha" class="label">Password</label>
                        <input name="password" id="senha" type="password" class="input" data-type="password">
                    </div>
                    <div class="group">
                        <input type="submit" class="button" value="Entrar">
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
