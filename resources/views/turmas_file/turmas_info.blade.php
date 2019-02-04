@extends('layouts.app')
@section('breadcrumbs')
    @if (auth()->user()->admin_professor == 1)
        <a href="{{route('turmas.index')}}" class="breadcrumb">Turmas</a>
    @else
        <a href="{{route('professor_turmas', 1)}}" class="breadcrumb">Minhas turmas</a>
    @endif
    <a href="{{route('turma_info', $turma->id)}}" class="breadcrumb">Informações</a>
@endsection
@section('title') Informações da Turma @endsection
@section('content')
    <br><br>
    <div class="container">
        <div class="row">
            <div class="col s12">
                <ul class="tabs blue">
                    <li class="tab col s4"><a href="#coluna1" style="color: white;"><b>Histórico do sistema</b></a></li>
                    <li class="tab col s4"><a href="#coluna2" style="color: white;"><b>Dados registrados</b></a></li>
                    <li class="tab col s4"><a href="#coluna3" style="color: white;"><b>Informações gerais</b></a></li>
                </ul>
            </div>
            <div id="coluna1" class="col s12">
                <div class="col s10">
                    <table>
                        <thead class="centered">
                            <tr>
                                <th>Estado</th>
                                <th>Comentario</th>
                                <th>Horario</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($histturma as $historic)
                                <tr>
                                    <td>@if($historic->inativo == 1) Ativado @else Inativado @endif</td>
                                    <td>@if($historic->comentario == null) Sem comentarios @else {{$historic->comentario}} @endif</td>
                                    @php
                                        $horario = explode(" ",$historic->created_at);
                                        $diamesano = explode("-", $horario[0]);
                                        $horario[0] = $diamesano[2].'/'.$diamesano[1].'/'.$diamesano[0];
                                    @endphp
                                    <td><p>{{$horario[0]}}<br>{{$horario[1]}}</p></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$histturma->links()}}
                </div>
            </div>
            <div id="coluna2" class="col s12">
                <div class="col s10">
                    <table>
                        <tr>
                            <td><h6><b>Nome:</b></h6></td>
                            <td><h6>{{$turma->nome}}</h6></td>
                        </tr>
                        <tr>
                            <td><h6><b>Limite:</b></h6></td>
                            <td><h6>{{$turma->limite}}</h6></td>
                        </tr>
                        <tr>
                            <td><h6><b>Está inativo:</b></h6></td>
                            <td><h6>@if($turma->inativo == 1) Não @else Sim @endif</h6></td>
                        </tr>
                        <tr>
                            <td><h6><b>Descrição:</b></h6></td>
                            <td><h6>@if (isset($turma->descricao)) {{$turma->descricao}} @else Nenhuma descrição escrita @endif</h6></td>
                        </tr>
                        <tr>
                            <td><h6><b>Horario Inicial:<br>Horario Final:</b></h6></td>
                            <td><h6>{{$turma->horario_inicial}}<br>{{$turma->horario_final}}</h6></td>
                        </tr>
                        <tr>
                            <td><h6><b>Dias da semana:</b></h6></td>
                            <td>
                                @foreach ($dias as $dia)
                                    <h6>{{$dia}}</h6>
                                @endforeach
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div id="coluna3" class="col s12">
                <div class="col s10">
                    <div class="row">
                        <div class="col s8">
                            <table>
                                <tr>
                                    <td><h6><b>Quantidade total de pessoas:</b></h6></td>
                                    <td><h6><b>{{$dadosgerais[0]}}</b></h6></td>
                                    <td><i class="small material-icons" style="color: black;">assignment</i></td>
                                </tr>
                                <tr>
                                    <td><h6><b>Quantidade de pessoas Ativa:</b></h6></td>
                                    <td><h6><b>{{$dadosgerais[1]}}</b></h6></td>
                                    <td><i class="small material-icons" style="color: green;">assignment_turned_in</i></td>
                                </tr>
                                <tr>
                                    <td><h6><b>Quantidade de pessoas Inativa:</b></h6></td>
                                    <td><h6><b>{{$dadosgerais[2]}}</b></h6></td>
                                    <td><i class="small material-icons" style="color: red;">assignment_late</i></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <br><br>
                    <a class="waves-effect waves-light btn-large modal-trigger blue"href="#modalregistropessoas">Lista de pessoas ativas na turma<i class="small material-icons right" style="color: green;">assignment_turned_in</i></a>
                </div>
            </div>
        </div>
    </div>
    <div id="modalregistropessoas" class="modal">
        <div class="container">
            <div class="row">
                <div class="col s12">
                    <table class="centered">
                        <thead>
                            <tr>
                                <th>Nome da dpessoa</th>
                                <th>Telefone</th>
                                <th>Mais Informações</th>
                            </tr>
                        </thead>
                        @foreach($turma->pessoas as $pessoa)
                            @if($pessoa->pivot->inativo == 1)
                                <tr>
                                    <td>{{$pessoa->nome}}</td>
                                    <td>{{$pessoa->telefone}}</td>
                                    <td><a class="tooltipped" data-position="top" data-tooltip="Informações de {{$pessoa->nome}}" href="{{Route('pessoa_info', $pessoa->id)}}"><i class="small material-icons" style="color: #039be5;">info_outline</i></a></td>
                                </tr>
                            @endif
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection