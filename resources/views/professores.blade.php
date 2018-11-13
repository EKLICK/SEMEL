@extends('layouts.app')

@section('content')
    <div class="white" style="margin-top: 3%; margin-left: 3%; margin-right: 3%;">
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
                        <td><h3>{{$professor->nome}}</h3></td>
                        <td><h3>{{$professor->matricula}}</h3></td>
                        <td><h3>{{$professor->telefone}}</h3></td>
                        <td><h3>{{$professor->email}}</h3></td>
                        <td><a href=""><i class="large material-icons" style="color: green;">edit</i></a></td>
                        <td><a href=""><i class="large material-icons" style="color: green;">delete</i></a></td>
                    </tr>
                @endforeach 
            </tbody>
        </table>
        <a href=""><i class="large material-icons" style="color: green;">add_circle_outline</i></a>
    </div>
@endsection