@extends('layouts.app')

@section('content')
    <div class="container" style="background: white;">
        <div>
        <div class="col s6">
            <table class="centered" style="margin-top: 3%;">
                <tr>
                    <td><h6>Nome:</h6></td>
                    <td><h6>{{$pessoa->nome}}</h6></td>
                </tr>
                <tr>
                    <td><h6>Nascimento:</h6></td>
                    <td><h6>{{$pessoa->nascimento}}</h6></td>
                </tr>
                <tr>
                    <td><h6>Sexo:</h5></td>
                    <td><h6>@if ($pessoa->sexo == 'M') Masculino @else Feminino @endif</h6></td>
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
                    <td><h6>{{$pessoa->convenio_medico}}</h6></td>
                </tr>
                <tr>
                    <td><h6>Mora com os pais:</h6></td>
                    <td><h6> @if($pessoa->mora_com_os_pais == 1) Sim @else Não @endif</h6></td>
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
                    <td><h6>Possui dor óssea:</h6></td>
                    <td><h6>@if($anamnese->fumante == 1) Sim @else Não @endif</h6></td>
                </tr>
                <tr>
                    <td><h6>Possui atestado:</h6></td>
                    <td><h6>@if($anamnese->atestado == 1) Sim @else Não @endif</h6></td>
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
                    <td><h6>Observação:</h6></td>
                    <td><h6>{{$anamnese->observacao}}</h6></td>
                </tr>
            </table>
        </div>
        <a href="" class="waves-effect waves-light btn" style="margin-top: 3%;">PDF</a>
    </div>
@endsection