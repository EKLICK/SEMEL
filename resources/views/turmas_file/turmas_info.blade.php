@extends('layouts.app')
@section('breadcrumbs')
    @if (auth()->user()->admin_professor == 1)
        <a href="{{route('turmas.index')}}" class="breadcrumb">Turmas</a>
    @else
        <a href="{{route('professor_turmas', 1)}}" class="breadcrumb">Minhas turmas</a>
    @endif
    <a href="{{route('turma_info', $turma->id)}}" class="breadcrumb">Informações</a>
@endsection
@section('title') <h4>Informações da Turma</h4> @endsection
@section('content')
    <div class="container" style="margin-top: 3%;">
        <div class="row">
            <div class="col s12">
                <table class="centered">
                    <tr>
                        <td><h6>Nome:</h6></td>
                        <td><h6>{{$turma->nome}}</h6></td>
                    </tr>
                    <tr>
                        <td><h6>Limite:</h6></td>
                        <td><h6>{{$turma->limite}}</h6></td>
                    </tr>
                    <tr>
                        <td><h6>Está inativo:</h6></td>
                        <td><h6>@if($turma->inativo == 1) Não @else Sim @endif</h6></td>
                    </tr>
                    <tr>
                        <td><h6>Horario Inicial:<br>Horario Final: </h6></td>
                        <td><h6>{{$turma->horario_inicial}}<br>{{$turma->horario_final}}</h6></td>
                    </tr>
                    <tr>
                        <td><h6>Dias da semana:</h6></td>
                        <td>
                            @foreach ($dias as $dia)
                                <h6>{{$dia}}</h6>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <td><h6>Descrição:</h6></td>
                        <td><h6>{{$turma->descricao}}</h6></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection