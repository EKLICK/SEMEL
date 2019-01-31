@extends('layouts.app')
@section('breadcrumbs')
    <a href="{{route('nucleos.index')}}" class="breadcrumb">Nucleos</a>
    <a href="{{route('turmas_cadastradas', $nucleo->id)}}" class="breadcrumb">Turmas cadastradas</a>
@endsection
@section('title') Turmas cadastradas em {{$nucleo->nome}} @endsection
@section('content') 
    <div class="container z-depth-4">
        <div class="card-panel">
            <table class="centered responsive-table highlight bordered">
                <thead>
                    <tr>
                        <th>Nome da turma</th>
                        <th>limite</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($nucleo->turmas as $turma)
                        <tr>
                            <td><p>{{$turma->nome}}</p><i class="small material-icons" @if(count($turma->pessoas) >= $turma->limite) style="color: yellow;" @else style="color: green;" @endif>sim_card_alert</i></td>
                            <td><p>{{count($turma->pessoas)}} / {{$turma->limite}}</p></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection