@extends('layouts.app')

@section('content')
    <div class="section">
        <div class="container">
            <h4>Anamneses de {{$pessoa->nome}}</h4>
            <div class="divider"></div>
        </div>
        
        <div class="container z-depth-4">
            <div class="card-panel">
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
                        @for ($i = (count($pessoa->anamneses)-1); $i >= 0; $i--) 
                            <tr>
                                <td><p>@if(isset($pessoa->anamneses[$i]->pessoas->nome)) {{$pessoa->anamneses[$i]->pessoas->nome}} @else Usuário não cadastrado @endif</p></td>
                                <td><p>{{$pessoa->anamneses[$i]->ano}}</p><i class="small material-icons" @if($pessoa->anamneses[$i]->ano != $ano) style="color: red;" @else style="color: green;"  @endif>sim_card_alert</i></td>
                                <td><p>{{count($pessoa->anamneses[$i]->doencas)}}</p></td>
                            
                                <td><a href="{{Route('anamneses.edit', $pessoa->anamneses[$i]->id)}}"><i class="small material-icons" style="color: #039be5;">edit</i></a></td>
                            </tr>
                        @endfor
                    </tbody>
                </table>
                {{$pessoa->anamneses->links()}}
                <a href="{{Route('lista_anamnese_create', $pessoa->id)}}" class="waves-effect waves-light btn"><i class="material-icons right">send</i>Nova anamnese de {{$pessoa->nome}}</a>
            </div>
        </div>
    </div>
@endsection