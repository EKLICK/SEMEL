@extends('layouts.app')

@section('content')
    <div class="section">
        <div class="container">
            <h4>Professores deletados</h4>
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
                                    <a class="tooltipped" data-position="top" data-tooltip="Restaurar {{$professor->nome}}" href="{{Route('professor_restore', $professor->id)}}"><i class="small material-icons" style="color: #039be5;">restore</i></a>
                                </td>
                            </tr>
                        @endforeach 
                    </tbody>
                </table>
                {{$professoreslist->links()}}
            </div>
        </div>
    </div>
@endsection