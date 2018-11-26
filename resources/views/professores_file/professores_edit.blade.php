@extends('layouts.app')

    @section('css.personalizado')
    @endsection

    @section('content')

    <div class="container" style="margin-top: 3%;">
        <div class="card">
            <div class="row">
                <form class="col s12" action="{{route('professor.update', $professor->id)}}" method="post">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <div class="row">
                        <div class="input-field col s6">
                            <i class="material-icons prefix">account_circle</i>
                            <input name="nome" id="icon_prefix" type="text" class="validate" value="{{$professor->nome}}">
                            <label for="icon_prefix">Nome:</label>
                        </div>
                        <div class="input-field col s5">
                            <i class="material-icons prefix">recent_actors</i>
                            <input name="matricula" id="icon_matricula" type="text" class="validate" value="{{$professor->matricula}}">
                            <label for="icon_matricula">Matricula:</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <i class="material-icons prefix">phone</i>
                            <input name="matricula" id="icon_matricula" type="text" class="validate" value="{{$professor->telefone}}">
                            <label for="icon_telephone">Telephone:</label>
                        </div>
                        <div class="input-field col s5">
                            <i class="material-icons prefix">email</i>
                            <input name="matricula" id="icon_matricula" type="text" class="validate" value="{{$professor->email}}">
                            <label for="icon_email">E-mail:</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <i class="material-icons prefix">recent_actors</i>
                            <input name="matricula" id="icon_matricula" type="text" class="validate" value="{{$professor->cpf}}">
                            <label for="icon_matricula">CPF:</label>
                        </div>
                        <div class="input-field col s5">
                            <i class="material-icons prefix">recent_actors</i>
                            <input name="matricula" id="icon_matricula" type="text" class="validate" value="{{$professor->rg}}">
                            <label for="icon_matricula">RG:</label>
                        </div>
                    </div>
                    <button style="margin-bottom: 2%;" class="btn waves-effect waves-light" type="submit" name="action">Editar
                        <i class="material-icons right">send</i>
                    </button>
                </form>
            </div>
        </div>
        <a href="{{route('editar_senha')}}" class="waves-effect waves-light btn-large">Mudar senha</a>
    </div>
@endsection