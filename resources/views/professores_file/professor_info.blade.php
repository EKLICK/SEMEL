@extends('layouts.app')
@section('breadcrumbs')
    <a href="{{route('professor.index')}}" class="breadcrumb">Professores</a>
    <a href="{{route('professor_info', $professor->id)}}" class="breadcrumb">Informações</a>
@endsection
@section('title') Informações de <?php $nomes = explode(' ',$professor->nome);?> {{$nomes[0]}} @endsection
@section('content')
    <div class="container right" style="margin-top: 3%;">
        <div class="row">
            <div class="col s6">
                <table class="centered">
                    <tr>
                        <td><h6>Nome:</h6></td>
                        <td><h6>{{$professor->nome}}</h6></td>
                    </tr>
                    <tr>
                        <td><h6>Matricula:</h6></td>
                        <td><h6>{{$professor->matricula}}</h6></td>
                    </tr>
                    <tr>
                        <td><h6>Telefone:</h5></td>
                        <td><h6>{{$professor->telefone}}</h6></td>
                    </tr>
                    <tr>
                        <td><h6>CPF:</h5></td>
                        <td><h6>{{$professor->cpf}}</h6></td>
                    </tr>
                    <tr>
                        <td><h6>RG:</h5></td>
                        <td><h6>{{$professor->rg}}</h6></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection