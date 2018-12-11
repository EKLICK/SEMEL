@extends('layouts.app')
@section('breadcrumbs')
    <a href="{{route('nucleos.index')}}" class="breadcrumb">Núcleos</a>
    <a href="{{route('nucleo_info', $nucleo->id)}}" class="breadcrumb">Informações</a>
@endsection
@section('title') <h4>Informações do Núcleo</h4> @endsection
@section('content')
    <div class="container" style="margin-top: 3%;">
        <div class="row">
            <div class="col s12">
                <table class="centered">
                    <tr>
                        <td><h6>Nome:</h6></td>
                        <td><h6>{{$nucleo->nome}}</h6></td>
                    </tr>
                    <tr>
                        <td><h6>Bairro:</h6></td>
                        <td><h6>{{$nucleo->bairro}}</h6></td>
                    </tr>
                    <tr>
                        <td><h6>Rua:</h6></td>
                        <td><h6>{{$nucleo->rua}}</h6></td>
                    </tr>
                    <tr>
                        <td><h6>Numero de endereço:</h6></td>
                        <td><h6>{{$nucleo->numero_endereco}}</h6></td>
                    </tr>
                    <tr>
                        <td><h6>CEP:</h6></td>
                        <td><h6>{{$nucleo->cep}}</h6></td>
                    </tr>
                    <tr>
                        <td><h6>Descrição:</h6></td>
                        <td><h6>{{$nucleo->descricao}}</h6></td>
                    </tr>
                    <tr>
                        <td><h6>Está inativo:</h6></td>
                        <td><h6>@if($nucleo->inativo == 1) Não @else Sim @endif</h6></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection