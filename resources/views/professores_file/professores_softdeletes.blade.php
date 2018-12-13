@extends('layouts.app')
@section('breadcrumbs')
    <a href="{{route('professor.index')}}" class="breadcrumb">Professores</a>
    <a href="{{route('professor_softdeletes')}}" class="breadcrumb">Deletados</a>
@endsection
@section('title') Professores deletadas @endsection
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
                    <div class="collapsible-header"><i class="material-icons">filter_list</i>Filtros</div>
                    <div class="collapsible-body">
                        <form action="{{route('professor_procurar')}}" method="POST">
                            @csrf
                            <input type="text" value="softdelete" name="softdelete" hidden>
                            <div class="row">
                                <div class="input-field col s5">
                                    <i class="material-icons prefix">account_circle</i>
                                    <input id="nome_search" type="text" class="validate" name="nome">
                                    <label for="nome_search">Nome:</label>
                                </div>
                                <div class="col s1"><label>Idade:</label></div>
                                <div class="input-field col s2">
                                    <input id="de_search" type="number" class="validate" name="de">
                                    <label for="de_search">De:</label>
                                </div>
                                <div class="input-field col s2">
                                    <input id="ate_search" type="number" class="validate" name="ate">
                                    <label for="ate_search">Até:</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s3">
                                    <i class="material-icons prefix">email</i>
                                    <input id="email_search" type="text" class="validate" name="email">
                                    <label for="email_search">E-mail:</label>
                                </div>
                                <div class="input-field col s3">
                                    <i class="material-icons prefix">recent_actors</i>
                                    <input id="matricula_search" type="text" class="validate" name="matricula">
                                    <label for="matricula_search">matricula:</label>
                                </div>
                                <div class="input-field col s4">
                                    <i class="material-icons prefix">phone</i>
                                    <input name="telefone" id="icon_telephone" type="tel" class="validate">
                                    <label for="icon_telephone">Telephone:</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s4">
                                    <i class="material-icons prefix">location_city</i>
                                    <input placeholder="Bairro" id="bairro_search" type="text" class="validate" name="bairro">
                                    <label for="bairro_search">Bairro</label>
                                </div>
                                <div class="input-field col s4">
                                    <i class="material-icons prefix">confirmation_number</i>
                                    <input name="rua" id="rua" type="text" class="validate">
                                    <label for="rua">Rua:</label>
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
                        <th>Nome do professor</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($professoreslist as $professor)
                        <tr>
                            <td>{{$professor->nome}}</td>
                            <td>
                                <a class="tooltipped" data-position="top" data-tooltip="Informações de {{$professor->nome}}" href="{{Route('professor_info', $professor->id)}}"><i class="small material-icons" style="color: #039be5;">info</i></a>
                                <a class="tooltipped" data-position="top" data-tooltip="Restaurar {{$professor->nome}}" href="{{Route('professor_restore', $professor->id)}}"><i class="small material-icons" style="color: #039be5;">restore</i></a>
                            </td>
                        </tr>
                    @endforeach 
                </tbody>
            </table>
            {{$professoreslist->links()}}
        </div>
    </div>
@endsection