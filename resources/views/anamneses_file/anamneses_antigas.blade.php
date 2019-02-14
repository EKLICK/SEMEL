@extends('layouts.app')
@section('breadcrumbs')
    <a href="{{route('anamneses.index2')}}" class="breadcrumb">Anamneses</a>
@endsection
@section('title') Anamneses históricas @endsection
@section('content')
    @include('layouts.Sessoes.mensagem_green')
    <div class="container z-depth-4">
        <div class="card-panel">
            @include('layouts.Sessoes.quant')
            <ul class="collapsible">
                <li>
                    <div class="collapsible-header"><i class="material-icons">filter_list</i>Filtros</div>
                    <div class="collapsible-body">
                        <form action="{{route('anamnese_procurar')}}" method="GET">
                            @csrf
                            <input type="number" name="escolha" value="0" hidden>
                            <div class="row">
                                <div class="input-field col s3 xl1"><i class="material-icons prefix">local_parking</i></div>
                                <div class="input-field col s4 xl2">
                                    <input id="de_peso_search" type="number" step="0.01" class="validate" name="de_peso">
                                    <label for="de_peso_search">De:</label>
                                </div>
                                <div class="input-field col s4 xl2">
                                    <input id="ate_peso_search" type="number" step="0.01" class="validate" name="ate_peso">
                                    <label for="ate_peso_search">Até:</label>
                                </div>
                                <div class="input-field col s3 xl1"><i class="material-icons prefix">format_color_text</i></div>
                                <div class="input-field col s4 xl2">
                                    <input id="de_altura_search" type="number" step="0.01" class="validate" name="de_altura">
                                    <label for="de_altura_search">De:</label>
                                </div>
                                <div class="input-field col s4 xl2">
                                    <input id="ate_altura_search" type="number" step="0.01" class="validate" name="ate_altura">
                                    <label for="ate_altura_search">Até:</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s4 xl2"><label>Toma medicamento:</label></div>
                                <div class="input-field col s6 xl2">
                                    <p>
                                        <label>
                                            <input value="1" name="toma_medicacao" type="radio"/>
                                            <span>Sim</span>
                                        </label>
                                    </p>
                                    <p>
                                        <label>
                                            <input value="2" name="toma_medicacao" type="radio"/>
                                            <span>Não</span>
                                        </label>
                                    </p>
                                </div>
                                <div class="input-field col s4 xl2"><label>Já fez cirurgia:</label></div>
                                <div class="input-field col s6 xl2">
                                    <p>
                                        <label>
                                            <input value="1" name="cirurgia" type="radio"/>
                                            <span>Sim</span>
                                        </label>
                                    </p>
                                    <p>
                                        <label>
                                            <input value="2" name="cirurgia" type="radio"/>
                                            <span>Não</span>
                                        </label>
                                    </p>
                                </div>
                                <div class="input-field col s4 xl2"><label>Fumante:</label></div>
                                <div class="input-field col s6 xl1">
                                    <p>
                                        <label>
                                            <input value="1" name="fumante" type="radio"/>
                                            <span>Sim</span>
                                        </label>
                                    </p>
                                    <p>
                                        <label>
                                            <input value="2" name="fumante" type="radio"/>
                                            <span>Não</span>
                                        </label>
                                    </p>
                                </div>
                                <div class="row">
                                    <div class="input-field col s10 m8 l5 l3">
                                        Possui doenças?
                                        <select multiple name="doencas[]">
                                            @foreach ($doencaslist as $doenca)
                                                <option value="{{$doenca->id}}">{{$doenca->nome}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s3">
                                    <button class="btn waves-effect waves-light light-blue darken-1" type="submit" name="action">Procurar
                                        <i class="material-icons right">search</i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>
            </ul>
            <table class="centered responsive-table highlight bordered">
                <thead>
                    <tr>
                        <th>Nome da pessoa</th>
                        <th>Ano</th>
                        <th>Doenças</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody >
                    @foreach ($anamneseslist as $anamnese)
                        <tr>
                            <td><p>@if(isset($anamnese->pessoas->nome)) {{$anamnese->pessoas->nome}} @else Usuário não cadastrado @endif</p></td>
                            <td><p>{{$anamnese->ano}}</p></td>
                            <td>@if(count($anamnese->doencas) == 0) Não possui @else <a class="tooltipped modal-trigger" data-position="top" data-tooltip="Doenças da anamnese" href="#listadoencas" onclick="modal_doencas({{$anamnese->doencas}})"><i class="small material-icons">info_outline</i></a> @endif</td>
                            <td><a class="tooltipped" data-position="top" data-tooltip="Informações da anamnese" href="{{Route('anamnese_info', $anamnese->id)}}"><i class="small material-icons">info</i></a></td>
                        </tr>
                    @endforeach 
                </tbody>
            </table>
            @if(isset($dataForm))
                {{$anamneseslist->appends($dataForm)->links()}}
            @else
                {{$anamneseslist->links()}}
            @endif
        </div>
    </div>

    <div class="modal" id="listadoencas">
        <div class="container">
            <table class="centered responsive-table highlight bordered" id="lista_de_doencas"></table>
        </div>
    </div>
@endsection