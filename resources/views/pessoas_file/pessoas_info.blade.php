@extends('layouts.app')

@section('breadcrumbs')
    <a href="{{route('home')}}" class="breadcrumb">Pessoas</a>
    @if(isset($pessoa->deleted_at)) <a href="{{route('pessoas_softdeletes')}}" class="breadcrumb">Deletadas</a> @endif
    <a href="{{Route('pessoa_info', $pessoa->id)}}" class="breadcrumb">Informações</a>
@endsection
@section('title') Informações de <?php $nomes = explode(' ',$pessoa->nome);?> {{$nomes[0]}} @endsection
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
                                <th>Estado</th>
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
                                <td><h6>Nome:</h6></td>
                                <td><h6>{{$pessoa->nome}}</h6></td>
                            </tr>
                            <tr>
                                <td><h6>Nascimento:</h6></td>
                                <td><h6>{{$pessoa->nascimento}}</h6></td>
                            </tr>
                            <tr>
                                <td><h6>RG:</h6></td>
                                <td><h6>{{$pessoa->rg}}</h6></td>
                            </tr>
                            <tr>
                                <td><h6>CPF:</h6></td>
                                <td><h6>{{$pessoa->cpf}}</h6></td>
                            </tr>
                            <tr>
                                <td><h6>Cidade:</h6></td>
                                <td><h6>{{$pessoa->cidade}}</h6></td>
                            </tr>
                            <tr>
                                <td><h6>Bairro:</h6></td>
                                <td><h6>@if(isset($pessoa->bairro)) {{$pessoa->bairro->nome}} @endif</h6></td>
                            </tr>
                            <tr>
                                <td><h6>Rua:</h6></td>
                                <td><h6>{{$pessoa->rua}}</h6></td>
                            </tr>
                            <tr>
                                <td><h6>Numero:</h6></td>
                                <td><h6>{{$pessoa->numero_endereco}}</h6></td>
                            </tr>
                            <tr>
                                <td><h6>CEP:</h6></td>
                                <td><h6>{{$pessoa->cep}}</h6></td>
                            </tr>
                            <tr>
                                <td><h6>Telefone:</h6></td>
                                <td><h6>{{$pessoa->telefone}}</h6></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col s6">
                        <table>
                            <tr>
                                <td><h6>Telefone de emergência:</h6></td>
                                <td><h6>{{$pessoa->telefone_emergencia}}</h6></td>
                            </tr>
                            <tr>
                                <td><h6>Sexo:</h5></td>
                                <td><h6>@if ($pessoa->sexo == 'M') Masculino @else Feminino @endif</h6></td>
                            </tr>
                            <tr>
                                <td><h6>Estado civil:</h6></td>
                                <td><h6>{{$pessoa->estado_civil}}</h6></td>
                            </tr>
                            <tr>
                                <td><h6>Nome do pai:</h6></td>
                                <td><h6>{{$pessoa->nome_do_pai}}</h6></td>
                            </tr>
                            <tr>
                                <td><h6>Nome da mãe:</h6></td>
                                <td><h6>{{$pessoa->nome_da_mae}}</h6></td>
                            </tr>
                            <tr>
                                <td><h6>Pessoa para emergência:</h6></td>
                                <td><h6>{{$pessoa->pessoa_emergencia}}</h6></td>
                            </tr>
                            <tr>
                                <td><h6>Convenio médico:</h6></td>
                                <td><h6>@if($pessoa->convenio_medico == -1) Não possui convenio médico. @else {{$pessoa->convenio_medico}} @endif</h6></td>
                            </tr>
                            <tr>
                                <td><h6>Mora com os pais:</h6></td>
                                <td><h6> @if($pessoa->mora_com_os_pais == 1) Sim @else Não @endif</h6></td>
                            </tr>
                            <tr>
                                <td><h6>Quantidade de filhos:</h6></td>
                                <td><h6>{{$pessoa->filhos}}</h6></td>
                            </tr>
                            <tr>
                                <td><h6>Quantidade de irmãos:</h6></td>
                                <td><h6>{{$pessoa->irmaos}}</h6></td>
                            </tr>
                            <tr>
                                <td><h6>Está inativo:</h6></td>
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
                    <h5>Núcleo no qual a pesssoa está vinculada</h5>
                        <div class="col s8">
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
                                        <td><a class="tooltipped" data-position="top" data-tooltip="Informações de {{$turma->nome}}" href="{{route('turma_info', $turma->id)}}"><i class="small material-icons" style="color: #039be5;">info_outline</i></a></td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection