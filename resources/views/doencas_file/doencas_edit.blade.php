@extends('layouts.app')
@section('css.personalizado')@endsection
@section('breadcrumbs')
    <a href="{{route('home')}}" class="breadcrumb">Home</a>
    <a href="{{route('doencas.index')}}" class="breadcrumb">Doenças</a>
    <a href="{{route('doencas.edit', $doenca->id)}}" class="breadcrumb">Editar</a>
@endsection
@section('title') Editar {{$doenca->nome}} @endsection
@section('content')
    @include('layouts.Sessoes.errors')
    <div class="container edicao-criacao">
        <div class="row">
            <form class="col s12" action="{{route('doencas.update', $doenca->id)}}" method="post">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <div class="row">
                    <div class="input-field col s12 m8 l4">
                        <i class="material-icons prefix">new_releases</i>
                        <input name="nome" id="icon_prefix" type="text" class="validate" value="{{$doenca->nome}}" maxlength="30" required>
                        <label for="icon_prefix">Nome:</label>
                    </div>
                    <div class="input-field col s12 m8 l4">
                        <i class="material-icons prefix">description</i>
                        <textarea name="descricao" id="descricao" class="materialize-textarea" maxlength="100" required>{{$doenca->descricao}}</textarea>
                        <label for="descricao">Observação</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m3">
                        <button class="btn-floating btn-large waves-effect waves-light light-blue darken-1" type="submit" name="action">
                            <i class="large material-icons left">add</i>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection