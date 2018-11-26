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

    <div class="section">
        <div class="container">
            <h4>Turmas</h4>
            <div class="divider"></div>
        </div>
        
        <div class="container z-depth-4">
            <div class="card-panel">
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
                <a href="{{Route('turmas.create')}}"><i class="medium material-icons" style="color: #039be5;">add_circle_outline</i></a>
            </div>
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