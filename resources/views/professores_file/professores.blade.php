@extends('layouts.app')

@section('content')
    <div class="section">
        <div class="container">
            <h4>Professores</h4>
            <div class="divider"></div>
        </div>
        
        <div class="container z-depth-4">
            <div class="card-panel">
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
                                    <a class="tooltipped" data-position="top" data-tooltip="Lista de turmas de {{$professor->nome}}" href="{{Route('professor_turmas', $professor->id)}}"><i class="small material-icons" style="color: #039be5;">group</i></a>
                                    <a class="tooltipped" data-position="top" data-tooltip="Editar {{$professor->nome}}" href="{{Route('professor.edit', $professor->id)}}"><i class="small material-icons" style="color: #039be5;">edit</i></a>
                                    <a class="tooltipped" data-position="top" data-tooltip="Deletar {{$professor->nome}}" id="btn-delete" data-id="{{$professor->id}}" data-nome="{{$professor->nome}}" href="#modaldelete" class="modal-trigger"><i class="small material-icons" style="color: #039be5;">delete</i></a>
                                </td>
                            </tr>
                        @endforeach 
                    </tbody>
                </table>
                {{$professoreslist->links()}}
            </div>
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