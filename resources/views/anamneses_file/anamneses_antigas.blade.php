@extends('layouts.app')

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
    <div class="section">
        <div class="container">
            <h4>Anamneses históricas</h4>
            <div class="divider"></div>
        </div>
    
        <div class="container z-depth-4">
            <div class="card-panel">
                <table class="centered">
                    <thead>
                        <tr>
                            <th>Nome da pessoa</th>
                            <th>Ano</th>
                            <th>Quant Doenças</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody >
                        @foreach ($anamneseslist as $anamnese)
                            <tr>
                                <td><p>@if(isset($anamnese->pessoas->nome)) {{$anamnese->pessoas->nome}} @else Usuário não cadastrado @endif</p></td>
                                <td><p>{{$anamnese->ano}}</p></td>
                                <td><p>{{count($anamnese->doencas)}}</p></td>
                                <td>
                                    <a class="tooltipped" data-position="top" data-tooltip="Informações da anamnese" href="{{Route('anamnese_info', $anamnese->id)}}"><i class="small material-icons" style="color: #039be5;">info</i></a>
                                    <a class="tooltipped" data-position="top" data-tooltip="Editar anamnese" href="{{Route('anamneses.edit', $anamnese->id)}}"><i class="small material-icons" style="color: #039be5;">edit</i></a>
                                </td>
                            </tr>
                        @endforeach 
                    </tbody>
                </table>
                {{$anamneseslist->links()}}
            </div>
        </div>
    </div>
@endsection