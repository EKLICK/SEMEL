@extends('layouts.app')
@section('css.personalizado')@endsection
@section('breadcrumbs')
    <a href="{{route('doencas.index')}}" class="breadcrumb">Doenças</a>
    <a href="{{route('doencas.edit', $doenca->id)}}" class="breadcrumb">Editar</a>
@endsection
@section('title') Editar {{$doenca->nome}} @endsection
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
            <form class="col s12" action="{{route('doencas.update', $doenca->id)}}" method="post">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <div class="row">
                    <div class="input-field col s12 m4">
                        <i class="material-icons prefix">new_releases</i>
                        <input name="nome" id="icon_prefix" type="text" class="validate" value="{{$doenca->nome}}">
                        <label for="icon_prefix">Nome:</label>
                    </div>
                    <div class="input-field col s12 m4">
                        <i class="material-icons prefix">description</i>
                        <textarea name="descricao" id="descricao" class="materialize-textarea">{{$doenca->descricao}}</textarea>
                        <label for="descricao">Observação</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m3">
                        <button class="btn-floating btn-large waves-effect waves-light" type="submit" name="action">
                            <i class="large material-icons left">add</i>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection