@extends('layouts.app')
@section('css.personalizado')@endsection
@section('breadcrumbs')
    <a href="{{route('nucleos.index')}}" class="breadcrumb">Nucleos</a>
    <a href="{{route('nucleos.edit', $nucleo->id)}}" class="breadcrumb">Editar</a>
@endsection
@section('title') Editar {{$nucleo->nome}} @endsection
@section('content')
    <div class="container" style="margin-top: 3%;">
        <div class="card">
            <div class="row">
                <form class="col s12" action="{{route('nucleos.update', $nucleo->id)}}" method="post">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <div class="row">
                        <div class="input-field col s4">
                            <i class="material-icons prefix">filter_tilt_shift</i>
                            <input name="nome" id="icon_nome" type="text" class="validate" value="{{$nucleo->nome}}">
                            <label for="icon_nome">Nome da turma:</label>
                        </div>
                        <div class="input-field col s3"></div>
                        <div class="input-field col s3">
                            <i class="material-icons prefix">sim_card_alert</i>&emsp;&emsp; Núcleo ativo | inativo:
                            <div style="margin-left: 30%;">
                            <p>
                                <label>
                                    <input value="1" name="inativo" type="radio" @if($nucleo->inativo == 1) checked @endif/>
                                    <span>Ativo</span>
                                </label>
                            </p>
                            <p>
                                <label>
                                    <input value="0" name="inativo" type="radio" @if($nucleo->inativo == 0) checked @endif/>
                                    <span>Inativo</span>
                                </label>
                            </p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s4">
                            <i class="material-icons prefix">location_city</i>
                            <input name="bairro" id="icon_bairro" type="text" class="validate" value="{{$nucleo->bairro}}">
                            <label for="icon_bairro">Bairro:</label>
                        </div>
                        <div class="input-field col s3">
                            <i class="material-icons prefix">confirmation_number</i>
                            <input name="rua" id="icon_rua" type="text" class="validate" value="{{$nucleo->rua}}">
                            <label for="icon_rua">Rua:</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s4">
                            <i class="material-icons prefix">location_on</i>
                            <input name="numero_endereco" id="icon_numero_endereco" type="number" class="validate" value="{{$nucleo->numero_endereco}}">
                            <label for="icon_numero_endereco">Numero de endereço:</label>
                        </div>
                        <div class="input-field col s3">
                            <i class="material-icons prefix">location_city</i>
                            <input name="cep" id="icon_cep" type="text" class="validate" value="{{$nucleo->cep}}">
                            <label for="icon_cep">CEP:</label>
                        </div>
                    </div>
                    <div class="row">
                            <div class="input-field col s7">
                                <i class="material-icons prefix">description</i>
                                <textarea name="descricao" id="icon_descricao" type="textarea" class="materialize-textarea">{{$nucleo->descricao}}</textarea>
                                <label for="icon_descricao">Descrição do núcleo:</label>
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