@extends('layouts.app')

    @section('css.personalizado')
    @endsection

    @section('content')

    <div class="container" style="margin-top: 3%;">
        <div class="card">
            <div class="row">
                <form class="col s12" action="{{route('professor.store')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="input-field col s6">
                            <i class="material-icons prefix">account_circle</i>
                            <input name="nome" id="icon_prefix" type="text" class="validate">
                            <label for="icon_prefix">Nome:</label>
                        </div>
                        <div class="input-field col s6">
                            <i class="material-icons prefix">recent_actors</i>
                            <input name="matricula" id="icon_matricula" type="text" class="validate">
                            <label for="icon_matricula">Matricula:</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <i class="material-icons prefix">phone</i>
                            <input name="telefone" id="icon_telephone" type="tel" class="validate">
                            <label for="icon_telephone">Telephone:</label>
                        </div>
                        <div class="input-field col s6">
                            <i class="material-icons prefix">email</i>
                            <input name="email" id="icon_email" type="tel" class="validate">
                            <label for="icon_email">E-mail:</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <i class="material-icons prefix">recent_actors</i>
                            <input name="cpf" id="icon_matricula" type="text" class="validate">
                            <label for="icon_matricula">CPF:</label>
                        </div>
                        <div class="input-field col s6">
                            <i class="material-icons prefix">recent_actors</i>
                            <input name="rg" id="icon_matricula" type="text" class="validate">
                            <label for="icon_matricula">RG:</label>
                        </div>
                    </div>
                    <button style="margin-bottom: 2%;" class="btn waves-effect waves-light" type="submit" name="action">Enviar
                        <i class="material-icons right">send</i>
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection