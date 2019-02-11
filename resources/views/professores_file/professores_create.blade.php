@extends('layouts.app')
@section('css.personalizado')@endsection
@section('breadcrumbs')
    <a href="{{route('professor.index')}}" class="breadcrumb">Professores</a>
    <a href="{{route('professor.create')}}" class="breadcrumb">Criar anamnese</a>
@endsection
@section('title') Criar professor @endsection
@section('content')
    <br><br>
    @if(isset($errors) && count($errors) > 0)
        @foreach($errors->all() as $error)
            <div style="margin-left: 15%; margin-top: 1%;">
                <div class="chip red lighten-2">
                    {{$error}}
                    <i class="close material-icons">close</i>
                </div>
            </div>
        @endforeach
    @endif
    <div class="container">
        <div class="row">
            <form class="col s12" action="{{route('professor.store')}}" method="post">
                @csrf
                <h6>Registro do perfil do professor:</h6>
                <div class="row">
                    <div class="input-field col s12 m4">
                        <i class="material-icons prefix">account_circle</i>
                        <input name="nome" id="nome" type="text" class="validate" value="{{old('nome')}}">
                        <label for="nome">Nome:</label>
                    </div>
                    <div class="input-field col s12 m3">
                        <i class="material-icons prefix">child_friendly</i>
                        <input name="nascimento" id="nascimento" type="text" class="datepicker validate" value="{{old('nascimento')}}">
                        <label for="nascimento">Nascimento:</label>
                    </div>
                    <div class="input-field col s12 m3">
                        <i class="material-icons prefix">recent_actors</i>
                        <input onkeydown="javascript: fMasc(this, mNum)" name="matricula" id="matricula" type="text" class="validate" value="{{old('matricula')}}">
                        <label for="matricula">Matricula:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m5">
                        <i class="material-icons prefix">business</i>
                        <input name="cidade" id="cidade" type="text" class="validate" @if(!is_null(old('cidade'))) value="{{old('cidade')}}" @else value="São leopoldo" @endif>
                        <label for="cidade">Cidade:</label>
                    </div>
                    <div class="input-field col s12 m5">
                        <a class="btn-floating right" style="margin-top: -10%; background-color: #039be5;" onclick="change_bairro()"><i class="material-icons">cached</i></a>
                        <div id="div_bairro_list" @if(!is_null(old('string_bairro'))) hidden @endif>
                            <i class="material-icons prefix">location_city</i>&emsp;&emsp; Bairros
                            <select name="bairro">
                                <option value="" selected disabled>Selecione o bairro</option>
                                @foreach ($bairroslist as $bairro)
                                    <option value="{{$bairro}}">{{$bairro}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div id="div_bairro_string" @if(is_null(old('string_bairro'))) hidden @endif>
                            <i class="material-icons prefix">location_city</i>
                            <input id="string_bairro" name="string_bairro" type="text" class="validate" value="{{old('string_bairro')}}">
                            <label for="string_bairro">Bairro:</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m5">
                        <i class="material-icons prefix">confirmation_number</i>
                        <input name="rua" id="rua" type="text" class="validate" value="{{old('rua')}}">
                        <label for="rua">Rua:</label>
                    </div>
                    <div class="input-field col s12 m5">
                        <i class="material-icons prefix">explore</i>
                        <input onkeydown="javascript: fMasc(this, mCEP)" name="cep" id="cep" type="text" class="validate" value="{{old('cep')}}">
                        <label for="cep">CEP:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m5">
                        <i class="material-icons prefix">location_on</i>
                        <input onkeydown="javascript: fMasc(this, mNum)" name="numero_endereco" id="numero_endereco" type="number" class="validate" value="{{old('numero_endereco')}}">
                        <label for="numero_endereco">Número:</label>
                    </div>
                    <div class="input-field col s12 m5">
                        <i class="material-icons prefix">location_on</i>
                        <input name="complemento" id="complemento" type="number" class="validate" value="{{old('complemento')}}">
                        <label for="complemento">Complemento de endereço:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m5">
                        <i class="material-icons prefix">phone</i>
                        <input onkeydown="javascript: fMasc(this, mTel)" name="telefone" id="telephone" type="tel" class="validate" value="{{old('telefone')}}">
                        <label for="telephone">Telefone:</label>
                    </div>
                    <div class="input-field col s12 m5">
                        <i class="material-icons prefix">email</i>
                        <input name="email" id="email" id="email" type="tel" class="validate" value="{{old('email')}}">
                        <label for="email">E-mail:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m5">
                        <i class="material-icons prefix">credit_card</i>
                        <input onkeydown="javascript: fMasc(this, mCPF)" name="cpf" id="cpf" type="text" class="validate" value="{{old('cpf')}}">
                        <label for="cpf">CPF:</label>
                    </div>
                    <div class="input-field col s12 m5">
                        <i class="material-icons prefix">assignment_ind</i>
                        <input name="rg" id="rg" type="text" class="validate" value="{{old('rg')}}">
                        <label for="rg">RG:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m4">
                        <i class="material-icons prefix">school</i>
                        <input name="formacao" id="formacao" type="text" class="validate" value="{{old('formacao')}}">
                        <label for="formacao">Formação:</label>
                    </div>
                    <div class="input-field col s12 m3">
                        <i class="material-icons prefix">book</i>
                        <input name="curso" id="curso" type="text" class="validate" value="{{old('curso')}}">
                        <label for="curso">Curso:</label>
                    </div>
                    <div class="input-field col s12 m3">
                        <i class="material-icons prefix">directions_bike</i>
                        <input name="cref" id="cref" type="text" class="validate" value="{{old('cref')}}">
                        <label for="cref">CREF:</label>
                    </div>
                </div>
                <br><br>
                <h6>Registro da conta:</h6>
                <div class="row">
                    <div class="input-field col s12 m5">
                        <i class="material-icons prefix">perm_contact_calendar</i>
                        <input name="usuario" id="usuario" type="text" class="validate">
                        <label for="usuario">Usuário:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m5">
                        <i class="material-icons prefix">lock_outline</i>
                        <input name="password" id="lockout" type="password" class="validate">
                        <label for="lockout">Senha:</label>
                    </div>
                    <div class="input-field col s12 m5">
                        <i class="material-icons prefix">lock</i>
                        <input name="confirm_password" id="lock" type="password" class="validate" >
                        <label for="lock">Confirmar senha:</label>
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
@endsection