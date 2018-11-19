@extends('layouts.app')

@section('content')
    <div class="white container" style="margin-top: 3%;">
        <table class="centered">
            <thead>
                <tr>
                    <th>Nome da pessoa</th>
                    <th>Anamnese atual</th>
                    <th>Lista de anamneses</th>
                    <th>Informações</th>
                    <th>Editar</th>
                    <th>Deletar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pessoaslist as $pessoa)
                    <tr @if($pessoa->anamneses->last()->ano != $ano) class="red lighten-1" @else class="green lighten-2" @endif>
                        <td><h5>{{$pessoa->nome}}</h4></td>
                        <td>{{$pessoa->anamneses->last()->ano}}</td>
                        <td><a href="{{Route('lista_anamnese', $pessoa->id)}}"><i class="material-icons medium" style="color: green;">description</i></a></td>
                        <td><a href="{{Route('pessoa_info', $pessoa->id)}}"><i class="material-icons medium" style="color: green;">info</i></a></td>
                        <td><a href="{{Route('pessoas.edit', $pessoa->id)}}"><i class="material-icons medium" style="color: green;">edit</i></a></td>
                        <td><a id="btn-delete" data-id="{{$pessoa->id}}" data-nome="{{$pessoa->nome}}" href="#modaldelete" class="modal-trigger"><i class="material-icons medium" style="color: green;">delete</i></a></td>
                    </tr>
                @endforeach s
            </tbody>
        </table>
        <a href="{{route('pessoas.create')}}"><i class="medium material-icons" style="color: green;">add_circle_outline</i></a>
    </div>

    <div id="modaldelete" class="modal">
        <form action="{{route('pessoas.destroy', 'delete')}}" method="POST">
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