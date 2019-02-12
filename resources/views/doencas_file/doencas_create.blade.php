@extends('layouts.app')
@section('css.personalizado')@endsection
@section('breadcrumbs')
    <a href="{{route('doencas.index')}}" class="breadcrumb">Doenças</a>
    <a href="{{route('doencas.create')}}" class="breadcrumb">Criar</a>
@endsection
@section('title') Criar doença @endsection
@section('content')
    @include('layouts.Sessoes.errors')
    <div class="container">
        <div class="row">
            <form class="col s12" action="{{route('doencas.store')}}" method="post">
                @csrf
                <div class="row">
                    <div class="input-field col s12 m8 l4">
                        <i class="material-icons prefix">new_releases</i>
                        <input name="nome" id="nome" type="text" class="validate" value="{{old('nome')}}" required>
                        <label for="nome">Nome da doença:</label>
                    </div>
                    <div class="input-field col s12 m8 l4">
                        <i class="material-icons prefix">description</i>
                        <textarea name="descricao" id="descricao" class="materialize-textarea" required>{{old('descricao')}}</textarea>
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