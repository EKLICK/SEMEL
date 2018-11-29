@extends('layouts.app')

@section('content')
    <div class="container" style="margin-top: 3%;">
        <div class="col s6">
            <table class="centered">
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
                    <td><h6>Endereço:</h6></td>
                    <td><h6>{{$pessoa->endereco}}</h6></td>
                </tr>
                <tr>
                    <td><h6>Bairro:</h6></td>
                    <td><h6>{{$pessoa->bairro}}</h6></td>
                </tr>
                <tr>
                    <td><h6>CEP:</h6></td>
                    <td><h6>{{$pessoa->cep}}</h6></td>
                </tr>
                <tr>
                    <td><h6>Telefone:</h6></td>
                    <td><h6>{{$pessoa->telefone}}</h6></td>
                </tr>
                <tr>
                    <td><h6>Telefone de emergência:</h6></td>
                    <td><h6>{{$pessoa->telefone_emergencia}}</h6></td>
                </tr>
            </table>
        </div>
        <div class="col s6">
            <table>
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
                    <td><h6>@if($pessoa->convenio_medico == null) Não possui convenio médico @else {{$pessoa->convenio_medico}} @endif</h6></td>
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
        <a href="{{route('pdfpessoas', $pessoa->id)}}" class="waves-effect waves-light btn" style="margin-top: 3%;">PDF</a>
    </div>
@endsection