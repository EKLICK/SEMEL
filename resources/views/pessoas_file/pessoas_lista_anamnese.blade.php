@extends('layouts.app')

@section('breadcrumbs')
    <a href="{{route('home')}}" class="breadcrumb">Pessoas</a>
    @if(isset($pessoa->deleted_at)) <a href="{{route('pessoas_softdeletes')}}" class="breadcrumb">Deletadas</a> @endif
    <a href="{{route('lista_anamnese', $pessoa->id)}}" class="breadcrumb">Anamneses</a>
@endsection
@section('title') Anamneses de <?php $nomes = explode(' ',$pessoa->nome);?> {{$nomes[0]}} @endsection
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
    <div class="container z-depth-4">
        <div class="card-panel">
            @if(Session::get('quant'))
                <div class="center-align quantmens">
                    <div class="chip light-blue accent-2 lighten-2">
                        {{Session::get('quant')}}
                        <i class="close material-icons">close</i>
                    </div>
                </div>
                {{Session::forget('quant')}}
            @endif
            <table class="centered responsive-table highlight bordered">
                <thead>
                    <tr>
                        <th>Ano</th>
                        <th>Doença</th>
                        @if($pessoa->deleted_at == null)
                            <th style="width:200px; display:block: center;">Editar</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($anamneses as $anamnese)
                    <tr>
                        <td><p>{{$anamnese->ano}}</p><i class="small material-icons" @if($anamnese->ano != $ano) style="color: red;" @else style="color: green;"  @endif>sim_card_alert</i></td>
                        <td><p>{{count($anamnese->doencas)}}</p></td>
                        @if($pessoa->deleted_at == null)
                            @if($anamnese->ano == $ano)
                                <td><a class="tooltipped" data-position="top" data-tooltip="Editar anamneses de {{$anamnese->ano}}" href="{{Route('anamneses.edit', $anamnese->id)}}"><i class="small material-icons" style="color: #039be5;">edit</i></a></td>
                            @else
                                <td><p>Esta anamnese não <br> pode ser mais editada</p></td>
                            @endif
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{$anamneses->links()}}
            <br><br>
            @if($pessoa->deleted_at == null)
                <a href="{{Route('lista_anamnese_create', $pessoa->id)}}" class="waves-effect waves-light btn"><i class="material-icons right">send</i>Nova anamnese de {{$pessoa->nome}}</a>
            @endif
        </div>
    </div>
@endsection