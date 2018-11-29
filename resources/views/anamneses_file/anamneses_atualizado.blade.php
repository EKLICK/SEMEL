@extends('layouts.app')
@section('breadcrumbs')
    <a href="{{route('anamneses.index')}}" class="breadcrumb">Anamneses</a>
@endsection
@section('title') <h4>Anamneses de {{$ano}}</h4> @endsection
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
                            <td>
                                <a class="tooltipped" data-position="top" data-tooltip="Informações da anamnese" href="{{Route('anamnese_info', $anamnese->id)}}"><i class="small material-icons" style="color: #039be5;">info</i></a>
                                <a class="tooltipped" data-position="top" data-tooltip="Editar anamnese" href="{{Route('anamneses.edit', $anamnese->id)}}"><i class="small material-icons" style="color: #039be5;">edit</i></a>
                            </td>
                        </tr>
                    @endforeach 
                </tbody>
            </table>
            {{$anamneseslist->links()}}
        </div>
    </div>
@endsection