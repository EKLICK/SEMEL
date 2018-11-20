@extends('layouts.app')

@section('content')
    <div class="white container" style="margin-top: 3%;">
        <table class="centered">
            <thead>
                <tr>
                    <th>Nome da turma</th>
                    <th>limite</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($nucleo->turmas as $turma)
                    <tr @if(count($turma->pessoas) >= $turma->limite) class="yellow darken-2" @endif>
                        <td><h5>{{$turma->nome}}</h4></td>
                        <td><h5>{{count($turma->pessoas)}} / {{$turma->limite}}</h5></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection