@extends('layouts.app')
@section('breadcrumbs')
    @if (auth()->user()->admin_professor == 1)
        <a href="{{route('nucleos.index')}}" class="breadcrumb">Núcleos</a>
    @else
        <a href="{{route('professor_turmas', 1)}}" class="breadcrumb">Minhas turmas</a>
    @endif
    <a href="{{route('nucleo_info', $nucleo->id)}}" class="breadcrumb">Informações</a>
@endsection
@section('title') <h4>Informações do Núcleo</h4> @endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col s12">
                <ul class="tabs blue">
                    <li class="tab col s4"><a href="#test1" style="color: white;"><b>Histórico do sistema</b></a></li>
                    <li class="tab col s4"><a href="#test2" style="color: white;"><b>Dados registrados</b></a></li>
                    <li class="tab col s4"><a href="#test3" style="color: white;"><b>Informações gerais</b></a></li>
                </ul>
            </div>
            <div id="test1" class="col s12">
                <table>
                    <thead class="centered">
                        <tr>
                            <th>Estado</th>
                            <th>Comentario</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($histnucleo as $historic)
                            <tr>
                                <td>@if($historic->inativo == 1) Ativado @else Inativado @endif</td>
                                <td>@if($historic->comentario == null) Sem comentarios @else {{$historic->comentario}} @endif</td>
                                <td><p>{{$historic->created_at}}</p></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$histnucleo->links()}}
            </div>
            <div id="test2" class="col s12">
                <div class="col s6">
                    <table>
                        <tr>
                            <td><h6>Nome:</h6></td>
                            <td><h6>{{$nucleo->nome}}</h6></td>
                        </tr>
                        <tr>
                            <td><h6>Bairro:</h6></td>
                            <td><h6>{{$nucleo->bairro}}</h6></td>
                        </tr>
                        <tr>
                            <td><h6>Rua:</h6></td>
                            <td><h6>{{$nucleo->rua}}</h6></td>
                        </tr>
                        <tr>
                            <td><h6>Numero de endereço:</h6></td>
                            <td><h6>{{$nucleo->numero_endereco}}</h6></td>
                        </tr>
                    </table>
                </div>
                <div class="col s6">
                    <table>
                        <tr>
                            <td><h6>CEP:</h6></td>
                            <td><h6>{{$nucleo->cep}}</h6></td>
                        </tr>
                        <tr>
                            <td><h6>Descrição:</h6></td>
                            <td><h6>{{$nucleo->descricao}}</h6></td>
                        </tr>
                        <tr>
                            <td><h6>Está inativo:</h6></td>
                            <td><h6>@if($nucleo->inativo == 1) Não @else Sim @endif</h6></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div id="test3" class="col s12">
                <div class="row">
                    <div class="col s10">
                        <table>
                            <tr>
                                <td><h6>Quantidade total de pessoas:</h6></td>
                                <td><h6>{{$dadosgerais[0]}}</h6></td>
                            </tr>
                            <tr>
                                <td><h6>Quantidade de pessoas Ativa:</h6></td>
                                <td><h6>{{$dadosgerais[1]}}</h6></td>
                            </tr>
                            <tr>
                                <td><h6>Quantidade de pessoas Inativa:</h6></td>
                                <td><h6>{{$dadosgerais[2]}}</h6></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col s10">
                        <table class="centered">
                            <thead>
                                <tr>
                                    <th>Nome da turma</th>
                                    <th>Mais Informações</th>
                                </tr>
                            </thead>
                            @foreach($nucleo->turmas as $turma)
                                <tr>
                                    <td>{{$turma->nome}}</td>
                                    <td><a class="tooltipped" data-position="top" data-tooltip="Informações de {{$turma->nome}}" href="{{route('turma_info', $turma->id)}}"><i class="small material-icons" style="color: #039be5;">info_outline</i></a></td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection