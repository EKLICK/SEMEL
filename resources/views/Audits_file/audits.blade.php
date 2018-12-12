@extends('layouts.app')
@section('breadcrumbs')
    <a href="{{route('audits.index')}}" class="breadcrumb">Auditorias</a>
@endsection
@section('title') Auditorias registradas @endsection
@section('content')
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
            <ul class="collapsible">
                <li>
                    <div class="collapsible-header"><i class="material-icons">location_searching</i>Filtros</div>
                    <div class="collapsible-body">
                        <form action="{{route('audits_procurar')}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="input-field col s4">
                                    Evento
                                    <select name="evento[]">
                                        <option value="" selected disabled>Selecione o evento</option>
                                        @foreach ($eventos as $evento)
                                            <option value="{{$evento}}">{{$evento}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="input-field col s2"></div>
                                <div class="input-field col s4">
                                    Tabela
                                    <select name="tabela[]">
                                        <option value="" selected disabled>Selecione a tabela</option>
                                        @foreach ($tabelas as $tabela)
                                            <option value="{{$tabela}}">{{$tabela}}</option>
                                        @endforeach
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
            <table class="centered">
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
                            <td><a class="tooltipped" data-position="top" data-tooltip="Informações da auditoria" href="{{route('audits_info', $audit->id)}}"><i class="small material-icons" style="color: #039be5;">info</i></a></td>
                        </tr>
                    @endforeach 
                </tbody>
            </table>
            {{$auditslist->links()}}
        </div>
    </div>
@endsection