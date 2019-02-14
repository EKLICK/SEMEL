@extends('layouts.app')
@section('css.personalizado')@endsection
@section('breadcrumbs')
    <a href="{{route('nucleos.index')}}" class="breadcrumb">Nucleos</a>
    <a href="{{route('nucleos.create')}}" class="breadcrumb">Criar</a>
@endsection
@section('title') Criar núcleo @endsection
@section('content')
    @include('layouts.Sessoes.errors')
    <div class="container">
        <div class="row">
            <form class="col s12" action="{{route('nucleos.store')}}" method="post">
                @csrf
                <input type="text" name="cidade" value="São Leopoldo" hidden>
                <input type="number" name="inativo" value="1" hidden>
                <div class="row">
                    <div class="input-field col s11 m6">
                        <i class="material-icons prefix">filter_tilt_shift</i>
                        <input name="nome" id="icon_nome" type="text" class="validate" value="{{old('nome')}}" required>
                        <label for="icon_nome">Nome do núcleo:</label>
                    </div>
                    <div class="input-field col s11 m5">
                        <input type="text" name="string_bairro" id="string_bairro" value="{{old('string_bairro')}}" hidden>
                        <i class="material-icons prefix">location_city</i>&emsp;&emsp; Bairros
                        <select name="bairro" onchange="change_bairro_select()" id="bairro_select" required>
                            <option value="" selected disabled>Selecione o bairro</option>
                            @foreach ($bairroslist as $bairro)
                                <option value="{{$bairro}}" @if(old('string_bairro') == $bairro) selected @endif>{{$bairro}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s11 m6 xl5">
                        <i class="material-icons prefix">confirmation_number</i>
                        <input name="rua" id="icon_rua" type="text" class="validate" value="{{old('rua')}}" required>
                        <label for="icon_rua">Rua:</label>
                    </div>
                    <div class="input-field col s11 m5 xl2">
                        <i class="material-icons prefix">location_on</i>
                        <input onkeydown="javascript: fMasc(this, mNum)" name="numero_endereco" id="icon_numero_endereco" type="number" class="validate" value="{{old('numero_endereco')}}" required>
                        <label for="icon_numero_endereco">Número:</label>
                    </div>
                    <div class="input-field col s11 m6 xl4">
                        <i class="material-icons prefix">explore</i>
                        <input onkeydown="javascript: fMasc(this, mCEP)" name="cep" id="icon_cep" type="text" class="validate" value="{{old('cep')}}" required>
                        <label for="icon_cep">CEP:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s11 m6 xl5">
                        <i class="material-icons prefix">description</i>
                        <textarea name="descricao" id="icon_descricao" type="textarea" class="materialize-textarea">{{old('descricao')}}</textarea>
                        <label for="icon_descricao">Descrição do núcleo:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s11 m5 xl3">
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
                    <div class="input-field col s11 m3 right">
                        <button class="btn-floating btn-large waves-effect waves-light light-blue darken-1" type="submit" name="action">
                            <i class="large material-icons left">add</i>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection