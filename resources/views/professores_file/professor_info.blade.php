@extends('layouts.app')

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
                        <td><h6>E-mail:</h6></td>
                        <td><h6>{{$professor->email}}</h6></td>
                    </tr>
                </table>
            </div>
        </div>
        <div>
            <a href="" class="waves-effect waves-light btn" style="margin-top: 3%;">PDF</a>
        </div>
    </div>
@endsection