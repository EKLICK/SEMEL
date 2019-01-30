@extends('layouts.app')
@section('css.personalizado')@endsection
@section('breadcrumbs')
    <a href="{{route('nucleos.index')}}" class="breadcrumb">Nucleos</a>
    <a href="{{route('nucleos.create')}}" class="breadcrumb">Criar</a>
@endsection
@section('title') Criar núcleo @endsection
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
    <div class="container edicao-criacao">
        <div class="row">
            <form class="col s12" action="{{route('nucleos.store')}}" method="post">
                @csrf
                <input type="text" name="cidade" value="São Leopoldo" hidden>
                <input type="number" name="inativo" value="1" hidden>
                <div class="row">
                    <div class="input-field col s4">
                        <i class="material-icons prefix">filter_tilt_shift</i>
                        <input name="nome" id="icon_nome" type="text" class="validate" value="{{old('nome')}}">
                        <label for="icon_nome">Nome do núcleo:</label>
                    </div>
                    <div class="input-field col s3"></div>
                    <div class="input-field col s3">
                        <i class="material-icons prefix">sim_card_alert</i>&emsp;&emsp; Núcleo ativo | inativo:
                        <div style="margin-left: 30%;">
                        <p>
                            <label>
                                <input value="1" name="inativo" type="radio" @if(old('nome') == 1) checked @endif/>
                                <span>Ativo</span>
                            </label>
                        </p>
                        <p>
                            <label>
                                <input value="2" name="inativo" type="radio" @if(old('nome') == 2) checked @endif/>
                                <span>Inativo</span>
                            </label>
                        </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s4">
                        <i class="material-icons prefix">location_city</i>&emsp;&emsp; Bairros
                        <select name="bairro">
                            <option value="" selected disabled>Selecione o bairro</option>
                            @foreach ($bairroslist as $bairro)
                                <option value="{{$bairro}}">{{$bairro}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s3">
                        <i class="material-icons prefix">confirmation_number</i>
                        <input name="rua" id="icon_rua" type="text" class="validate" value="{{old('rua')}}">
                        <label for="icon_rua">Rua:</label>
                    </div>
                    <div class="input-field col s2">
                        <i class="material-icons prefix">location_on</i>
                        <input onkeydown="javascript: fMasc(this, mNum)" name="numero_endereco" id="icon_numero_endereco" type="number" class="validate" value="{{old('numero_endereco')}}">
                        <label for="icon_numero_endereco">Número:</label>
                    </div>
                    <div class="input-field col s3">
                        <i class="material-icons prefix">explore</i>
                        <input onkeydown="javascript: fMasc(this, mCEP)" name="cep" id="icon_cep" type="text" class="validate" value="{{old('cep')}}">
                        <label for="icon_cep">CEP:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <i class="material-icons prefix">description</i>
                        <textarea name="descricao" id="icon_descricao" type="textarea" class="materialize-textarea">{{old('descricao')}}</textarea>
                        <label for="icon_descricao">Descrição do núcleo:</label>
                    </div>
                </div>
                <button style="margin-bottom: 2%;" class="btn waves-effect waves-light" type="submit" name="action">Enviar
                    <i class="material-icons right">send</i>
                </button>
            </form>
        </div>
    </div>
@endsection