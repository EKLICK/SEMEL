@extends('layouts.app')

@section('content')
    <div class="white container" style="margin-top: 3%;">
        <table class="centered">
            <thead>
                <tr>
                    <th>Nome da turma</th>
                    <th>Bairro</th>
                    <th>Turmas cadastradas</th>
                    <th>Editar</th>
                    <th>Deletar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($nucleoslist as $nucleo)
                        <td><h5>{{$nucleo->nome}}</h4></td>
                        <td>{{$nucleo->bairro}}</td>
                        <td><a href="{{route('turmas_cadastradas', $nucleo->id)}}"><i class="material-icons medium" style="color: green;">people</i></a></td>
                        <td><a href="{{Route('nucleos.edit', $nucleo->id)}}"><i class="material-icons medium" style="color: green;">edit</i></a></td>
                        <td><a id="btn-delete" data-id="{{$nucleo->id}}" data-nome="{{$nucleo->nome}}" href="#modaldelete" class="modal-trigger"><i class="material-icons medium" style="color: green;">delete</i></a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{route('nucleos.create')}}"><i class="medium material-icons" style="color: green;">add_circle_outline</i></a>
    </div>

    <div id="modaldelete" class="modal">
        <form action="{{route('nucleos.destroy', 'delete')}}" method="POST">
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