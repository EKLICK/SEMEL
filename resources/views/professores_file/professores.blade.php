@extends('layouts.app')

@section('content')
    <div class="white container" style="margin-top: 3%;">
        <table class="centered">
            <thead>
                <tr>
                    <th>Nome do professor</th>
                    <th>Matricula</th>
                    <th>Telefone</th>
                    <th>E-mail</th>
                    <th>Editar</th>
                    <th>Deletar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($professoreslist as $professor)
                    <tr>
                        <td><h5>{{$professor->nome}}</h4></td>
                        <td><h5>{{$professor->matricula}}</h5></td>
                        <td><h5>{{$professor->telefone}}</h5></td>
                        <td><h5>{{$professor->email}}</h5></td>
                        <td><a href=""><i class="material-icons medium" style="color: green;">edit</i></a></td>
                        <td><a href=""><i class="material-icons medium" style="color: green;">delete</i></a></td>
                    </tr>
                @endforeach 
            </tbody>
        </table>
        <a href="{{route('professor.create')}}"><i class="large material-icons" style="color: green;">add_circle_outline</i></a>
    </div>
@endsection