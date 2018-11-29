@extends('layouts.app')
@section('breadcrumbs')
    <a href="{{route('anamneses.index')}}" class="breadcrumb">Anamneses</a>
    <a href="{{route('anamnese_info', $anamnese->id)}}" class="breadcrumb">Informações</a>
@endsection
@section('title') <h4>Informações da anamnese</h4> @endsection
@section('content')
    <div class="container" style="margin-top: 3%;">
        <div class="row">
            <div class="col s6">
                <table class="centered">
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
                        <td><h6>@if($anamnese->possui_doenca == 1) Sim @else Não @endif</h6></td>
                    </tr>
                    <tr>
                        <td><h6>Toma medicamento:</h6></td>
                        <td><h6>@if($anamnese->toma_medicamento == 1) Sim @else Não @endif</h6></td>
                    </tr>
                    <tr>
                        <td><h6>Possui alergia a algum medicamento:</h6></td>
                        <td><h6>@if($anamnese->alergia_medicamento == 1) Sim @else Não @endif</h6></td>
                    </tr>
                    <tr>
                        <td><h6>É fumante:</h6></td>
                        <td><h6>@if($anamnese->fumante == 1) Sim @else Não @endif</h6></td>
                    </tr>
                </table>
            </div>
            <div class="col s6">
                <table>
                    <tr>
                        <td><h6>Já fez cirurgia:</h6></td>
                        <td><h6>@if($anamnese->cirurgia == 1) Sim @else Não @endif</h6></td>
                    </tr>
                    <tr>
                        <td><h6>Possui dor muscular:</h6></td>
                        <td><h6>@if($anamnese->dor_muscular == 1) Sim @else Não @endif</h6></td>
                    </tr>
                    <tr>
                        <td><h6>Possui dor óssea:</h6></td>
                        <td><h6>@if($anamnese->dor_ossea == 1) Sim @else Não @endif</h6></td>
                    </tr>
                    <tr>
                        <td><h6>Possui dor articular:</h6></td>
                        <td><h6>@if($anamnese->dor_articular == 1) Sim @else Não @endif</h6></td>
                    </tr>
                    <tr>
                        <td><h6>Possui atestado:</h6></td>
                        <td><h6>@if($anamnese->atestado == 1) Sim @else Não @endif</h6></td>
                    </tr>
                    <tr>
                        <td><h6>Observação:</h6></td>
                        <td><h6>{{$anamnese->observacao}}</h6></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row">
            <a href="{{route('pdfanamnese', $anamnese->id)}}" class="waves-effect waves-light btn" style="margin-top: 3%;">PDF</a>
        </div>
    </div>
@endsection