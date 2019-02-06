@extends('layouts.app')

@section('breadcrumbs')
    <a href="{{route('home')}}" class="breadcrumb">Pessoas</a>
    @if(isset($pessoa->deleted_at)) <a href="{{route('pessoas_softdeletes')}}" class="breadcrumb">Deletadas</a> @endif
    <a href="{{Route('pessoa_info', $pessoa->id)}}" class="breadcrumb">Informações</a>
@endsection
@section('title') Informações de <?php $nomes = explode(' ',$pessoa->nome);?> {{$nomes[0]}} @endsection
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
        </div>
        <div class="row">
            <div id="coluna1" class="col s12">
                <div class="col s10">
                    <table>
                        <thead class="centered">
                            <tr>
                                <th>Estado</th>
                                <th>Turma do registro</th>
                                <th>Comentario</th>
                                <th>Horario</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($histpessoa as $historic)
                                <tr>
                                    <td>@if($historic->inativo == 1) Ativado @else Inativado @endif</td>
                                    @php $idturma = $historic->turma_id @endphp
                                    <td>
                                        @foreach($pessoa->turmas as $turmadapessoa)
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
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$histpessoa->links()}}
                </div>
            </div>
            <div id="coluna2" class="col s12">
                <div class="row">
                    <div class="col s6">
                        <table>
                            <tr>
                                <td><h6><b>Nome:</b></h6></td>
                                <td><h6>{{$pessoa->nome}}</h6></td>
                            </tr>
                            <tr>
                                <td><h6><b>Nascimento:</b></h6></td>
                                <td><h6>{{$pessoa->nascimento}}</h6></td>
                            </tr>
                            <tr>
                                <td><h6><b>RG:</b></h6></td>
                                <td>
                                    <h6>
                                        @if($pessoa->rg != null) {{$pessoa->rg}} 
                                        @else <i class="small material-icons" style="color: red;">assignment_late</i> @endif
                                    </h6>
                                </td>
                            </tr>
                            <tr>
                                <td><h6><b>CPF:</b></h6></td>
                                <td>
                                    <h6>
                                        @if($pessoa->cpf != null) {{$pessoa->cpf}} 
                                        @else <i class="small material-icons" style="color: red;">assignment_late</i> @endif
                                    </h6>
                                </td>
                            </tr>
                            <tr>
                                <td><h6><b>Cidade:</b></h6></td>
                                <td>
                                    <h6>
                                        @if($pessoa->cidade != null) {{$pessoa->cidade}} 
                                        @else <i class="small material-icons" style="color: red;">assignment_late</i> @endif
                                    </h6>
                                </td>
                            </tr>
                            <tr>
                                <td><h6><b>Bairro:</b></h6></td>
                                <td>
                                    <h6>
                                        @if($pessoa->bairro != null) {{$pessoa->bairro}} 
                                        @else <i class="small material-icons" style="color: red;">assignment_late</i> @endif
                                    </h6>
                                </td>
                            </tr>
                            <tr>
                                <td><h6><b>Rua:</b></h6></td>
                                <td>
                                    <h6>
                                        @if($pessoa->rua != null) {{$pessoa->rua}} 
                                        @else <i class="small material-icons" style="color: red;">assignment_late</i> @endif
                                    </h6>
                                </td>
                            </tr>
                            <tr>
                                <td><h6><b>Numero:</b></h6></td>
                                <td>
                                    <h6>
                                        @if($pessoa->numero_endereco != null) {{$pessoa->numero_endereco}} 
                                        @else <i class="small material-icons" style="color: red;">assignment_late</i> @endif
                                    </h6>
                                </td>
                            </tr>
                            <tr>
                                <td><h6><b>CEP:</b></h6></td>
                                <td>
                                    <h6>
                                        @if($pessoa->cep != null) {{$pessoa->cep}} 
                                        @else <i class="small material-icons" style="color: red;">assignment_late</i> @endif
                                    </h6>
                                </td>
                            </tr>
                            <tr>
                                <td><h6><b>Telefone:</b></h6></td>
                                <td>
                                    <h6>
                                        @if($pessoa->telefone != null) {{$pessoa->telefone}} 
                                        @else <i class="small material-icons" style="color: red;">assignment_late</i> @endif
                                    </h6>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col s6">
                        <table>
                            <tr>
                                <td><h6><b>Telefone de emergência:</b></h6></td>
                                <td>
                                    <h6>
                                        @if($pessoa->telefone_emergencia != null) {{$pessoa->telefone_emergencia}} 
                                        @else <i class="small material-icons" style="color: red;">assignment_late</i> @endif
                                    </h6>
                                </td>
                            </tr>
                            <tr>
                                <td><h6><b>Sexo:</b></h5></td>
                                <td><h6>@if ($pessoa->sexo == 'M') Masculino @else Feminino @endif</h6></td>
                            </tr>
                            <tr>
                                <td><h6><b>Estado civil:</b></h6></td>
                                <td>
                                    <h6>
                                        @if($pessoa->estado_civil != null) {{$pessoa->estado_civil}} 
                                        @else <i class="small material-icons" style="color: red;">assignment_late</i> @endif
                                    </h6>
                                </td>
                            </tr>
                            <tr>
                                <td><h6><b>Nome do pai:</b></h6></td>
                                <td>
                                    <h6>
                                        @if($pessoa->nome_do_pai != null) {{$pessoa->nome_do_pai}} 
                                        @else <i class="small material-icons" style="color: red;">assignment_late</i> @endif
                                    </h6>
                                </td>
                            </tr>
                            <tr>
                                <td><h6><b>Nome da mãe:</b></h6></td>
                                <td>
                                    <h6>
                                        @if($pessoa->nome_da_mae != null) {{$pessoa->nome_da_mae}} 
                                        @else <i class="small material-icons" style="color: red;">assignment_late</i> @endif
                                    </h6>
                                </td>
                            </tr>
                            <tr>
                                <td><h6><b>Pessoa para emergência:</b></h6></td>
                                <td>
                                    <h6>
                                        @if($pessoa->pessoa_emergencia != null) {{$pessoa->pessoa_emergencia}} 
                                        @else <i class="small material-icons" style="color: red;">assignment_late</i> @endif
                                    </h6>
                                </td>
                            </tr>
                            <tr>
                                <td><h6><b>Convenio médico:</b></h6></td>
                                <td>
                                    <h6>
                                        @if($pessoa->convenio_medico != null || $pessoa->convenio_medico == -1)
                                            @if($pessoa->convenio_medico != null) {{$pessoa->convenio_medico}}
                                            @else Não possui @endif
                                        @else <i class="small material-icons" style="color: red;">assignment_late</i> @endif
                                    </h6>
                                </td>
                            </tr>
                            <tr>
                                <td><h6><b>Mora com os pais:</b></h6></td>
                                <td>
                                    <h6>
                                        @if($pessoa->mora_com_os_pais != null)
                                            @if($pessoa->mora_com_os_pais == 1) Sim @else Não @endif
                                        @else <i class="small material-icons" style="color: red;">assignment_late</i> @endif
                                    </h6>
                                </td>
                            </tr>
                            <tr>
                                <td><h6><b>Quantidade de filhos:</b></h6></td>
                                <td><h6>{{$pessoa->filhos}}</h6></td>
                            </tr>
                            <tr>
                                <td><h6><b>Quantidade de irmãos:</b></h6></td>
                                <td><h6>{{$pessoa->irmaos}}</h6></td>
                            </tr>
                            <tr>
                                <td><h6><b>Está inativo:</b></h6></td>
                                <td><h6>@if($pessoa->inativo == null) Sim @else Não @endif</h6></td>
                            </tr>
                        </table>
                    </div>
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
                <h5>Núcleo no qual a pessoa está Ativa</h5>
                <div class="col s10">
                    <table class="centered">
                        <thead>
                            <tr>
                                <th>Nome do núcleo</th>
                                <th>Estado</th>
                                <th>Mais Informações</th>
                            </tr>
                        </thead>
                        @foreach($listnucleopessoa as $nucleo)
                            <tr>
                                <td>{{$nucleo->nome}}</td>
                                <td><i class="small material-icons" style="color: @if($nucleo->inativo == 1) green @else red @endif;">@if($nucleo->inativo == 1) assignment_turned_in @else assignment_late  @endif</i></td>
                                <td><a class="tooltipped" data-position="top" data-tooltip="Informações de {{$nucleo->nome}}" href="{{route('nucleo_info', $nucleo->id)}}"><i class="small material-icons" style="color: #039be5;">info_outline</i></a></td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            <br><br>
            <div class="row">
                <h5>Turmas no qual a pessoa está Ativa &nbsp <i class="small material-icons" style="color: green;">assignment_turned_in</i></h5>
                <div class="col s10">
                    <table class="centered">
                        <thead>
                            <th>Nome da turma</th>
                            <th>Estado da turma</th>
                            <th>Mais Informações</th>
                        </thead>
                        <tbody>
                            @foreach ($pessoa->turmas as $turma)
                                @if($turma->pivot->inativo == 1)
                                    <tr>
                                        <td>{{$turma->nome}}</td>
                                        <td><i class="small material-icons" style="color: @if($turma->inativo == 1) green @else red @endif;">@if($turma->inativo == 1) assignment_turned_in @else assignment_late  @endif</i></td>
                                        <td><a class="tooltipped" data-position="top" data-tooltip="Informações de {{$turma->nome}}" href="{{route('turma_info', $turma->id)}}"><i class="small material-icons" style="color: #039be5;">info_outline</i></a></td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <br><br>
            <div class="row">
                <h5>Turmas no qual a pessoa está Inativa &nbsp <i class="small material-icons" style="color: red;">assignment_late</i></h5>
                <div class="col s10">
                    <table class="centered">
                        <thead>
                            <th>Nome da turma</th>
                            <th>Estado da turma</th>
                            <th>Mais Informações</th>
                        </thead>
                        <tbody>
                            @foreach ($pessoa->turmas as $turma)
                                @if($turma->pivot->inativo == 2)
                                    <tr>
                                        <td>{{$turma->nome}}</td>
                                        <td><i class="small material-icons" style="color: @if($turma->inativo == 1) green @else red @endif;">@if($turma->inativo == 1) assignment_turned_in @else assignment_late  @endif</i></td>
                                        <td><a class="tooltipped" data-position="top" data-tooltip="Informações de {{$turma->nome}}" href="{{route('turma_info', $turma->id)}}"><i class="small material-icons" style="color: #039be5;">info_outline</i></a></td>
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