@extends('layouts.app')

@section('content')
    @if(Session::get('mensagem'))
        <div class="center-align">
            <div class="chip green lighten-2">
                {{Session::get('mensagem')}}
                <i class="close material-icons">close</i>
            </div>
        </div>
        {{Session::forget('mensagem')}}
    @endif

    <div class="white container" style="margin-top: 3%;">
        <table class="centered">
            <thead>
                <tr>
                    <th>Nome da turma</th>
                    <th>Limite de alunos</th>
                    <th>Editar</th>
                    <th>Deletar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($turmaslist as $turma)
                    <tr @if(count($turma->pessoas) >= $turma->limite) class="yellow darken-2" @endif>
                        <td><h5>{{$turma->nome}}</h4></td>
                        <td><h5>{{count($turma->pessoas)}} / {{$turma->limite}}</h5></td>
                        <td><a href="{{Route('turmas.edit', $turma->id)}}"><i class="material-icons medium" style="color: green;">edit</i></a></td>
                        <td><a id="btn-delete" data-id="{{$turma->id}}" data-nome="{{$turma->nome}}" href="#modaldelete" class="modal-trigger"><i class="material-icons medium" style="color: green;">delete</i></a></td>
                    </tr>
                @endforeach 
            </tbody>
        </table>
        <a href="{{Route('turmas.create')}}"><i class="medium material-icons" style="color: green;">add_circle_outline</i></a>
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