@extends('layouts.app')
@section('breadcrumbs')
    <a href="{{route('turmas.index')}}" class="breadcrumb">Turmas</a>
@endsection
@section('title') Turmas registradas @endsection
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
                            <form action="{{route('turmas_procurar')}}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col s2"><label>Nome da turma:</label></div>
                                    <div class="input-field col s4">
                                        <input id="nome_search" type="text" class="validate" name="nome">
                                        <label for="nome_search">Nome:</label>
                                    </div>
                                    <div class="col s2"><label>Quantidade limite:</label></div>
                                    <div class="input-field col s2">
                                        <input id="limite_search" type="number" class="validate" name="limite">
                                        <label for="limite_search">Limite:</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col s2"><label>Núcleo vinculado:</label></div>
                                    <div class="input-field col s4">
                                        <select name="nucleo_id">
                                            <option value="" selected disabled>Selecione o núcleo</option>
                                            @foreach ($nucleoslist as $nucleo)
                                                <option value="{{$nucleo->id}}">{{$nucleo->nome}}</option>
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
                        <th>Nome da turma</th>
                        <th>Limite de alunos</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($turmaslist as $turma)
                        <tr>
                            <td><p>{{$turma->nome}}</p></td>
                            <td><p>{{count($turma->pessoas)}} / {{$turma->limite}}</p><i class="small material-icons" @if(count($turma->pessoas) >= $turma->limite) style="color: yellow;" @else style="color: green;" @endif>sim_card_alert</i></td>
                            <td>
                                <a class="tooltipped" data-position="top" data-tooltip="Editar {{$turma->nome}}" href="{{Route('turmas.edit', $turma->id)}}"><i class="small material-icons" style="color: #039be5;">edit</i></a>
                                <a class="tooltipped modal-trigger" data-position="top" data-tooltip="Deletar {{$turma->nome}}" id="btn-delete" data-id="{{$turma->id}}" data-nome="{{$turma->nome}}" href="#modaldelete"><i class="small material-icons" style="color: #039be5;">delete</i></a>
                            </td>
                        </tr>
                    @endforeach 
                </tbody>
            </table>
            {{$turmaslist->links()}}
            <a class="tooltipped" data-position="top" data-tooltip="Adicionar turma" href="{{Route('turmas.create')}}"><i class="medium material-icons" style="color: #039be5;">add_circle_outline</i></a>
        </div>
    </div>

    <div id="modaldelete" class="modal">
        <form action="{{Route('turmas.destroy', 'delete')}}" method="POST">
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