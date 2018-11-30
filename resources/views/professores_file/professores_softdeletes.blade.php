@extends('layouts.app')
@section('breadcrumbs')
    <a href="{{route('professor.index')}}" class="breadcrumb">Professores</a>
    <a href="{{route('professor_softdeletes')}}" class="breadcrumb">Deletados</a>
@endsection
@section('title') Professores deletadas @endsection
@section('content')
    <div class="container z-depth-4">
        <div class="card-panel">
            <table class="centered">
                <thead>
                    <tr>
                        <th>Nome do professor</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($professoreslist as $professor)
                        <tr>
                            <td>{{$professor->nome}}</td>
                            <td>
                                <a class="tooltipped" data-position="top" data-tooltip="Informações de {{$professor->nome}}" href="{{Route('professor_info', $professor->id)}}"><i class="small material-icons" style="color: #039be5;">info</i></a>
                                <a class="tooltipped" data-position="top" data-tooltip="Restaurar {{$professor->nome}}" href="{{Route('professor_restore', $professor->id)}}"><i class="small material-icons" style="color: #039be5;">restore</i></a>
                            </td>
                        </tr>
                    @endforeach 
                </tbody>
            </table>
            {{$professoreslist->links()}}
        </div>
    </div>
@endsection