@extends('layouts.app')

@section('content')
    <div class="container" style="width: 35%; height: 25%; margin-top: 5%;">
        <div class="row">
            <div class="col s12 14 offset-14">
                <form action="{{route('login')}}" method="post">
                    @csrf
                    <div class="card">
                        <div class="card-action" style="background-color: #039be5;">
                            <h3 style="color: white;">Fazer Login</h3>
                        </div>
                        <div class="card-content">
                            <div class="form-field">
                                <label for="identity"><h6>Usuario</h6></label>
                                <input type="text" id="identity" name="identity">
                            </div>
                            <br>
                            <div class="form-field">
                                <label for="password"><h6>Senha</h6></label>
                                <input type="password" id="password" name="password">
                            </div>
                            <br>
                            <div class="form-field center-align">
                                <button class="btn-large">Login</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @if(Session::get('mensagem'))
        <div class="center-align sessao" style="margin-top: 3%;">
            <div class="chip red lighten-2">
                {{Session::get('mensagem')}}
                <i class="close material-icons">close</i>
            </div>
        </div>
        {{Session::forget('mensagem')}}
    @endif
@endsection
