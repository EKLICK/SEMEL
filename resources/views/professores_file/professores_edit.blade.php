@extends('layouts.app')

@section('css.personalizado')@endsection
@section('breadcrumbs')
    <a href="{{route('home')}}" class="breadcrumb">Home</a>
    <a href="{{route('professor.index')}}" class="breadcrumb">Professores</a>
    <a href="{{route('professor.edit', $professor->id)}}" class="breadcrumb">Editar</a>
@endsection
@section('title') Editar <?php $nomes = explode(' ',$professor->nome);?> {{$nomes[0]}} @endsection
@section('content')
    @include('layouts.Sessoes.errors')
    <div class="container">
        <div class="row">
            <form class="col s12" action="{{route('professor.update', $professor->id)}}" method="post">
                @csrf
                <input type="text" id="id" name="id" value="{{$professor->id}}" hidden/>
                <input type="text" id="id" name="id_user" value="{{$professor->user_id}}" hidden/>
                <input type="hidden" name="_method" value="PUT">
                <div class="row">
                    <div class="input-field col s12 m4">
                        <i class="material-icons prefix">account_circle</i>
                        <input name="nome" id="nome" type="text" class="validate" value="@if(is_null(old('nome'))) {{$professor->nome}} @else {{old('nome')}} @endif" required>
                        <label for="nome">Nome:</label>
                    </div>
                    <div class="input-field col s12 m3">
                        <i class="material-icons prefix">child_friendly</i>
                        <input name="nascimento" id="nascimento" type="text" class="datepicker validate" value="@if(is_null(old('nascimento'))) {{$professor->nascimento}} @else {{old('nascimento')}} @endif" required>
                        <label for="nascimento">Nascimento:</label>
                    </div>
                    <div class="input-field col s12 m3">
                        <i class="material-icons prefix">recent_actors</i>
                        <input onkeydown="javascript: fMasc(this, mNum)" id="matricula" name="matricula" type="text" class="validate" value="@if(is_null(old('matricula'))) {{$professor->matricula}} @else {{old('matricula')}} @endif" required>
                        <label for="matricula">Matricula:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m5">
                        <i class="material-icons prefix">business</i>
                        <input name="cidade" id="bairro" type="text" class="validate" @if(!is_null(old('cidade'))) value="{{old('cidade')}}" @else value="{{$professor->cidade}}" @endif required>
                        <label for="bairro">Cidade:</label>
                    </div>
                    <div class="input-field col s12 m5">
                        <a class="btn-floating right light-blue darken-1" style="margin-top: -10%;" onclick="change_bairro()"><i class="material-icons">cached</i></a>
                        <div id="div_bairro_list" @if($professor->bairro != null || !is_null(old('string_bairro'))) hidden @endif>
                            <i class="material-icons prefix">location_city</i>&emsp;&emsp; Bairros
                            <select name="bairro" onchange="change_bairro_select()" id="bairro_select">
                                <option value="" selected disabled>Selecione o bairro</option>
                                @foreach ($bairroslist as $bairro)
                                    <option value="{{$bairro}}" @if(old('string_bairro') == $bairro) selected @endif>{{$bairro}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div id="div_bairro_string" @if(is_null(old('string_bairro')) && $professor->bairro == null) hidden @endif>
                            <i class="material-icons prefix">location_city</i>
                            <input id="string_bairro" name="string_bairro" type="text" class="validate" value="@if(is_null(old('string_bairro'))) {{$professor->bairro}} @else {{old('string_bairro')}} @endif">
                            <label for="string_bairro">Bairro:</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m5">
                        <i class="material-icons prefix">confirmation_number</i>
                        <input name="rua" id="rua" type="text" class="validate" value="@if(is_null(old('rua'))) {{$professor->rua}} @else {{old('rua')}} @endif" required>
                        <label for="rua">Rua:</label>
                    </div>
                    <div class="input-field col s12 m5">
                        <i class="material-icons prefix">explore</i>
                        <input onkeydown="javascript: fMasc(this, mCEP)" name="cep" id="cep" type="text" class="validate" value="@if(is_null(old('cep'))) {{$professor->cep}} @else {{old('cep')}} @endif" required>
                        <label for="cep">CEP:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m5">
                        <i class="material-icons prefix">location_on</i>
                        <input onkeydown="javascript: fMasc(this, mNum)" name="numero_endereco" id="numero_endereco" type="number" class="validate" @if(is_null(old('numero_endereco'))) value="{{$professor->numero_endereco}}" @else value="{{old('numero_endereco')}}" @endif required>
                        <label for="numero_endereco">Número:</label>
                    </div>
                    <div class="input-field col s12 m5">
                        <i class="material-icons prefix">location_on</i>
                        <input onkeydown="javascript: fMasc(this, mNum)" name="complemento" id="complemento" type="number" class="validate" value="@if(is_null(old('complemento'))) {{$professor->numero_endereco}} @else {{old('complemento')}} @endif">
                        <label for="complemento">Complemento de endereço:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m5">
                        <i class="material-icons prefix">phone</i>
                        <input onkeydown="javascript: fMasc(this, mTel)" name="telefone" id="icon_telephone" type="tel" class="validate" value="@if(is_null(old('telefone'))) {{$professor->telefone}} @else {{old('telefone')}} @endif" required>
                        <label for="telephone">Telephone:</label>
                    </div>
                    <div class="input-field col s12 m5">
                        <i class="material-icons prefix">email</i>
                        <input name="email" id="email" type="tel" class="validate" value="@if(is_null(old('email'))) {{$professor->email}} @else {{old('email')}} @endif" required>
                        <label for="email">E-mail:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m5">
                        <i class="material-icons prefix">credit_card</i>
                        <input onkeydown="javascript: fMasc(this, mCPF)" name="cpf" id="cpf" type="text" class="validate" value="@if(is_null(old('cpf'))) {{$professor->cpf}} @else {{old('cpf')}} @endif" required>
                        <label for="cpf">CPF:</label>
                    </div>
                    <div class="input-field col s12 m5">
                        <i class="material-icons prefix">assignment_ind</i>
                        <input name="rg" id="rg" type="text" class="validate" value="@if(is_null(old('rg'))) {{$professor->rg}} @else {{old('rg')}} @endif" required>
                        <label for="rg">RG:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m4">
                        <i class="material-icons prefix">school</i>
                        <input name="formacao" id="formacao" type="text" class="validate" value="@if(is_null(old('formacao'))) {{$professor->formacao}} @else {{old('formacao')}} @endif" required>
                        <label for="formacao">Formação:</label>
                    </div>
                    <div class="input-field col s12 m3">
                        <i class="material-icons prefix">book</i>
                        <input name="curso" id="curso" type="text" class="validate" value="@if(is_null(old('curso'))) {{$professor->curso}} @else {{old('curso')}} @endif" required>
                        <label for="curso">Curso:</label>
                    </div>
                    <div class="input-field col s12 m3">
                        <i class="material-icons prefix">directions_bike</i>
                        <input name="cref" id="cref" type="text" class="validate" value="@if(is_null(old('curso'))) {{$professor->cref}} @else {{old('cref')}} @endif" required>
                        <label for="cref">CREF:</label>
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