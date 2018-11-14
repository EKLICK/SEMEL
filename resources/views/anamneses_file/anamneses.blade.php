@extends('layouts.app')

@section('content')
    <div class="white container" style="margin-top: 3%;">
        <table class="centered">
            <thead>
                <tr>
                    <th>Nome da pessoa</th>
                    <th>Peso</th>
                    <th>Altura</th>
                    <th>Doença</th>
                    <th>Editar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($anamneseslist as $anamnese)
                    <tr>
                        <td><h5>@if(isset($anamnese->pessoas->nome)) {{$anamnese->pessoas->nome}} @else Usuário não cadastrado @endif</h4></td>
                        <td><h5>{{$anamnese->peso}}</h5></td>
                        <td><h5>{{$anamnese->altura}}</h5></td>
                        <td><h5>@if(isset($anamnese->doencas->nome)) {{$anamnese->doencas->nome}} @else Sem doenças @endif</h5></td>
                        <td><a href="{{Route('anamneses.edit', $anamnese->id)}}"><i class="material-icons medium" style="color: green;">edit</i></a></td>
                    </tr>
                @endforeach 
            </tbody>
        </table>
    </div>
@endsection