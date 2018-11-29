@extends('layouts.app')

@section('breadcrumbs')
    <a href="{{route('professor.index')}}" class="breadcrumb">Professores</a>
@endsection
@section('title') Professores registradas @endsection
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
                        <th>Nome do professor</th>
                        <th>Matricula</th>
                        <th>Telefone</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($professoreslist as $professor)
                        <tr>
                            <td>{{$professor->nome}}</td>
                            <td>{{$professor->matricula}}</td>
                            <td>{{$professor->telefone}}</td>
                            <td>
                                <a class="tooltipped" data-position="top" data-tooltip="Lista de turmas de {{$professor->nome}}" href="{{Route('professor_turmas', $professor->id)}}"><i class="small material-icons" style="color: #039be5;">group</i></a>
                                <a class="tooltipped" data-position="top" data-tooltip="Editar {{$professor->nome}}" href="{{Route('professor.edit', $professor->id)}}"><i class="small material-icons" style="color: #039be5;">edit</i></a>
                                <a class="tooltipped modal-trigger" data-position="top" data-tooltip="Deletar {{$professor->nome}}" id="btn-delete" data-id="{{$professor->id}}" data-nome="{{$professor->nome}}" href="#modaldelete"><i class="small material-icons" style="color: #039be5;">delete</i></a>
                            </td>
                        </tr>
                    @endforeach 
                </tbody>
            </table>
            {{$professoreslist->links()}}
        </div>
    </div>

    <div id="modaldelete" class="modal">
        <form action="{{route('professor.destroy', 'delete')}}" method="POST">
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