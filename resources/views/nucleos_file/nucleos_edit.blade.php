@extends('layouts.app')
@section('css.personalizado')@endsection
@section('breadcrumbs')
    <a href="{{route('nucleos.index')}}" class="breadcrumb">Nucleos</a>
    <a href="{{route('nucleos.edit', $nucleo->id)}}" class="breadcrumb">Editar</a>
@endsection
@section('title') Editar {{$nucleo->nome}} @endsection
@section('content')
    @include('layouts.Sessoes.errors')
    <div class="container">
        <div class="row">
            <form class="col s12" action="{{route('nucleos.update', $nucleo->id)}}" method="post">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <div class="row">
                    <div class="input-field col s11 m6">
                        <i class="material-icons prefix">filter_tilt_shift</i>
                        <input name="nome" id="icon_nome" type="text" class="validate" value="@if(is_null(old('nome'))) {{$nucleo->nome}} @else {{old('nome')}} @endif" required>
                        <label for="icon_nome">Nome do núcleo:</label>
                    </div>
                    <div class="input-field col s11 m5">
                        <input type="text" name="string_bairro" id="string_bairro" value="{{old('string_bairro')}}" hidden>
                        <i class="material-icons prefix">location_city</i>&emsp;&emsp; Bairros
                        <select name="bairro" onchange="change_bairro_select()" id="bairro_select" required>
                            <option value="" selected disabled>Selecione o bairro</option>
                            @foreach ($bairroslist as $bairro)
                                <option value="{{$bairro}}" @if(is_null(old('string_bairro'))) @if($bairro == $nucleo->bairro) selected @endif @else @if(old('string_bairro') == $bairro) selected @endif @endif>{{$bairro}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s11 m6 xl5">
                        <i class="material-icons prefix">confirmation_number</i>
                        <input name="rua" id="rua" type="text" class="validate" value="@if(is_null(old('rua'))) {{$nucleo->rua}} @else {{old('rua')}} @endif" required>
                        <label for="rua">Rua:</label>
                    </div>
                    <div class="input-field col s11 m5 xl2">
                        <i class="material-icons prefix">location_on</i>
                        <input onkeydown="javascript: fMasc(this, mNum)" name="numero_endereco" id="numero_endereco" type="number" class="validate" @if(is_null(old('numero_endereco'))) value="{{$nucleo->numero_endereco}}" @else value="{{old('numero_endereco')}}" @endif required>
                        <label for="numero_endereco">Número:</label>
                    </div>
                    <div class="input-field col s11 m6 xl4">
                        <i class="material-icons prefix">explore</i>
                        <input onkeydown="javascript: fMasc(this, mCEP)" name="cep" id="cep" type="text" class="validate" value="@if(is_null(old('cep'))) {{$nucleo->cep}} @else {{old('cep')}} @endif" required>
                        <label for="cep">CEP:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s11 m6 xl5">
                        <i class="material-icons prefix">description</i>
                        <textarea name="descricao" id="descricao" type="textarea" class="materialize-textarea">@if(is_null(old('descricao'))) {{$nucleo->descricao}} @else {{old('descricao')}} @endif</textarea>
                        <label for="descricao">Descrição do núcleo:</label>
                    </div>
                    <div class="container">
                        <div class="input-field col s11 m3 right">
                            <button class="btn-floating btn-large waves-effect waves-light light-blue darken-1" type="submit" name="action">
                                <i class="large material-icons left">add</i>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection