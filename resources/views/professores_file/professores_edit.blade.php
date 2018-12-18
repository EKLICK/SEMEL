@extends('layouts.app')

@section('css.personalizado')@endsection
@section('breadcrumbs')
    <a href="{{route('professor.index')}}" class="breadcrumb">Professores</a>
    <a href="{{route('professor.edit', $professor->id)}}" class="breadcrumb">Editar</a>
@endsection
@section('title') Editar @if(auth()->user()->admin_professor == 1) {{$professor->nome}} @else sua conta @endif @endsection
@section('content')
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
    <div class="container" style="margin-top: 3%;">
        <div class="card">
            <div class="row">
                <form class="col s12" action="{{route('professor.update', $professor->id)}}" method="post">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <div class="row">
                        <div class="input-field col s5">
                            <i class="material-icons prefix">account_circle</i>
                            <input name="nome" id="icon_prefix" type="text" class="validate" value="@if(is_null(old('nome'))) {{$professor->nome}} @else {{old('nome')}} @endif">
                            <label for="icon_prefix">Nome:</label>
                        </div>
                        <div class="input-field col s3">
                            <i class="material-icons prefix">recent_actors</i>
                            <input onkeydown="javascript: fMasc(this, mNum)" name="matricula" id="icon_matricula" type="text" class="validate" value="@if(is_null(old('matricula'))) {{$professor->matricula}} @else {{old('matricula')}} @endif">
                            <label for="icon_matricula">Matricula:</label>
                        </div>
                        <div class="input-field col s3">
                            <i class="material-icons prefix">recent_actors</i>
                            <input name="nascimento" id="icon_nascimento" type="text" class="validate" value="@if(is_null(old('nascimento'))) {{$professor->nascimento}} @else {{old('nascimento')}} @endif">
                            <label for="icon_nascimento">Nascimento:</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s3">
                            <i class="material-icons prefix">location_city</i>
                            <input name="bairro" id="icon_bairro" type="text" class="validate" value="@if(is_null(old('bairro'))) {{$professor->bairro}} @else {{old('bairro')}} @endif">
                            <label for="icon_bairro">Bairro:</label>
                        </div>
                        <div class="input-field col s3">
                            <i class="material-icons prefix">confirmation_number</i>
                            <input name="rua" id="icon_rua" type="text" class="validate" value="@if(is_null(old('rua'))) {{$professor->rua}} @else {{old('rua')}} @endif">
                            <label for="icon_rua">Rua:</label>
                        </div>
                        <div class="input-field col s2">
                            <i class="material-icons prefix">location_on</i>
                            <input onkeydown="javascript: fMasc(this, mNum)" name="numero_endereco" id="icon_numero_endereco" type="number" class="validate" @if(is_null(old('numero_endereco'))) value="{{$professor->numero_endereco}}" @else value="{{old('numero_endereco')}}" @endif>
                            <label for="icon_numero_endereco">Número:</label>
                        </div>
                        <div class="input-field col s3">
                            <i class="material-icons prefix">location_city</i>
                            <input onkeydown="javascript: fMasc(this, mCEP)" name="cep" id="icon_cep" type="text" class="validate" value="@if(is_null(old('cep'))) {{$professor->cep}} @else {{old('cep')}} @endif">
                            <label for="icon_cep">CEP:</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s3">
                            <i class="material-icons prefix">phone</i>
                            <input onkeydown="javascript: fMasc(this, mTel)" name="telefone" id="icon_telephone" type="tel" class="validate" value="@if(is_null(old('telefone'))) {{$professor->telefone}} @else {{old('telefone')}} @endif">
                            <label for="icon_telephone">Telephone:</label>
                        </div>
                        <div class="input-field col s3">
                            <i class="material-icons prefix">email</i>
                            <input name="email" id="icon_email" type="tel" class="validate" value="@if(is_null(old('email'))) {{$user->email}} @else {{old('email')}} @endif">
                            <label for="icon_email">E-mail:</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s3">
                            <i class="material-icons prefix">credit_card</i>
                            <input onkeydown="javascript: fMasc(this, mCPF)" name="cpf" id="icon_cpf" type="text" class="validate" value="@if(is_null(old('cpf'))) {{$professor->cpf}} @else {{old('cpf')}} @endif">
                            <label for="icon_cpf">CPF:</label>
                        </div>
                        <div class="input-field col s3">
                            <i class="material-icons prefix">assignment_ind</i>
                            <input name="rg" id="icon_RG" type="text" class="validate" value="@if(is_null(old('rg'))) {{$professor->rg}} @else {{old('rg')}} @endif">
                            <label for="icon_RG">RG:</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s5">
                            <i class="material-icons prefix">book</i>
                            <input name="curso" id="icon_curso" type="text" class="validate" value="@if(is_null(old('curso'))) {{$professor->curso}} @else {{old('curso')}} @endif">
                            <label for="icon_curso">Curso:</label>
                        </div>
                        <div class="input-field col s4">
                            <i class="material-icons prefix">school</i>
                            <input name="formacao" id="icon_formacao" type="text" class="validate" value="@if(is_null(old('formacao'))) {{$professor->formacao}} @else {{old('formacao')}} @endif">
                            <label for="icon_formacao">Formação:</label>
                        </div>
                    </div>
                    <button style="margin-bottom: 2%;" class="btn waves-effect waves-light" type="submit" name="action">Editar
                        <i class="material-icons right">send</i>
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection