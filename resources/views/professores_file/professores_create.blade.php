@extends('layouts.app')
@section('breadcrumbs')
    <a href="{{route('home')}}" class="breadcrumb">Home</a>
    <a href="{{route('professor.index')}}" class="breadcrumb">Professores</a>
    <a href="{{route('professor.create')}}" class="breadcrumb">Criar</a>
@endsection
@section('title') Criar professor @endsection
@section('content')
    <div class="container">
        <div class="row">
            <form id="formulario" class="col s12" action="{{route('professor.store')}}" method="post">
                @csrf
                <h6>Registro do perfil do professor:</h6>
                <div class="row">
                    <div class="input-field col s12 m4">
                        <i class="material-icons prefix">account_circle</i>
                        <label for="nome">Nome: <span style="color: red;">*</span></label>
                        <input name="nome" id="nome" type="text" maxlength="100">
                    </div>
                    <div class="input-field col s12 m3">
                        <i class="material-icons prefix">child_friendly</i>
                        <label for="nascimento">Nascimento: <span style="color: red;">*</span></label>
                        <input name="nascimento" id="nascimento" type="text" class="datepicker" maxlength="10">
                    </div>
                    <div class="input-field col s12 m3">
                        <i class="material-icons prefix">recent_actors</i>
                        <label for="matricula">Matricula: <span style="color: red;">*</span></label>
                        <input onkeydown="javascript: fMasc(this, mNum)" name="matricula" id="matricula" type="text" maxlength="30">
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m5">
                        <i class="material-icons prefix">business</i>
                        <label for="cidade">Cidade: <span style="color: red;">*</span></label>
                        <input name="cidade" id="cidade" type="text" value="São Leopoldo" maxlength="70">
                    </div>
                    <div class="input-field col s12 m5">
                        <input type="text" id="bairro_selected" value="" hidden>
                        <a onclick="change_bairro()" class="waves-effect waves-light btn-floating right" style="margin-top: -10%; background-color: #039be5;"><i class="material-icons">cached</i></a>
                        <div id="div_bairro_list">
                            <i class="material-icons prefix">location_city</i>&emsp;&emsp; Bairros <span style="color: red;">*</span>
                            <select name="bairro" id="bairro_select" onchange="bairro_selected_enable()">
                                <option value="" selected disabled>Selecione o bairro</option>
                                @foreach ($bairroslist as $bairro)
                                    <option value="{{$bairro}}">{{$bairro}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div id="div_bairro_string" hidden>
                            <i class="material-icons prefix">location_city</i>
                            <label for="string_bairro">Bairro: <span style="color: red;">*</span></label>
                            <input id="string_bairro" name="string_bairro" type="text" maxlength="70">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m5">
                        <i class="material-icons prefix">confirmation_number</i>
                            <label for="rua">Rua: <span style="color: red;">*</span></label>i>
                        <input name="rua" id="rua" type="text" maxlength="70">
                    </div>
                    <div class="input-field col s12 m5">
                        <i class="material-icons prefix">explore</i>
                        <label for="cep">CEP: <span style="color: red;">*</span></label>
                        <input onkeydown="javascript: fMasc(this, mCEP)" name="cep" id="cep" type="text" maxlength="10">
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m5">
                        <i class="material-icons prefix">location_on</i>
                        <label for="numero_endereco">Número: <span style="color: red;">*</span></label>
                        <input onkeydown="javascript: fMasc(this, mNum)" name="numero_endereco" id="numero_endereco" type="number" maxlength="5">
                    </div>
                    <div class="input-field col s12 m5">
                        <i class="material-icons prefix">location_on</i>
                        <label for="complemento">Complemento de endereço:</label>
                        <input name="complemento" id="complemento" type="text" maxlength="10">
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m5">
                        <i class="material-icons prefix">phone</i>
                        <label for="telephone">Telefone: <span style="color: red;">*</span></label>
                        <input onkeydown="javascript: fMasc(this, mTel)" name="telefone" id="telephone" type="tel" maxlength="16">
                    </div>
                    <div class="input-field col s12 m5">
                        <i class="material-icons prefix">email</i>
                        <label for="email">E-mail: <span style="color: red;">*</span></label>
                        <input name="email" id="email" type="email" maxlength="80">
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m5">
                        <i class="material-icons prefix">credit_card</i>
                        <label for="cpf">CPF: <span style="color: red;">*</span></label>
                        <input onkeydown="javascript: fMasc(this, mCPF)" name="cpf" id="cpf" type="text" maxlength="14">
                    </div>
                    <div class="input-field col s12 m5">
                        <i class="material-icons prefix">assignment_ind</i>
                        <label for="rg">RG: <span style="color: red;">*</span></label>
                        <input name="rg" id="rg" type="text" maxlength="13">
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m4">
                        <i class="material-icons prefix">school</i>
                        <label for="formacao">Formação: <span style="color: red;">*</span></label>
                        <input name="formacao" id="formacao" type="text" maxlength="30">
                    </div>
                    <div class="input-field col s12 m3">
                        <i class="material-icons prefix">book</i>
                        <label for="curso">Curso: <span style="color: red;">*</span></label>
                        <input name="curso" id="curso" type="text" maxlength="30">
                    </div>
                    <div class="input-field col s12 m3">
                        <i class="material-icons prefix">directions_bike</i>
                        <label for="cref">CREF: <span style="color: red;">*</span></label>
                        <input name="cref" id="cref" type="text" maxlength="30">
                    </div>
                </div>
                <br><br>
                <h6>Registro da conta:</h6>
                <div class="row">
                    <div class="input-field col s12 m5">
                        <i class="material-icons prefix">perm_contact_calendar</i>
                        <label for="name">Usuário: <span style="color: red;">*</span></label>
                        <input name="name" id="name" type="text" maxlength="30">
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m5">
                        <i class="material-icons prefix">lock_outline</i>
                        <label for="password">Senha: <span style="color: red;">*</span></label>
                        <input name="password" id="password" type="password" maxlength="30">
                    </div>
                    <div class="input-field col s12 m5">
                        <i class="material-icons prefix">lock</i>
                        <label for="confirm_password">Confirmação de senha: <span style="color: red;">*</span></label>
                        <input name="confirm_password" id="confirm_password" type="password" maxlength="30">
                    </div>
                </div>
                <div class="container">
                    <div class="input-field col s12 m3 right">
                        <button class="btn-floating btn-large waves-effect waves-light light-blue darken-1" type="submit" name="action">
                            <i class="large material-icons left">add</i>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="{{asset('js/validation/validation-professores/validation-professores-create.js')}}"></script>
@endsection