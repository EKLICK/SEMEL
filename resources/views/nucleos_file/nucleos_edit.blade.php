@extends('layouts.app')
@section('css.personalizado')@endsection
@section('breadcrumbs')
    <a href="{{route('nucleos.index')}}" class="breadcrumb">Nucleos</a>
    <a href="{{route('nucleos.edit', $nucleo->id)}}" class="breadcrumb">Editar</a>
@endsection
@section('title') Editar {{$nucleo->nome}} @endsection
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
            <form class="col s12" action="{{route('nucleos.update', $nucleo->id)}}" method="post">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <div class="row">
                    <div class="input-field col s12 m6">
                        <i class="material-icons prefix">filter_tilt_shift</i>
                        <input name="nome" id="icon_nome" type="text" class="validate" value="@if(is_null(old('nome'))) {{$nucleo->nome}} @else {{old('nome')}} @endif">
                        <label for="icon_nome">Nome do núcleo:</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <i class="material-icons prefix">location_city</i>&emsp;&emsp; Bairros
                        <select name="bairro">
                            <option value="" selected disabled>Selecione o bairro</option>
                            @foreach ($bairroslist as $bairro)
                                <option value="{{$bairro}}"  @if($bairro == $nucleo->bairro) selected @endif>{{$bairro}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 l5 xl6">
                        <i class="material-icons prefix">confirmation_number</i>
                        <input name="rua" id="icon_rua" type="text" class="validate" value="@if(is_null(old('rua'))) {{$nucleo->rua}} @else {{old('rua')}} @endif">
                        <label for="icon_rua">Rua:</label>
                    </div>
                    <div class="input-field col s12 l3 xl2">
                        <i class="material-icons prefix">location_on</i>
                        <input onkeydown="javascript: fMasc(this, mNum)" name="numero_endereco" id="icon_numero_endereco" type="number" class="validate" @if(is_null(old('numero_endereco'))) value="{{$nucleo->numero_endereco}}" @else {{old('numero_endereco')}} @endif>
                        <label for="icon_numero_endereco">Número:</label>
                    </div>
                    <div class="input-field col s12 l4 xl4">
                        <i class="material-icons prefix">explore</i>
                        <input onkeydown="javascript: fMasc(this, mCEP)" name="cep" id="icon_cep" type="text" class="validate" value="@if(is_null(old('cep'))) {{$nucleo->cep}} @else {{old('cep')}} @endif">
                        <label for="icon_cep">CEP:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 l6 xl6">
                        <i class="material-icons prefix">description</i>
                        <textarea name="descricao" id="icon_descricao" type="textarea" class="materialize-textarea">@if(is_null(old('descricao'))) {{$nucleo->descricao}} @else {{old('descricao')}} @endif</textarea>
                        <label for="icon_descricao">Descrição do núcleo:</label>
                    </div>
                    <div class="container">
                        <div class="input-field col s12 m3 right">
                            <button class="btn-floating btn-large waves-effect waves-light light-blue darken-1" type="submit" name="action">
                                <i class="large material-icons left">add</i>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection