@extends('layouts.app')
@section('breadcrumbs')
    @if(auth()->user()->admin_professor == 1)
        <a href="{{route('professor.index')}}" class="breadcrumb">Professores</a>
    @endif
    <a href="{{route('professor_info', $professor->id)}}" class="breadcrumb">Informações</a>
@endsection
@section('title') Informações de <?php $nomes = explode(' ',$professor->nome);?> {{$nomes[0]}} @endsection
@section('content')
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
                <div class="col s12">
                    <table>
                        <thead class="centered">
                            <tr>
                                <th style='width: 90px;'>Estado</th>
                                <th style='width: 210px;'>Turma do registro</th>
                                <th style='width: 150px;'>Comentario</th>
                                <th style='width: 150px;'>Horario de mudança</th>
                                <th style='width: 100px;'>Administrador responsável</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($histprofessor as $historic)
                                <tr>
                                    <td>@if($historic->inativo == 1) Ativado @else Inativado @endif</td>
                                    @php $idturma = $historic->turma_id @endphp
                                    <td>
                                        @foreach($professor->turmas as $turmadapessoa)
                                            @if($turmadapessoa->id == $historic->turma_id) {{$turmadapessoa->nome}} @php break @endphp @endif
                                        @endforeach
                                    </td>
                                    <td>@if($historic->comentario == null) Sem comentarios @else {{$historic->comentario}} @endif</td>
                                    @php
                                        $horario = explode(" ",$historic->created_at);
                                        $diamesano = explode("-", $horario[0]);
                                        $horario[0] = $diamesano[2].'/'.$diamesano[1].'/'.$diamesano[0];
                                    @endphp
                                    <td><p>{{$horario[0]}}<br>{{$horario[1]}}</p></td>
                                    <td>{{$historic->operario}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$histprofessor->links()}}
                </div>
            </div>
            <div id="coluna2" class="col s12">
                <div class="col s6">
                    <table>
                        <tr>
                            <td><h6><b>Nome:</b></h6></td>
                            <td><h6>{{$professor->nome}}</h6></td>
                        </tr>
                        <tr>
                            <td><h6><b>Nacimento:</b></h6></td>
                            <td><h6>{{$professor->nascimento}}</h6></td>
                        </tr>
                        <tr>
                            <td><h6><b>Matricula:</b></h6></td>
                            <td><h6>{{$professor->matricula}}</h6></td>
                        </tr>
                        <tr>
                            <td><h6><b>Telefone:</b></h5></td>
                            <td><h6>{{$professor->telefone}}</h6></td>
                        </tr>
                        <tr>
                            <td><h6><b>E-mail:</b></h5></td>
                            <td><h6>{{$professor->email}}</h6></td>
                        </tr>
                        <tr>
                            <td><h6><b>CPF:</b></h5></td>
                            <td><h6>{{$professor->cpf}}</h6></td>
                        </tr>
                        <tr>
                            <td><h6><b>RG:</b></h5></td>
                            <td><h6>{{$professor->rg}}</h6></td>
                        </tr>
                    </table>
                </div>
                <div class="col s6">
                    <table>
                        <tr>
                            <td><h6><b>Bairro:</b></h5></td>
                            <td><h6>{{$professor->bairro}}</h6></td>
                        </tr>
                        <tr>
                            <td><h6><b>Rua:</b></h5></td>
                            <td><h6>{{$professor->rua}}</h6></td>
                        </tr>
                        <tr>
                            <td><h6><b>Numero:</b></h5></td>
                            <td><h6>{{$professor->numero_endereco}}</h6></td>
                        </tr>
                        <tr>
                            <td><h6><b>CEP:</b></h5></td>
                            <td><h6>{{$professor->cep}}</h6></td>
                        </tr>
                        <tr>
                            <td><h6><b>Curso:</b></h5></td>
                            <td><h6>{{$professor->curso}}</h6></td>
                        </tr>
                        <tr>
                            <td><h6><b>Formação:</b></h5></td>
                            <td><h6>{{$professor->formacao}}</h6></td>
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
                                    <td><h6><b>Quantidade total de turmas:</b></h6></td>
                                    <td><h6><b>{{$dadosgerais[0]}}</b></h6></td>
                                    <td><i class="small material-icons" style="color: black;">assignment</i></td>
                                </tr>
                                <tr>
                                    <td><h6><b>Quantidade de turmas Ativa:</b></h6></td>
                                    <td><h6><b>{{$dadosgerais[1]}}</b></h6></td>
                                    <td><i class="small material-icons" style="color: green;">assignment_turned_in</i></td>
                                </tr>
                                <tr>
                                    <td><h6><b>Quantidade de turmas Inativa:</b></h6></td>
                                    <td><h6><b>{{$dadosgerais[2]}}</b></h6></td>
                                    <td><i class="small material-icons" style="color: red;">assignment_late</i></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <br><br>
                    <a class="waves-effect waves-light btn-large modal-trigger blue"href="#modalregistroturmasnucleo">Lista de núcleos e turma da pessoa</a>
                </div>
            </div>
        </div>
    </div>
    <div id="modalregistroturmasnucleo" class="modal">
        <div class="container">
            <div class="row">
                <h5>Núcleo no qual o professor está Ativo</h5>
                <div class="col s10">
                    <table class="centered">
                        <thead>
                            <tr>
                                <th>Nome do núcleo</th>
                                <th>Estado</th>
                                @if(auth()->user()->admin_professor == 1)<th>Mais Informações</th>@endif
                            </tr>
                        </thead>
                        @foreach($listnucleoprofessor as $nucleo)
                            <tr>
                                <td>{{$nucleo->nome}}</td>
                                <td><i class="small material-icons" style="color: @if($nucleo->inativo == 1) green @else red @endif;">@if($nucleo->inativo == 1) assignment_turned_in @else assignment_late  @endif</i></td>
                                @if(auth()->user()->admin_professor == 1)
                                    <td><a class="tooltipped" data-position="top" data-tooltip="Informações de {{$nucleo->nome}}" href="{{route('nucleo_info', $nucleo->id)}}"><i class="small material-icons">info_outline</i></a></td>
                                @endif
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            <br><br>
            <div class="row">
                <h5>Turmas no qual ao professor está Ativo &nbsp <i class="small material-icons" style="color: green;">assignment_turned_in</i></h5>
                <div class="col s10">
                    <table class="centered">
                        <thead>
                            <th>Nome da turma</th>
                            <th>Estado da turma</th>
                            @if(auth()->user()->admin_professor == 1)<th>Mais Informações</th>@endif
                        </thead>
                        <tbody>
                            @foreach ($professor->turmas as $turma)
                                @if($turma->pivot->inativo == 1)
                                    <tr>
                                        <td>{{$turma->nome}}</td>
                                        <td><i class="small material-icons" style="color: @if($turma->inativo == 1) green @else red @endif;">@if($turma->inativo == 1) assignment_turned_in @else assignment_late  @endif</i></td>
                                        @if(auth()->user()->admin_professor == 1)
                                            <td><a class="tooltipped" data-position="top" data-tooltip="Informações de {{$turma->nome}}" href="{{route('turma_info', $turma->id)}}"><i class="small material-icons">info_outline</i></a></td>
                                        @endif
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <br><br>
            <div class="row">
                <h5>Turmas no qual ao professor está Inativo &nbsp <i class="small material-icons" style="color: red;">assignment_late</i></h5>
                <div class="col s10">
                    <table class="centered">
                        <thead>
                            <th>Nome da turma</th>
                            <th>Estado da turma</th>
                            @if(auth()->user()->admin_professor == 1)<th>Mais Informações</th>@endif
                        </thead>
                        <tbody>
                            @foreach ($professor->turmas as $turma)
                                @if($turma->pivot->inativo == 2)
                                    <tr>
                                        <td>{{$turma->nome}}</td>
                                        <td><i class="small material-icons" style="color: @if($turma->inativo == 1) green @else red @endif;">@if($turma->inativo == 1) assignment_turned_in @else assignment_late  @endif</i></td>
                                        @if(auth()->user()->admin_professor == 1)
                                            <td><a class="tooltipped" data-position="top" data-tooltip="Informações de {{$turma->nome}}" href="{{route('turma_info', $turma->id)}}"><i class="small material-icons">info_outline</i></a></td>
                                        @endif
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection