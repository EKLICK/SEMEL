<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <script type="text/javascript" src="http://code.jquery.com/jquery-3.2.1.min.js"></script>

        {!! MaterializeCSS::include_full() !!}
    </head>
    <body>
        <div class="container">
            <table class="centered" style="margin-top: 3%;">
                <tr>
                    <td><h5>Nome:</h5></td>
                    <td><h5>{{$pessoa->nome}}</h5></td>
                </tr>
                <tr>
                    <td><h5>Nascimento:</h5></td>
                    <td><h5>{{$pessoa->nascimento}}</h5></td>
                </tr>
                <tr>
                    <td><h5>Sexo:</h5></td>
                    <td><h5>@if ($pessoa->sexo == 'M') Masculino @else Feminino @endif</h5></td>
                </tr>
                <tr>
                    <td><h5>RG:</h5></td>
                    <td><h5>{{$pessoa->rg}}</h5></td>
                </tr>
                <tr>
                    <td><h5>CPF:</h5></td>
                    <td><h5>{{$pessoa->cpf}}</h5></td>
                </tr>
                <tr>
                    <td><h5>Cidade:</h5></td>
                    <td><h5>{{$pessoa->cidade}}</h5></td>
                </tr>
                <tr>
                    <td><h5>Endereço:</h5></td>
                    <td><h5>{{$pessoa->endereco}}</h5></td>
                </tr>
                <tr>
                    <td><h5>Bairro:</h5></td>
                    <td><h5>{{$pessoa->bairro}}</h5></td>
                </tr>
                <tr>
                    <td><h5>CEP:</h5></td>
                    <td><h5>{{$pessoa->cep}}</h5></td>
                </tr>
                <tr>
                    <td><h5>Telefone:</h5></td>
                    <td><h5>{{$pessoa->telefone}}</h5></td>
                </tr>
                <tr>
                    <td><h5>Telefone de emergência:</h5></td>
                    <td><h5>{{$pessoa->telefone_emergencia}}</h5></td>
                </tr>
                <tr>
                    <td><h5>Estado civil:</h5></td>
                    <td><h5>{{$pessoa->estado_civil}}</h5></td>
                </tr>
                <tr>
                    <td><h5>Nome do pai:</h5></td>
                    <td><h5>{{$pessoa->nome_do_pai}}</h5></td>
                </tr>
                <tr>
                    <td><h5>Nome da mãe:</h5></td>
                    <td><h5>{{$pessoa->nome_da_mae}}</h5></td>
                </tr>
                <tr>
                    <td><h5>Pessoa para emergência:</h5></td>
                    <td><h5>{{$pessoa->pessoa_emergencia}}</h5></td>
                </tr>
                <tr>
                    <td><h5>Convenio médico:</h5></td>
                    <td><h5>{{$pessoa->convenio_medico}}</h5></td>
                </tr>
                <tr>
                    <td><h5>Mora com os pais:</h5></td>
                    <td><h5> @if($pessoa->mora_com_os_pais == 1) Sim @else Não @endif</h5></td>
                </tr>
                <tr>
                    <td><h5>Inativo:</h5></td>
                    <td><h5>@if($pessoa->inativo == 1) Sim @else Não @endif</h5></td>
                </tr>
                <tr>
                    <td><h5>Quantidade de filhos:</h5></td>
                    <td><h5>{{$pessoa->filhos}}</h5></td>
                </tr>
                <tr>
                    <td><h5>Quantidade de irmãos:</h5></td>
                    <td><h5>{{$pessoa->irmaos}}</h5></td>
                </tr>
            </table>
            <a href="" class="waves-effect waves-light btn" style="margin-top: 3%;">PDF</a>
        </div>
    </body>
</html>