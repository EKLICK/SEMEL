@extends('layouts.app')

@section('content')
    <div class="section">
        <div class="container">
            <h4>Pessoas registradas</h4>
            <div class="divider"></div>
        </div>
        
        <div class="container z-depth-4">
            <div class="card-panel">
                <table class="centered">
                    <thead>
                        <tr>
                            <th>Nome da pessoa</th>

                            <th>Atualizações</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pessoaslist as $pessoa)
                            <tr>
                                <td><p>{{$pessoa->nome}}</p></td>
                                <td><p>{{$pessoa->anamneses->last()->ano}}</p><i class="small material-icons" @if($pessoa->anamneses->last()->ano != $ano) style="color: red;" @else style="color: green;"  @endif>sim_card_alert</i></td>
                                <td>
                                    <a href="{{Route('pessoa_info', $pessoa->id)}}"><i class="small material-icons" style="color: #039be5;">info</i></a>
                                    <a href="{{Route('lista_anamnese', $pessoa->id)}}"><i class="small material-icons" style="color: #039be5;">description</i></a>
                                    <a href="{{Route('pessoas_turmas', $pessoa->id)}}"><i class="small material-icons" style="color: #039be5;">group</i></a>
                                    <a href="{{Route('pessoas.edit', $pessoa->id)}}"><i class="small material-icons" style="color: #039be5;">edit</i></a>
                                    <a id="btn-delete" data-id="{{$pessoa->id}}" data-nome="{{$pessoa->nome}}" href="#modaldelete" class="modal-trigger"><i class="small material-icons" style="color: #039be5;">delete</i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <a href="{{route('pessoas.create')}}"><i class="medium material-icons" style="color: #039be5;">add_circle_outline</i></a>
            </div>
        </div>
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