@extends('layouts.app')
@section('css.personalizado')@endsection
@section('breadcrumbs')
    <a href="{{route('doencas.index')}}" class="breadcrumb">Doenças</a>
    <a href="{{route('doencas.create')}}" class="breadcrumb">Criar</a>
@endsection
@section('title') Administração para PDF (pessoas) @endsection
@section('content')
    <div class="container">
        <div class="row">
            <form action="{{route('pessoas_pdf')}}" method="GET">
                @csrf
                <div class="row">
                    <div class="input-field col s6">
                        <button class="btn waves-effect waves-light blue" type="submit" name="action">Gerar relatório
                            <i class="material-icons right">send</i>
                        </button>
                    </div>
                    <div class="input-field col s6">
                        <p>
                            <label>
                                <input name="option_order[]" type="checkbox" />
                                <span>Ordenar por Nome</span>
                            </label>
                        </p>
                        <p>
                            <label>
                                <input name="option_order[]" type="checkbox" />
                                <span>Ordenar por data de nascimento</span>
                            </label>
                        </p>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="input-field col s6">
                        <h5><b>Nome</b></h5></td>
                    </div>
                    <div class="input-field col s1">
                        <i class="material-icons prefix" style="color:red;">cancel</i>
                    </div>
                    <div class="input-field col s2" style="margin-top:3%;">
                        <div class="switch">
                            <label>
                                Não
                                <input name="nome" type="checkbox" checked>
                                <span class="lever"></span>
                                Sim
                            </label>
                        </div>
                    </div>
                    <div class="input-field col s2">
                        <i class="material-icons prefix" style="color:green;">check_circle</i>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="input-field col s6">
                        <h5><b>Endereço</b></h5></td>
                    </div>
                    <div class="input-field col s1">
                        <i class="material-icons prefix" style="color:red;">cancel</i>
                    </div>
                    <div class="input-field col s2" style="margin-top:3%;">
                        <div class="switch">
                            <label>
                                Não
                                <input name="endereco" type="checkbox" checked>
                                <span class="lever"></span>
                                Sim
                            </label>
                        </div>
                    </div>
                    <div class="input-field col s2">
                        <i class="material-icons prefix" style="color:green;">check_circle</i>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="input-field col s6">
                        <h5><b>Telefone</b></h5></td>
                    </div>
                    <div class="input-field col s1">
                        <i class="material-icons prefix" style="color:red;">cancel</i>
                    </div>
                    <div class="input-field col s2" style="margin-top:3%;">
                        <div class="switch">
                            <label>
                                Não
                                <input name="telefone" type="checkbox" checked>
                                <span class="lever"></span>
                                Sim
                            </label>
                        </div>
                    </div>
                    <div class="input-field col s2">
                        <i class="material-icons prefix" style="color:green;">check_circle</i>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="input-field col s6">
                        <h5><b>Telefone de emergencia</b></h5></td>
                    </div>
                    <div class="input-field col s1">
                        <i class="material-icons prefix" style="color:red;">cancel</i>
                    </div>
                    <div class="input-field col s2" style="margin-top:3%;">
                        <div class="switch">
                            <label>
                                Não
                                <input name="telefone_emergencia" type="checkbox" checked>
                                <span class="lever"></span>
                                Sim
                            </label>
                        </div>
                    </div>
                    <div class="input-field col s2">
                        <i class="material-icons prefix" style="color:green;">check_circle</i>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="input-field col s6">
                        <h5><b>Data de nascimento</b></h5></td>
                    </div>
                    <div class="input-field col s1">
                        <i class="material-icons prefix" style="color:red;">cancel</i>
                    </div>
                    <div class="input-field col s2" style="margin-top:3%;">
                        <div class="switch">
                            <label>
                                Não
                                <input name="data_nascimento" type="checkbox" checked>
                                <span class="lever"></span>
                                Sim
                            </label>
                        </div>
                    </div>
                    <div class="input-field col s2">
                        <i class="material-icons prefix" style="color:green;">check_circle</i>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="input-field col s6">
                        <h5><b>RG</b></h5></td>
                    </div>
                    <div class="input-field col s1">
                        <i class="material-icons prefix" style="color:red;">cancel</i>
                    </div>
                    <div class="input-field col s2" style="margin-top:3%;">
                        <div class="switch">
                            <label>
                                Não
                                <input name="rg" type="checkbox" checked>
                                <span class="lever"></span>
                                Sim
                            </label>
                        </div>
                    </div>
                    <div class="input-field col s2">
                        <i class="material-icons prefix" style="color:green;">check_circle</i>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="input-field col s6">
                        <h5><b>Usuário morto</b></h5></td>
                    </div>
                    <div class="input-field col s1">
                        <i class="material-icons prefix" style="color:red;">cancel</i>
                    </div>
                    <div class="input-field col s2" style="margin-top:3%;">
                        <div class="switch">
                            <label>
                                Não
                                <input name="morto" type="checkbox" checked>
                                <span class="lever"></span>
                                Sim
                            </label>
                        </div>
                    </div>
                    <div class="input-field col s2">
                        <i class="material-icons prefix" style="color:green;">check_circle</i>
                    </div>
                </div>
                <hr>
            </form>
        </div>
    </div>
@endsection