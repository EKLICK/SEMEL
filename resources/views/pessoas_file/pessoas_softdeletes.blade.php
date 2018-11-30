@extends('layouts.app')
@section('breadcrumbs')
    <a href="{{route('home')}}" class="breadcrumb">Pessoas</a>
    <a href="{{route('pessoas_softdeletes')}}" class="breadcrumb">Deletadas</a>
@endsection
@section('title') Pessoas deletadas @endsection
@section('content')
    <div class="container z-depth-4">
        <div class="card-panel">
            <table class="centered">
                <thead>
                    <tr>
                        <th>Nome da pessoa</th>
                        <th>Atualizações</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pessoaslist as $pessoa)
                        <tr>
                            <td><p>{{$pessoa->nome}}</p></td>
                            <td><p>{{$pessoa->anamneses->last()->ano}}</p><i class="small material-icons" @if($pessoa->anamneses->last()->ano != $ano) style="color: red;" @else style="color: green;"  @endif>sim_card_alert</i></td>
                            <td>
                                <a class="tooltipped" data-position="top" data-tooltip="Informações de {{$pessoa->nome}}" href="{{Route('pessoa_info', $pessoa->id)}}"><i class="small material-icons" style="color: #039be5;">info</i></a>
                                <a class="tooltipped" data-position="top" data-tooltip="Lista de anamneses de {{$pessoa->nome}}" href="{{Route('lista_anamnese', $pessoa->id)}}"><i class="small material-icons" style="color: #039be5;">description</i></a>
                                <a class="tooltipped" data-position="top" data-tooltip="Restaurar {{$pessoa->nome}}" href="{{Route('pessoas_restore', $pessoa->id)}}"><i class="small material-icons" style="color: #039be5;">restore</i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{$pessoaslist->links()}}
        </div>
    </div>
@endsection