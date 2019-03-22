@extends('layouts.app')
@section('breadcrumbs')
    <a href="{{route('home')}}" class="breadcrumb">Home</a>
    <a href="{{route('professor.index')}}" class="breadcrumb">Professores</a>
@endsection
@section('title') Professores registrados @endsection
@section('content')
    @include('layouts.Sessoes.mensagem_green')
    <div class="container z-depth-4">
        <div class="card-panel">
            @include('layouts.Sessoes.quant')
            <ul class="collapsible">
                <li>
                    <div class="collapsible-header"><i class="material-icons">filter_list</i>Filtros</div>
                    <div class="collapsible-body">
                        <form action="{{route('professor_procurar')}}" method="GET">
                            @csrf
                            <div class="row">
                                <div class="input-field col s11 xl6">
                                    <i class="material-icons prefix">account_circle</i>
                                    <input id="nome_search" type="text" class="validate" name="nome">
                                    <label for="nome_search">Nome:</label>
                                </div>
                                <div class="input-field col s3 xl1"><i class="material-icons prefix">date_range</i></div>
                                <div class="input-field col s4 xl2">
                                    <input id="de_search" type="text" class="datepicker validate" name="de">
                                    <label for="de_search">De:</label>
                                </div>
                                <div class="input-field col s4 xl2">
                                    <input id="ate_search" type="text" class="datepicker validate" name="ate">
                                    <label for="ate_search">Até:</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s11 xl3">
                                    <i class="material-icons prefix">recent_actors</i>
                                    <input id="matricula_search" type="text" class="validate" name="matricula">
                                    <label for="matricula_search">matricula:</label>
                                </div>
                                <div class="input-field col s11 xl4">
                                    <i class="material-icons prefix">phone</i>
                                    <input onkeydown="javascript: fMasc(this, mTel)" name="telefone" id="icon_telephone" type="tel" class="validate">
                                    <label for="icon_telephone">Telephone:</label>
                                </div>
                                <div class="input-field col s11 xl4">
                                    <i class="material-icons prefix">email</i>
                                    <input id="email_search" type="text" class="validate" name="email">
                                    <label for="email_search">E-mail:</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s11 xl6">
                                    <i class="material-icons prefix">location_city</i>
                                    <input placeholder="Bairro" id="bairro_search" type="text" class="validate" name="bairro">
                                    <label for="bairro_search">Bairro</label>
                                </div>
                                <div class="input-field col s11 xl5">
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
            <table class="centered responsive-table highlight bordered">
                <thead>
                    <tr>
                        <th>Nome do professor</th>
                        <th>Telefone</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($professoreslist as $professor)
                        <tr>
                            <td>{{$professor->nome}}</td>
                            <td>{{$professor->telefone}}</td>
                            <td>
                                <a class="tooltipped" data-position="top" data-tooltip="Informações de {{$professor->nome}}" href="{{Route('professor_info', $professor->id)}}"><i class="small material-icons">info</i></a>
                                <a class="tooltipped" data-position="top" data-tooltip="Lista de turmas de {{$professor->nome}}" href="{{Route('professor_turmas', $professor->id)}}"><i class="small material-icons">group</i></a>
                                <a class="tooltipped" data-position="top" data-tooltip="Editar {{$professor->nome}}" href="{{Route('professor.edit', $professor->id)}}"><i class="small material-icons">edit</i></a>
                            </td>
                        </tr>
                    @endforeach 
                </tbody>
            </table>
            @if(isset($dataForm))
                {{$professoreslist->appends($dataForm)->links()}}
            @else
                {{$professoreslist->links()}}
            @endif
            <br>
            <div class="container">
                <a class="tooltipped btn-floating btn-large waves-effect waves-light light-blue darken-1" data-position="top" data-tooltip="Adicionar professor" href="{{Route('professor.create')}}"><i class="material-icons">add_to_queue</i></a>
            </div>
        </div>
    </div>
@endsection