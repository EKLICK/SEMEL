@extends('layouts.app')

@section('content')
    <div class="section">
        <div class="container">
            <h4>Anamneses de {{$ano}}</h4>
            <div class="divider"></div>
        </div>
    
        <div class="container z-depth-4">
            <div class="card-panel">
                <table class="centered">
                    <thead>
                        <tr>
                            <th>Nome da pessoa</th>
                            <th>Ano</th>
                            <th>Quant Doenças</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody >
                        @foreach ($anamneseslist as $anamnese)
                            <tr>
                                <td><p>@if(isset($anamnese->pessoas->nome)) {{$anamnese->pessoas->nome}} @else Usuário não cadastrado @endif</p></td>
                                <td><p>{{$anamnese->ano}}</p></td>
                                <td><p>{{count($anamnese->doencas)}}</p></td>
                                <td><a href="{{Route('anamnese_info', $anamnese->id)}}"><i class="small material-icons" style="color: #039be5;">info</i></a>
                                <a href="{{Route('anamneses.edit', $anamnese->id)}}"><i class="small material-icons" style="color: #039be5;">edit</i></a></td>
                            </tr>
                        @endforeach 
                    </tbody>
                </table>
                {{$anamneseslist->links()}}
            </div>
        </div>
    </div>
    <!-- <h4 class="container" style="margin-top: 3%; color:white">Anamneses históricos</h4>
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
-->
@endsection