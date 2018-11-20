@extends('layouts.app')

@section('content')
    <h4 class="container" style="margin-top: 3%;">Anamneses de {{$ano}}</h4>
    <div class="white container">
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
                @foreach ($anamneseslist as $anamnese)
                    @if($anamnese->ano == $ano)
                        <tr class="green lighten-2">
                            <td><h5>@if(isset($anamnese->pessoas->nome)) {{$anamnese->pessoas->nome}} @else Usuário não cadastrado @endif</h4></td>
                            <td>{{$anamnese->ano}}</td>
                            <td><h5>@if(isset($anamnese->doencas->nome)) {{$anamnese->doencas->nome}} @else Sem doenças @endif</h5></td>
                            <td><a href="{{Route('anamneses.edit', $anamnese->id)}}"><i class="material-icons medium" style="color: green;">edit</i></a></td>
                        </tr>
                    @endif
                @endforeach 
            </tbody>
        </table>
    </div>
    <h4 class="container" style="margin-top: 3%;">Anamneses históricos</h4>
    <div class="white container">
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
                @foreach ($anamneseslist as $anamnese)
                    @if($anamnese->ano != $ano)
                        <tr class="red lighten-1">
                            <td><h5>@if(isset($anamnese->pessoas->nome)) {{$anamnese->pessoas->nome}} @else Usuário não cadastrado @endif</h4></td>
                            <td>{{$anamnese->ano}}</td>
                            <td><h5>@if(isset($anamnese->doencas->nome)) {{$anamnese->doencas->nome}} @else Sem doenças @endif</h5></td>
                            <td><a href="{{Route('anamneses.edit', $anamnese->id)}}"><i class="material-icons medium" style="color: green;">edit</i></a></td>
                        </tr>
                    @endif
                @endforeach 
            </tbody>
        </table>
    </div>
@endsection