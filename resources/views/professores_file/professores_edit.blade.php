@extends('layouts.app')

@section('css.personalizado')@endsection
@section('breadcrumbs')
    @if(auth()->user()->admin_professor == 1) 
        <a href="{{route('professor.index')}}" class="breadcrumb">Professores</a>
        <a href="{{route('professor.edit', $professor->id)}}" class="breadcrumb">Editar</a>
    @else
        <a href="{{route('professor.edit', 1)}}" class="breadcrumb">Mudar informações da conta</a>
    @endif
@endsection
@section('title') Editar @if(auth()->user()->admin_professor == 1) {{$professor->nome}} @else sua conta @endif @endsection
@section('content')
    <div class="container" style="margin-top: 3%;">
        <div class="card">
            <div class="row">
                <form class="col s12" action="{{route('professor.update', $professor->id)}}" method="post">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <div class="row">
                        <div class="input-field col s5">
                            <i class="material-icons prefix">account_circle</i>
                            <input name="nome" id="icon_prefix" type="text" class="validate" value="{{$professor->nome}}">
                            <label for="icon_prefix">Nome:</label>
                        </div>
                        <div class="input-field col s3">
                            <i class="material-icons prefix">recent_actors</i>
                            <input name="matricula" id="icon_matricula" type="text" class="validate" value="{{$professor->matricula}}">
                            <label for="icon_matricula">Matricula:</label>
                        </div>
                        <div class="input-field col s3">
                            <i class="material-icons prefix">recent_actors</i>
                            <input name="nascimento" id="icon_nascimento" type="text" class="validate" value="{{$professor->nascimento}}">
                            <label for="icon_nascimento">Nascimento:</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s3">
                            <i class="material-icons prefix">location_city</i>
                            <input name="bairro" id="icon_bairro" type="text" class="validate" value="{{$professor->bairro}}">
                            <label for="icon_bairro">Bairro:</label>
                        </div>
                        <div class="input-field col s3">
                            <i class="material-icons prefix">confirmation_number</i>
                            <input name="rua" id="icon_rua" type="text" class="validate" value="{{$professor->rua}}">
                            <label for="icon_rua">Rua:</label>
                        </div>
                        <div class="input-field col s2">
                            <i class="material-icons prefix">location_on</i>
                            <input name="numero_endereco" id="icon_numero_endereco" type="number" class="validate" value="{{$professor->numero_endereco}}">
                            <label for="icon_numero_endereco">Número:</label>
                        </div>
                        <div class="input-field col s3">
                            <i class="material-icons prefix">location_city</i>
                            <input onkeydown="javascript: fMasc(this, mCEP)" name="cep" id="icon_cep" type="text" class="validate" value="{{$professor->cep}}">
                            <label for="icon_cep">CEP:</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s3">
                            <i class="material-icons prefix">phone</i>
                            <input onkeydown="javascript: fMasc(this, mTel)" name="telefone" id="icon_telephone" type="tel" class="validate" value="{{$professor->telefone}}">
                            <label for="icon_telephone">Telephone:</label>
                        </div>
                        <div class="input-field col s3">
                            <i class="material-icons prefix">email</i>
                            <input name="email" id="icon_email" type="tel" class="validate" value="{{$useremail}}">
                            <label for="icon_email">E-mail:</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s3">
                            <i class="material-icons prefix">credit_card</i>
                            <input onkeydown="javascript: fMasc(this, mCPF)" name="cpf" id="icon_cpf" type="text" class="validate" value="{{$professor->cpf}}">
                            <label for="icon_cpf">CPF:</label>
                        </div>
                        <div class="input-field col s3">
                            <i class="material-icons prefix">assignment_ind</i>
                            <input name="rg" id="icon_RG" type="text" class="validate" value="{{$professor->rg}}">
                            <label for="icon_RG">RG:</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s5">
                            <i class="material-icons prefix">book</i>
                            <input name="curso" id="icon_curso" type="text" class="validate" value="{{$professor->curso}}">
                            <label for="icon_curso">Curso:</label>
                        </div>
                        <div class="input-field col s4">
                            <i class="material-icons prefix">school</i>
                            <input name="formacao" id="icon_formacao" type="text" class="validate" value="{{$professor->formacao}}">
                            <label for="icon_formacao">Formação:</label>
                        </div>
                    </div>
                    <button style="margin-bottom: 2%;" class="btn waves-effect waves-light" type="submit" name="action">Editar
                        <i class="material-icons right">send</i>
                    </button>
                </form>
            </div>
        </div>
        @if(auth()->user()->admin_professor == 0)
            <a href="{{route('editar_senha')}}" class="waves-effect waves-light btn-large">Mudar senha</a>
        @endif
    </div>
@endsection