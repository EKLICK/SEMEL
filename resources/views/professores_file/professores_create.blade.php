@extends('layouts.app')
@section('css.personalizado')@endsection
@section('breadcrumbs')
    <a href="{{route('professor.index')}}" class="breadcrumb">Professores</a>
    <a href="{{route('professor.create')}}" class="breadcrumb">Criar anamnese</a>
@endsection
@section('title') Criar professor @endsection
@section('content')
    <div class="container" style="margin-top: 3%;">
        <div class="card">
            <div class="row">
                <form class="col s12" action="{{route('professor.store')}}" method="post">
                    @csrf
                    <h6>Registro do perfil do professor:</h6>
                    <div class="row">
                        <div class="input-field col s5">
                            <i class="material-icons prefix">account_circle</i>
                            <input name="nome" id="icon_prefix" type="text" class="validate">
                            <label for="icon_prefix">Nome:</label>
                        </div>
                        <div class="input-field col s3">
                            <i class="material-icons prefix">recent_actors</i>
                            <input name="matricula" id="icon_matricula" type="text" class="validate">
                            <label for="icon_matricula">Matricula:</label>
                        </div>
                        <div class="input-field col s3">
                            <i class="material-icons prefix">child_friendly</i>
                            <input id="nascimento" type="text" class="datepicker validate" name="nascimento">
                            <label for="nascimento">Nascimento:</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s3">
                            <i class="material-icons prefix">location_city</i>
                            <input name="bairro" id="icon_bairro" type="text" class="validate">
                            <label for="icon_bairro">Bairro:</label>
                        </div>
                        <div class="input-field col s3">
                            <i class="material-icons prefix">confirmation_number</i>
                            <input name="rua" id="icon_rua" type="text" class="validate">
                            <label for="icon_rua">Rua:</label>
                        </div>
                        <div class="input-field col s2">
                            <i class="material-icons prefix">location_on</i>
                            <input name="numero_endereco" id="icon_numero_endereco" type="number" class="validate">
                            <label for="icon_numero_endereco">Número:</label>
                        </div>
                        <div class="input-field col s3">
                            <i class="material-icons prefix">location_city</i>
                            <input onkeydown="javascript: fMasc(this, mCEP)" name="cep" id="icon_cep" type="text" class="validate">
                            <label for="icon_cep">CEP:</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s3">
                            <i class="material-icons prefix">phone</i>
                            <input onkeydown="javascript: fMasc(this, mTel)" name="telefone" id="icon_telephone" type="tel" class="validate">
                            <label for="icon_telephone">Telephone:</label>
                        </div>
                        <div class="input-field col s3">
                            <i class="material-icons prefix">email</i>
                            <input name="email" id="icon_email" type="tel" class="validate">
                            <label for="icon_email">E-mail:</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s3">
                            <i class="material-icons prefix">credit_card</i>
                            <input onkeydown="javascript: fMasc(this, mCPF)" name="cpf" id="icon_cpf" type="text" class="validate">
                            <label for="icon_cpf">CPF:</label>
                        </div>
                        <div class="input-field col s3">
                            <i class="material-icons prefix">assignment_ind</i>
                            <input name="rg" id="icon_RG" type="text" class="validate">
                            <label for="icon_RG">RG:</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s5">
                            <i class="material-icons prefix">book</i>
                            <input name="curso" id="icon_curso" type="text" class="validate">
                            <label for="icon_curso">Curso:</label>
                        </div>
                        <div class="input-field col s4">
                            <i class="material-icons prefix">school</i>
                            <input name="formacao" id="icon_formacao" type="text" class="validate">
                            <label for="icon_formacao">Formação:</label>
                        </div>
                    </div>
                    <h6>Registro da conta:</h6>
                    <div class="row">
                        <div class="input-field col s3">
                            <i class="material-icons prefix">perm_contact_calendar</i>
                            <input name="usuario" id="icon_usuario" type="password" class="validate">
                            <label for="icon_usuario">Usuário:</label>
                        </div>
                        <div class="input-field col s3">
                            <i class="material-icons prefix">lock_outline</i>
                            <input name="password" id="icon_lockout" type="password" class="validate">
                            <label for="icon_lockout">Senha:</label>
                        </div>
                        <div class="input-field col s3">
                            <i class="material-icons prefix">lock</i>
                            <input name="confirm_password" id="icon_lock" type="password" class="validate">
                            <label for="icon_lock">Confirmar senha:</label>
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