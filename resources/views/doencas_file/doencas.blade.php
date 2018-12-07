@extends('layouts.app')
@section('breadcrumbs')
    <a href="{{route('doencas.index')}}" class="breadcrumb">Doenças</a>
@endsection
@section('title') Doenças registradas @endsection
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
    @if(Session::get('quant'))
        <div class="center-align sessao">
            <div class="chip light-blue accent-2 lighten-2">
                {{Session::get('quant')}}
                <i class="close material-icons">close</i>
            </div>
        </div>
        {{Session::forget('quant')}}
    @endif
    <div class="container z-depth-4">
        <div class="card-panel">
            <ul class="collapsible">
                <li>
                    <div class="collapsible-header"><i class="material-icons">location_searching</i>Filtros</div>
                    <div class="collapsible-body">
                        <form action="{{route('doencas_procurar')}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col s2"><label>Nome da doença:</label></div>
                                <div class="input-field col s4">
                                    <input id="de_peso_search" type="text" class="validate" name="nome">
                                    <label for="de_peso_search">Nome:</label>
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
                        <th>Nome da doença</th>
                        <th>Descrição</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($doencaslist as $doenca)
                        <tr>
                            <td><p>{{$doenca->nome}}</p></td>
                            <td><p>{{$doenca->descricao}}</p></td>
                            <td>
                                <a class="tooltipped" data-position="top" data-tooltip="Informações de {{$doenca->nome}}" href="{{Route('doencas.edit', $doenca->id)}}"><i class="small material-icons" style="color: #039be5;">edit</i></a>
                                <a class="tooltipped modal-trigger" data-position="top" data-tooltip="Deletar doença" id="btn-delete" data-id="{{$doenca->id}}" data-nome="{{$doenca->nome}}" href="#modaldelete"><i class="small material-icons" style="color: #039be5;">delete</i></a>
                            </td>
                        </tr>
                    @endforeach 
                </tbody>
            </table>
            {{$doencaslist->links()}}
            <a class="tooltipped" data-position="top" data-tooltip="Adicionar doença" href="{{route('doencas.create')}}"><i class="medium material-icons" style="color: #039be5;">add_circle_outline</i></a>
        </div>
    </div>

    <div id="modaldelete" class="modal">
        <form action="{{route('doencas.destroy', 'delete')}}" method="POST">
            @method('DELETE')
            @csrf
            <div class="modal-content">
                <h4>Deletar</h4>
                <p>Você tem certeza que deseja deletar o professor abaixo?</p>
                <div class="row">
                    <label for="name_delete">Nome:</label>
                    <div class="input-field col s12">
                        <input class="validate" hidden name="id" type="number" id="id_delete">
                        <input disabled class="validate" type="text" id="name_delete">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn red delete" type="submit">Sim</button>
            </div>
        </form>
    </div>
@endsection

<!--
    <div class="col s1"><label>Possui doenças?</label></div>
                                <div class="input-field col s3">
                                    <select multiple name="nucleos[]">
                                         ($nucleolist as $nucleo)
                                            <option value=""></option>
                                        
                                    </select>
                                </div>
-->