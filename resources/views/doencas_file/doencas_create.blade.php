@extends('layouts.app')
@section('css.personalizado')@endsection
@section('breadcrumbs')
    <a href="{{route('doencas.index')}}" class="breadcrumb">Doenças</a>
    <a href="{{route('doencas.create')}}" class="breadcrumb">Criar</a>
@endsection
@section('title') Criar doença @endsection
@section('content')
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
    <div class="container" style="margin-top: 3%;">
        <div class="card">
            <div class="row">
                <form class="col s12" action="{{route('doencas.store')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="input-field col s6">
                            <i class="material-icons prefix">warning</i>
                            <input name="nome" id="icon_prefix" type="text" class="validate">
                            <label for="icon_prefix">Nome da doença:</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s8">
                            <i class="material-icons prefix">description</i>
                            <textarea name="descricao" id="descricao" class="materialize-textarea"></textarea>
                            <label for="descricao">Observação</label>
                        </div>
                    </div>
                    <button style="margin-bottom: 2%;" class="btn waves-effect waves-light" type="submit" name="action">Enviar
                        <i class="material-icons right">send</i>
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection