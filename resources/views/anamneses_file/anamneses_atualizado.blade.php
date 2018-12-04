@extends('layouts.app')
@section('breadcrumbs')
    <a href="{{route('anamneses.index')}}" class="breadcrumb">Anamneses</a>
@endsection
@section('title') <h4>Anamneses de {{$ano}}</h4> @endsection
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
            <ul class="collapsible">
                <li>
                    <div class="collapsible-header"><i class="material-icons">location_searching</i>Filtros</div>
                    <div class="collapsible-body">
                        <form action="{{route('anamnese_procurar')}}" method="POST">
                            @csrf
                            <input type="number" name="escolha" value="1" hidden>
                            <div class="row">
                                <div class="col s1"><label>Altura:</label></div>
                                <div class="input-field col s2">
                                    <input id="de_peso_search" type="number" step="0.01" class="validate" name="de_altura">
                                    <label for="de_peso_search">De:</label>
                                </div>
                                <div class="input-field col s2">
                                    <input id="ate_search" type="number" step="0.01" class="validate" name="ate_altura">
                                    <label for="ate_search">Até:</label>
                                </div>
                                <div class="col s1"><label>Peso:</label></div>
                                <div class="input-field col s2">
                                    <input id="de_search" type="number" step="0.01" class="validate" name="de_peso">
                                    <label for="de_search">De:</label>
                                </div>
                                <div class="input-field col s2">
                                    <input id="ate_altura_search" type="number" step="0.01" class="validate" name="ate_peso">
                                    <label for="ate_altura_search">Até:</label>
                                </div>  
                            </div>
                            <div class="row">
                                <div class="input-field col s2"><label>Toma medicamento:</label></div>
                                <div class="input-field col s2">
                                    <p>
                                        <label>
                                            <input value="1" name="toma_medicacao" type="radio"/>
                                            <span>Sim</span>
                                        </label>
                                    </p>
                                    <p>
                                        <label>
                                            <input value="0" name="toma_medicacao" type="radio"/>
                                            <span>Não</span>
                                        </label>
                                    </p>
                                </div>
                                <div class="input-field col s2"><label>Já fez cirurgia:</label></div>
                                <div class="input-field col s2">
                                    <p>
                                        <label>
                                            <input value="1" name="cirurgia" type="radio"/>
                                            <span>Sim</span>
                                        </label>
                                    </p>
                                    <p>
                                        <label>
                                            <input value="0" name="cirurgia" type="radio"/>
                                            <span>Não</span>
                                        </label>
                                    </p>
                                </div>
                                <div class="input-field col s2"><label>Fumante:</label></div>
                                <div class="input-field col s1">
                                    <p>
                                        <label>
                                            <input value="1" name="fumante" type="radio"/>
                                            <span>Sim</span>
                                        </label>
                                    </p>
                                    <p>
                                        <label>
                                            <input value="0" name="fumante" type="radio"/>
                                            <span>Não</span>
                                        </label>
                                    </p>
                                </div>
                                <div class="row">
                                    <div class="input-field col s3">
                                        Possui doenças?
                                        <select multiple name="doencas[]">
                                            @foreach ($doencaslist as $doenca)
                                                <option value="{{$doenca->id}}">{{$doenca->nome}}</option>
                                            @endforeach
                                        </select>
                                        <input type="text" value="0" name="possui_doenca" hidden>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s3">
                                    <button class="btn waves-effect waves-light" type="submit" name="action">Procurar
                                        <i class="material-icons right">search</i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>
            </ul>
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
@endsection