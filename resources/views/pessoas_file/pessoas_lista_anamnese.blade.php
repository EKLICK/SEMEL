@extends('layouts.app')

@section('content')
    @if(Session::get('mensagem'))
        <div class="center-align sessao">
            <div class="chip green lighten-2">
                {{Session::get('mensagem')}}
                <i class="close material-icons">close</i>
            </div>
        </div>
        {{Session::forget('mensagem')}}
    @endif
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
                            <th>Ano</th>
                            <th>Doença</th>
                            <th>Editar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($anamneses as $anamnese)
                        <tr>
                            <td><p>{{$anamnese->ano}}</p><i class="small material-icons" @if($anamnese->ano != $ano) style="color: red;" @else style="color: green;"  @endif>sim_card_alert</i></td>
                            <td><p>{{count($anamnese->doencas)}}</p></td>
                            <td><a class="tooltipped" data-position="top" data-tooltip="Editar anamneses de {{$anamnese->ano}}" href="{{Route('anamneses.edit', $anamnese->id)}}"><i class="small material-icons" style="color: #039be5;">edit</i></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$anamneses->links()}}
                <br><br>
                <a href="{{Route('lista_anamnese_create', $pessoa->id)}}" class="waves-effect waves-light btn"><i class="material-icons right">send</i>Nova anamnese de {{$pessoa->nome}}</a>
            </div>
        </div>
    </div>
@endsection