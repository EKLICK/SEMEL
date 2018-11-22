@extends('layouts.app')

@section('content')
    <div class="section">
        <div class="container">
            <h4>Doenças</h4>
            <div class="divider"></div>
        </div>
        
        <div class="container z-depth-4">
            <div class="card-panel">
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
                                    <a href="{{Route('doencas.edit', $doenca->id)}}"><i class="small material-icons" style="color: #039be5;">edit</i></a>
                                    <a id="btn-delete" data-id="{{$doenca->id}}" data-nome="{{$doenca->nome}}" href="#modaldelete" class="modal-trigger"><i class="small material-icons" style="color: #039be5;">delete</i></a>
                                </td>
                            </tr>
                        @endforeach 
                    </tbody>
                </table>
                {{$doencaslist->links()}}
                <a href="{{route('doencas.create')}}"><i class="medium material-icons" style="color: #039be5;">add_circle_outline</i></a>
            </div>
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