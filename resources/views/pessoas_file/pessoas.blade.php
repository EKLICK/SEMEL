@extends('layouts.app')
@section('breadcrumbs')
    <a href="{{route('home')}}" class="breadcrumb">Pessoas</a>
@endsection
@section('title') Pessoas registradas @endsection
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
                        <form action="{{route('pessoas_procurar')}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="input-field col s6">
                                    <input placeholder="Nome" id="nome_search" type="text" class="validate" name="nome">
                                    <label for="nome_search">Nome</label>
                                </div>
                                <div class="col s1"><label>Idade:</label></div>
                                <div class="input-field col s2">
                                    <input id="de_search" type="number" class="validate" name="de">
                                    <label for="de_search">De:</label>
                                </div>
                                <div class="input-field col s2">
                                    <input id="ate_search" type="number" class="validate" name="ate">
                                    <label for="ate_search">Até:</label>
                                </div>  
                            </div>
                            <!--
                            <div class="row">
                                <div class="input-field col s3">
                                    <input placeholder="RG" id="rg_search" type="text" class="validate" name=rg>
                                    <label for="rg_search">RG</label>
                                </div>
                                <div class="input-field col s3">
                                    <input placeholder="CPF" id="cpf_search" type="text" class="validate" name="cpf">
                                    <label for="cpf_search">CPF</label>
                                </div>
                                <div class="input-field col s3">
                                    <input placeholder="Bairro" id="bairro_search" type="text" class="validate" name="bairro">
                                    <label for="bairro_search">Bairro</label>
                                </div>
                                <div class="input-field col s3">
                                    <input placeholder="Telefone" id="telefone_search" type="text" class="validate" name="telefone">
                                    <label for="telefone_search">Telefone</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s1"><label>Sexo:</label></div>
                                <div class="input-field col s3">
                                    <p>
                                        <label>
                                            <input value="F" name="sexo" type="radio"/>
                                            <span>Feminino</span>
                                        </label>
                                    </p>
                                    <p>
                                        <label>
                                            <input value="M" name="sexo" type="radio"/>
                                            <span>Masculino</span>
                                        </label>
                                    </p>
                                </div>
                                <div class="input-field col s2"><label>Estado civil:</label></div>
                                <div class="input-field col s3">
                                    <p>
                                        <label>
                                            <input value="Casado" name="estado_civil" type="radio"/>
                                            <span>Casado</span>
                                        </label>
                                    </p>
                                    <p>
                                        <label>
                                            <input value="Solteiro" name="estado_civil" type="radio"/>
                                            <span>Solteiro</span>
                                        </label>
                                    </p>
                                </div>
                                <div class="input-field col s1"><label>Inativo:</label></div>
                                <div class="input-field col s2">
                                    <p>
                                        <label>
                                            <input value="0" name="inativo" type="radio"/>
                                            <span>Sim</span>
                                        </label>
                                    </p>
                                    <p>
                                        <label>
                                            <input value="1" name="inativo" type="radio"/>
                                            <span>Não</span>
                                        </label>
                                    </p>
                                </div>
                            </div>
                            -->
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
                                <a class="tooltipped" data-position="top" data-tooltip="Informações de {{$pessoa->nome}}" href="{{Route('pessoa_info', $pessoa->id)}}"><i class="small material-icons" style="color: #039be5;">info</i></a>
                                <a class="tooltipped" data-position="top" data-tooltip="Lista de anamneses de {{$pessoa->nome}}" href="{{Route('lista_anamnese', $pessoa->id)}}"><i class="small material-icons" style="color: #039be5;">description</i></a>
                                <a class="tooltipped" data-position="top" data-tooltip="Lista de turmas de {{$pessoa->nome}}" href="{{Route('pessoas_turmas', $pessoa->id)}}"><i class="small material-icons" style="color: #039be5;">group</i></a>
                                <a class="tooltipped" data-position="top" data-tooltip="Editar {{$pessoa->nome}}" href="{{Route('pessoas.edit', $pessoa->id)}}"><i class="small material-icons" style="color: #039be5;">edit</i></a>
                                <a class="tooltipped modal-trigger" data-position="top" data-tooltip="Deletar {{$pessoa->nome}}" id="btn-delete" data-id="{{$pessoa->id}}" data-nome="{{$pessoa->nome}}" href="#modaldelete"><i class="small material-icons" style="color: #039be5;">delete</i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{$pessoaslist->links()}}
            <a class="tooltipped" data-position="top" data-tooltip="Adicionar pessoa" href="{{route('pessoas_select')}}"><i class="medium material-icons" style="color: #039be5;">add_circle_outline</i></a>
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