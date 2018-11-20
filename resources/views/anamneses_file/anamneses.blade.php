@extends('layouts.app')

@section('content')
    <h4 class="container" style="margin-top: 3%; color:white">Anamneses de {{$ano}}</h4>
    <div class="white container">
        <table class="centered">
            <thead>
                <tr>
                    <th>Nome da pessoa</th>
                    <th>Ano</th>
                    <th>Quant Doenças</th>
                    <th>Informações</th>
                    <th>Editar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($anamneseslist as $anamnese)
                    @if($anamnese->ano == $ano)
                        <tr class="green lighten-2">
                            <td><h5>@if(isset($anamnese->pessoas->nome)) {{$anamnese->pessoas->nome}} @else Usuário não cadastrado @endif</h4></td>
                            <td><h5>{{$anamnese->ano}}</h5></td>
                            <td><h5>{{count($anamnese->doencas)}}</h5></td>
                            <td><a href="{{Route('anamnese_info', $anamnese->id)}}"><i class="material-icons medium" style="color: green;">info</i></a></td>
                            <td><a href="{{Route('anamneses.edit', $anamnese->id)}}"><i class="material-icons medium" style="color: green;">edit</i></a></td>
                        </tr>
                    @endif
                @endforeach 
            </tbody>
        </table>
    </div>
    <h4 class="container" style="margin-top: 3%; color:white">Anamneses históricos</h4>
    <div class="white container">
        <table class="centered">
            <thead>
                <tr>
                    <th>Nome da pessoa</th>
                    <th>Ano</th>
                    <th>Quant Doenças</th>
                    <th>Informações</th>
                    <th>Editar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($anamneseslist as $anamnese)
                    @if($anamnese->ano != $ano)
                        <tr class="red lighten-1">
                            <td><h5>@if(isset($anamnese->pessoas->nome)) {{$anamnese->pessoas->nome}} @else Usuário não cadastrado @endif</h4></td>
                            <td><h5>{{$anamnese->ano}}</h5></td>
                            <td><h5>{{count($anamnese->doencas)}}</h5></td>
                            <td><a href="{{Route('anamnese_info', $anamnese->id)}}"><i class="material-icons medium" style="color: green;">info</i></a></td>
                            <td><a href="{{Route('anamneses.edit', $anamnese->id)}}"><i class="material-icons medium" style="color: green;">edit</i></a></td>
                        </tr>
                    @endif
                @endforeach 
            </tbody>
        </table>
    </div>
@endsection