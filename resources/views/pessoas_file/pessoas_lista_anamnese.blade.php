@extends('layouts.app')

@section('content')

<div class="white container" style="margin-top: 3%;">
        <table class="centered">
            <thead>
                <tr>
                    <th>Nome da pessoa</th>
                    <th>Ano</th>
                    <th>Doença</th>
                    <th>Editar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pessoa->anamneses as $anamnese)
                    <tr>
                        <td><h5>@if(isset($anamnese->pessoas->nome)) {{$anamnese->pessoas->nome}} @else Usuário não cadastrado @endif</h4></td>
                        <td>{{$anamnese->ano}}</td>
                        <td><h5>@if(isset($anamnese->doencas->nome)) {{$anamnese->doencas->nome}} @else Sem doenças @endif</h5></td>
                        <td><a href="{{Route('anamneses.edit', $anamnese->id)}}"><i class="material-icons medium" style="color: green;">edit</i></a></td>
                    </tr>
                @endforeach 
            </tbody>
        </table>
    </div>
@endsection