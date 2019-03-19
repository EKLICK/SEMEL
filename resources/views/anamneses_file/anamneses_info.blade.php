@extends('layouts.app')
@section('breadcrumbs')
    @if(auth()->user()->admin_professor == 1)
        <a href="{{route('home')}}" class="breadcrumb">Home</a>
        <a href="{{route('anamneses.index')}}" class="breadcrumb">Anamneses</a>
    @else
        <a href="{{route('professor_turmas', 1)}}" class="breadcrumb">Turmas</a>
        <a href="{{Route('professor.edit', $professor->id)}}" class="breadcrumb">Alunos</a>
    @endif
    <a href="{{route('anamnese_info', $anamnese->id)}}" class="breadcrumb">Informações</a>
@endsection
@section('title') <h4>Informações da anamnese &emsp; @if(auth()->user()->admin_professor == 1) @if($ano == $anamnese->ano) <a class="tooltipped" data-position="top" data-tooltip="Editar anamnese" href="{{Route('anamneses.edit', $anamnese->id)}}"><i class="medium material-icons">edit</i></a> @endif</h4>  @endif @endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col s6">
                <table>
                    <tr>
                        <h6><b>Atestado médico:</b></h6>
                        <td><img id="atestado_image" class="materialboxed imagensparafoto" src="{{asset($anamnese->atestado)}}"></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col s12 m6">
                <table class="responsive-table highlight bordered">
                    <tbody>
                        <tr>
                            <td><h6>Nome:</h6></td>
                            <td>
                                @if(auth()->user()->admin_professor == 1)
                                    <h6><a class="waves-effect waves-light btn blue modal-trigger btn-modal_inativar" href="{{route('pessoa_info', $anamnese->pessoas->id)}}">{{$anamnese->pessoas->nome}}</a></h6>
                                @else
                                    {{$anamnese->pessoas->nome}}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td><h6>Ano documentada:</h6></td>
                            <td><h6>{{$anamnese->ano}}</h6></td>
                        </tr>
                        <tr>
                            <td><h6>Peso:</h6></td>
                            <td><h6>{{$anamnese->peso}}</h6></td>
                        </tr>
                        <tr>
                            <td><h6>Altura:</h6></td>
                            <td><h6>{{$anamnese->altura}}</h6></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col s12 m6">
                <table class="responsive-table highlight bordered">
                    <tbody>
                        <tr>
                            <td><h6>Possui doença:</h6></td>
                            <td>
                                <h6>
                                    @if($anamnese->possui_doenca == 2)
                                        Não 
                                    @else 
                                        Sim &emsp;
                                        <a class="waves-effect waves-light btn blue modal-trigger btn-modal_inativar" href="#listadoencas">Doenças</a>
                                    @endif
                                </h6>
                            </td>
                        </tr>
                        <tr>
                            <td><h6>Possui atestado:</h6></td>
                            <td><h6>@if($anamnese->atestado == 1) Sim @else Não @endif</h6></td>
                        </tr>
                        <tr>
                            <td><h6>Observação:</h6></td>
                            <td><h6>{{$anamnese->observacao}}</h6></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <br><br>
        <div class="row">
            <div class="col s12">
                <table class="responsive-table highlight bordered">
                    <thead>
                        <th>Questão</th>
                        <th>Resposta</th>
                        <th>Descrição</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td><h6>Toma medicamento:</h6></td>
                            <td>@if($anamnese->toma_medicacao == -1) <h6>Não</h6> @else <h6>Sim</h6> @endif </td>
                            <td>
                                <h6>
                                    @if($anamnese->toma_medicacao == null || $anamnese->toma_medicacao == -1)
                                        Sem descrição
                                    @else
                                        @if($anamnese->toma_medicacao != -1) {{$anamnese->toma_medicacao}} @endif
                                    @endif
                                </h6>
                            </td>
                        </tr>
                        <tr>
                            <td><h6>Possui alergia a algum medicamento:</h6></td>
                            <td>@if($anamnese->alergia_medicacao == -1) <h6>Não</h6> @else <h6>Sim</h6> @endif </td>
                            <td>
                                <h6>
                                    @if($anamnese->alergia_medicacao == null || $anamnese->alergia_medicacao == -1)
                                        Sem descrição
                                    @else
                                        @if($anamnese->alergia_medicacao != -1) {{$anamnese->alergia_medicacao}} @endif
                                    @endif
                                </h6>
                            </td>
                        </tr>
                        <tr>
                            <td><h6>Já fez cirurgia:</h6></td>
                            <td>@if($anamnese->cirurgia == -1) <h6>Não</h6> @else <h6>Sim</h6> @endif </td>
                            <td>
                                <h6>
                                    @if($anamnese->cirurgia == null || $anamnese->cirurgia == -1)
                                        Sem descrição
                                    @else
                                        @if($anamnese->cirurgia != -1) {{$anamnese->cirurgia}} @endif
                                    @endif
                                </h6>
                            </td>
                        </tr>
                        <tr>
                            <td><h6>É fumante:</h6></td>
                            <td>@if($anamnese->fumante == -1) <h6>Não</h6> @else <h6>Sim</h6> @endif </td>
                            <td>
                                <h6>
                                    @if($anamnese->fumante == null || $anamnese->fumante == -1)
                                        Sem descrição
                                    @else
                                        @if($anamnese->fumante != -1) {{$anamnese->fumante}} @endif
                                    @endif
                                </h6>
                            </td>
                        </tr>
                        <tr>
                            <td><h6>Possui dor óssea:</h6></td>
                            <td>@if($anamnese->dor_ossea == -1) <h6>Não</h6> @else <h6>Sim</h6> @endif </td>
                            <td>
                                <h6>
                                    @if($anamnese->dor_ossea == null || $anamnese->dor_ossea == -1)
                                        Sem descrição
                                    @else
                                        @if($anamnese->dor_ossea != -1) {{$anamnese->dor_ossea}} @endif
                                    @endif
                                </h6>
                            </td>
                        </tr>
                        <tr>
                            <td><h6>Possui dor muscular:</h6></td>
                            <td>@if($anamnese->dor_muscular == -1) <h6>Não</h6> @else <h6>Sim</h6> @endif </td>
                            <td>
                                <h6>
                                    @if($anamnese->dor_muscular == null || $anamnese->dor_muscular == -1)
                                        Sem descrição
                                    @else
                                        @if($anamnese->dor_muscular != -1) {{$anamnese->dor_muscular}} @endif
                                    @endif
                                </h6>
                            </td>
                        </tr>
                        <tr>
                            <td><h6>Possui dor articular:</h6></td>
                            <td>@if($anamnese->dor_articular == -1) <h6>Não</h6> @else <h6>Sim</h6> @endif </td>
                            <td>
                                <h6>
                                    @if($anamnese->dor_articular == null || $anamnese->dor_articular == -1)
                                        Sem descrição
                                    @else
                                        @if($anamnese->dor_articular != -1) {{$anamnese->dor_articular}} @endif
                                    @endif
                                </h6>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal" id="listadoencas">
        <div class="container">
            <table class="centered responsive-table highlight bordered">
                <thead>
                    <th>Nome da Doença</th>
                    <th>Descrição</th>
                </thead>
                <tbody>
                    @foreach ($anamnese->doencas as $doenca)
                        <tr>
                            <td>{{$doenca->nome}}</td>
                            <td>{{$doenca->descricao}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection