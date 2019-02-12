@extends('layouts.app')
@section('breadcrumbs')
    <a href="{{route('audits.index')}}" class="breadcrumb">Auditorias</a>
@endsection
@section('title') Auditorias registradas @endsection
@section('content')
    <div class="container z-depth-4">
        <div class="card-panel">
            @include('layouts.Sessoes.quant')
            <ul class="collapsible">
                <li>
                    <div class="collapsible-header"><i class="material-icons">location_searching</i>Filtros</div>
                    <div class="collapsible-body">
                        <form action="{{route('audits_procurar')}}" method="GET">
                            @csrf
                            <div class="row">
                                <div class="input-field col s11 m5">
                                    Evento
                                    <select name="eventos[]">
                                        <option value="" selected disabled>Selecione o evento</option>
                                        @for($i = 0; $i < count($eventos); $i++)
                                            <option value="{{$i}}">{{$eventos[$i]}}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="input-field col s11 m5">
                                    Tabela
                                    <select name="tabelas[]">
                                        <option value="" selected disabled>Selecione a tabela</option>
                                        @for($i = 0; $i < count($tabelas); $i++)
                                            <option value="{{$i}}">{{$tabelas[$i]}}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s3">
                                    <button class="btn waves-effect waves-light" type="submit" name="action">Procurar
                                        <i class="material-icons right">search</i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>
            </ul>
            <table class="centered responsive-table highlight bordered">
                <thead>
                    <tr>
                        <th>Id Usuário</th>
                        <th>Tipo</th>
                        <th>Evento</th>
                        <th>Data:Hora</th>
                        <th>Mais informações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($auditslist as $audit)
                        <tr>
                            <td><p>{{$audit->user_id}}</p></td>
                            <td><p>{{$audit->auditable_type}}</p></td>
                            <td><p>{{$audit->event}}</p></td>
                            <td><p>{{$audit->created_at}}</p></td>
                            <td><a class="tooltipped" data-position="top" data-tooltip="Informações da auditoria" href="{{route('audits_info', $audit->id)}}"><i class="small material-icons">info</i></a></td>
                        </tr>
                    @endforeach 
                </tbody>
            </table>
            @if(isset($dataForm))
                {{$auditslist->appends($dataForm)->links()}}
            @else
                {{$auditslist->links()}}
            @endif
        </div>
    </div>
@endsection