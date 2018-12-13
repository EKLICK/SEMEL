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
            @if(Session::get('quant'))
                <div class="center-align quantmens">
                    <div class="chip light-blue accent-2 lighten-2">
                        {{Session::get('quant')}}
                        <i class="close material-icons">close</i>
                    </div>
                </div>
                {{Session::forget('quant')}}
            @endif
            <ul class="collapsible">
                <li>
                    <div class="collapsible-header"><i class="material-icons">filter_list</i>Filtros</div>
                    <div class="collapsible-body">
                        <form action="{{route('pessoas_procurar')}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="input-field col s4">
                                    <i class="material-icons prefix">account_circle</i>
                                    <input placeholder="Nome da pessoa" id="nome_search" type="text" class="validate" name="nome">
                                </div>
                                <div class="input-field col s1"><i class="material-icons prefix">date_range</i></div>
                                <div class="input-field col s2">
                                    <input id="de_search" type="text" class="datepicker validate" name="de">
                                    <label for="de_search">De:</label>
                                </div>
                                <div class="input-field col s2">
                                    <input id="ate_search" type="text" class="datepicker validate" name="ate">
                                    <label for="ate_search">Até:</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s3">
                                    <i class="material-icons prefix">assignment_ind</i>
                                    <input placeholder="RG" id="rg_search" type="text" class="validate" name=rg>
                                </div>
                                <div class="input-field col s3">
                                    <i class="material-icons prefix">credit_card</i>
                                    <input placeholder="CPF" id="cpf_search" type="text" class="validate" name="cpf">
                                </div>
                                <div class="input-field col s3">
                                    <i class="material-icons prefix">phone</i>
                                    <input placeholder="Telefone" id="telefone_search" type="text" class="validate" name="telefone">
                                    <label for="telefone_search">Telefone</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s4">
                                    <i class="material-icons prefix">location_city</i>
                                    <input placeholder="Bairro" id="bairro_search" type="text" class="validate" name="bairro">
                                    <label for="bairro_search">Bairro</label>
                                </div>
                                <div class="input-field col s4">
                                    <i class="material-icons prefix">confirmation_number</i>
                                    <input name="rua" id="rua" type="text" class="validate">
                                    <label for="rua">Rua:</label>
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
                        <th>Atualizações</th>
                        <th>Estatos</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pessoaslist as $pessoa)
                        <tr>
                            <td><p>{{$pessoa->nome}}</p></td>
                            <td><p>{{$pessoa->anamneses->last()->ano}}</p><i class="small material-icons" @if($pessoa->anamneses->last()->ano != $ano) style="color: red;" @else style="color: green;"  @endif>sim_card_alert</i></td>
                            <td><p>Incompleto</p></td>
                            <td>
                                <a class="tooltipped" data-position="top" data-tooltip="Informações de {{$pessoa->nome}}" href="{{Route('pessoa_info', $pessoa->id)}}"><i class="small material-icons" style="color: #039be5;">info</i></a>
                                <a class="tooltipped" data-position="top" data-tooltip="Lista de anamneses de {{$pessoa->nome}}" href="{{Route('lista_anamnese', $pessoa->id)}}"><i class="small material-icons" style="color: #039be5;">description</i></a>
                                <a class="tooltipped" data-position="top" data-tooltip="Lista de turmas de {{$pessoa->nome}}" href="{{Route('pessoas_turmas', $pessoa->id)}}"><i class="small material-icons" style="color: #039be5;">group</i></a>
                                <a class="tooltipped" data-position="top" data-tooltip="Editar {{$pessoa->nome}}" @if($pessoa->nascimento < 18) href="{{Route('pessoas_edit_menores', $pessoa->id)}}" @else href="{{Route('pessoas_edit_maiores', $pessoa->id)}}" @endif><i class="small material-icons" style="color: #039be5;">edit</i></a>
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