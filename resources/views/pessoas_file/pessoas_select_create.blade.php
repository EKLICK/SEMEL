@extends('layouts.app')
@section('breadcrumbs')
    <a href="{{route('home')}}" class="breadcrumb">Pessoas</a>
    <a href="{{route('home')}}" class="breadcrumb">Pessoas</a>
@endsection
@section('title') Selecione o tipo de pessoas a ser cadastrada @endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col s6">
                <div class="card-panel">
                    <table>
                        <tr>
                            <td><img src="{{asset('/img/kid.png')}}"></td>
                            <td><a href="{{route('pessoas_menores')}}" class="waves-effect waves-light btn">Menor de idade</a></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="col s6">
                <div class="card-panel">
                    <table>
                        <tr>
                            <td><img src="{{asset('/img/man.png')}}"></td>
                            <td><a href="{{route('pessoas_maiores')}}" class="waves-effect waves-light btn">Maior de idade</a></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection