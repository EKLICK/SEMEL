@extends('layouts.app')
@section('css.personalizado')@endsection
@section('breadcrumbs')
    <a href="{{route('doencas.index')}}" class="breadcrumb">Doenças</a>
    <a href="{{route('doencas.create')}}" class="breadcrumb">Criar</a>
@endsection
@section('title') Criar doença @endsection
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
            <form class="col s12" action="{{route('doencas.store')}}" method="post">
                @csrf
                <div class="row">
                    <div class="input-field col s12 m4">
                        <i class="material-icons prefix">new_releases</i>
                        <input name="nome" id="icon_prefix" type="text" class="validate">
                        <label for="icon_prefix">Nome da doença:</label>
                    </div>
                    <div class="input-field col s12 m4">
                        <i class="material-icons prefix">description</i>
                        <textarea name="descricao" id="descricao" class="materialize-textarea"></textarea>
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