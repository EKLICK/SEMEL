@extends('layouts.app')

@section('css.personalizado')
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
@endsection

@section('js.personalizado')
    <script type="text/javascript" src="{{asset('js/login.js')}}"></script>
@endsection

@section('content')
    <form class="login-form" action="{{route('update_senha', $professor->id)}}" method="post">
        @csrf
        <input type="hidden" name="_method" value="PUT">
        <div class="login-wrap" style="min-height:500px;">
            <div class="login-html">
                <h4>Cadastrar</h4>
                <div class="login-form">
                    <input type="text" name="name" id="name" value="{{$professor->nome}}" hidden>
                    <input type="text" name="email" id="email" value="{{$professor->email}}" hidden>
                    <div class="group">
                        <label for="identity" class="label">Senha nova</label>
                        <input name="password" id="email" type="password" class="validate input"/>
                    </div>
                    <div class="group">
                        <label for="identity" class="label">Confirmar Senha nova</label>
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
@endsection

