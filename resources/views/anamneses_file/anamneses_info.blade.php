@extends('layouts.app')
@section('breadcrumbs')
    <a href="{{route('anamneses.index')}}" class="breadcrumb">Anamneses</a>
    <a href="{{route('anamnese_info', $anamnese->id)}}" class="breadcrumb">Informações</a>
@endsection
@section('title') <h4>Informações da anamnese</h4> @endsection
@section('content')
    <br><br>
    <div class="container">
        <div class="row">
            <div class="col s12">
                <table class="responsive-table highlight bordered">
                    <thead>
                        <tr>
                            <th>Informações</th>
                            <th>Resposta</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><h6>Nome:</h6></td>
                            <td><h6>{{$anamnese->pessoas->nome}}</h6></td>
                        </tr>
                        <tr>
                            <td><h6>Peso:</h6></td>
                            <td><h6>{{$anamnese->peso}}</h6></td>
                        </tr>
                        <tr>
                            <td><h6>Altura:</h6></td>
                            <td><h6>{{$anamnese->altura}}</h6></td>
                        </tr>
                        <tr>
                            <td><h6>Possui doença:</h6></td>
                            <td><h6>@if($anamnese->possui_doenca == 1) Não @else Sim @endif</h6></td>
                        </tr>
                        <tr>
                            <td><h6>Toma medicamento:</h6></td>
                            <td>
                                @if($anamnese->toma_medicacao == -1) 
                                    <i class="material-icons left" style="color: red;">report</i> 
                                @else
                                    <i class="material-icons left" style="color: green;">report</i>
                                    <h6>
                                    @if($anamnese->toma_medicacao == null || $anamnese->toma_medicacao == -1)
                                            Sem descrição
                                        @else
                                            @if($anamnese->toma_medicacao != -1) {{$anamnese->toma_medicacao}} @endif
                                        @endif
                                    </h6>
                                @endif
                            <td>
                        </tr>
                        <tr>
                            <td><h6>Possui alergia a algum medicamento:</h6></td>
                            <td>
                                @if($anamnese->alergia_medicacao == -1) 
                                    <i class="material-icons left" style="color: red;">report</i> 
                                @else
                                    <i class="material-icons left" style="color: green;">report</i>
                                    <h6>
                                        @if($anamnese->alergia_medicacao == null || $anamnese->alergia_medicacao == -1)
                                            Sem descrição
                                        @else
                                            @if($anamnese->alergia_medicacao != -1) {{$anamnese->alergia_medicacao}} @endif
                                        @endif
                                    </h6>
                                @endif
                            <td>
                        </tr>
                        <tr>
                            <td><h6>Já fez cirurgia:</h6></td>
                            <td>
                                @if($anamnese->cirurgia == -1) 
                                    <i class="material-icons left" style="color: red;">report</i> 
                                @else
                                    <i class="material-icons left" style="color: green;">report</i>
                                    <h6>
                                        @if($anamnese->cirurgia == null || $anamnese->cirurgia == -1)
                                            Sem descrição
                                        @else
                                            @if($anamnese->cirurgia != -1) {{$anamnese->cirurgia}} @endif
                                        @endif
                                    </h6>
                                @endif
                            <td>
                        </tr>
                        <tr>
                            <td><h6>Possui dor óssea:</h6></td>
                            <td>
                                @if($anamnese->dor_ossea == -1) 
                                    <i class="material-icons left" style="color: red;">report</i> 
                                @else
                                    <i class="material-icons left" style="color: green;">report</i>
                                    <h6>
                                        @if($anamnese->dor_ossea == null || $anamnese->dor_ossea == -1)
                                            Sem descrição
                                        @else
                                            @if($anamnese->dor_ossea != -1) {{$anamnese->dor_ossea}} @endif
                                        @endif
                                    </h6>
                                @endif
                            <td>
                        </tr>
                        <tr>
                            <td><h6>Possui dor muscular:</h6></td>
                            <td>
                                @if($anamnese->dor_muscular == -1) 
                                    <i class="material-icons left" style="color: red;">report</i> 
                                @else
                                    <i class="material-icons left" style="color: green;">report</i>
                                    <h6>
                                        @if($anamnese->dor_muscular == null || $anamnese->dor_muscular == -1)
                                            Sem descrição
                                        @else
                                            @if($anamnese->dor_muscular != -1) {{$anamnese->dor_muscular}} @endif
                                        @endif
                                    </h6>
                                @endif
                            <td>
                        </tr>
                        <tr>
                            <td><h6>Possui dor articular:</h6></td>
                            <td>
                                @if($anamnese->dor_articular == -1) 
                                    <i class="material-icons left" style="color: red;">report</i> 
                                @else
                                    <i class="material-icons left" style="color: green;">report</i>
                                    <h6>
                                        @if($anamnese->dor_articular == null || $anamnese->dor_articular == -1)
                                            Sem descrição
                                        @else
                                            @if($anamnese->dor_articular != -1) {{$anamnese->dor_articular}} @endif
                                        @endif
                                    </h6>
                                @endif
                            <td>
                        </tr>
                        <tr>
                            <td><h6>É fumante:</h6></td>
                            <td><h6>{{$anamnese->fumante}}</h6></td>
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
                <br>
                <div class="right" style="margin-right: 10%;">
                    <a href="{{route('pdfanamnese', $anamnese->id)}}" class="waves-effect waves-light btn" style="margin-top: 3%;">PDF</a>
                </div>
            </div>
        </div>
    </div>
@endsection