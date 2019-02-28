<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Pessoa {{$pessoa->nome}}</title>
        <style>
            table {font-family: arial, sans-serif;border-collapse: collapse;width: 100%;}
            td, th {border: 1px solid #dddddd;text-align: left;padding: 8px;}
            .motic {float: right;}
            .pmsl {float: left;}
            .page-break {page-break-after: always;}
            .header {width: 100%;height: 320px;padding-bottom: 20px;}
        </style>
    </head>
    <body>
        <div class="header"><img src="{{asset('img/logo_prefeitura.jpg')}}" class="pmsl"></div>
        <h2>Dados pessoais</h2>
        <hr>
        <ul>
            <li>Nome: {{$pessoa->nome}}</li>
            <li>Data de Nascimento: {{$pessoa->nascimento}}</li>
            <li>Sexo: @if($pessoa->nascimento == 'M') Masculino @else Feminino @endif</li>
            <li>Estado civil: {{$pessoa->estado_civil}}</li>
            <li>Nome do pai: {{$pessoa->nome_do_pai}}</li>
            <li>Nome da mãe: {{$pessoa->nome_da_mae}}</li>
            <li>Pessoa para emergência: {{$pessoa->pessoa_emergencie}}</li>
            <li>RG: {{$pessoa->rg}}</li>
            <li>Telefone: {{$pessoa->telefone}}</li>
            <li>Telefone de emergência: {{$pessoa->telefone_emergencia}}</li>
            <li>CPF: {{$pessoa->cpf}}</li>
            <li>Convenio médico @if ($pessoa->convenio_medico == null) Não possui convenio médico @else {{$pessoa->convenio_medico}} @endif</li>
            <li>Número de filhos: {{$pessoa->filhos}}</li>
            <li>Número de irmãos: {{$pessoa->irmaos}}</li>
            <li>Mora com os pais: {{$pessoa->mora_com_os_pais}}</li>
            <li>Inativo: {{$pessoa->inativo}}</li>
        </ul>
        <h2>Endereço</h2>
        <hr>
        <ul>
            <li>Cidade: {{$pessoa->cidade}}</li>
            <li>Bairro: {{$pessoa->bairro}}</li>
            <li>Rua: {{$pessoa->endereco}}</li>
            <li>CEP: {{$pessoa->cep}}</li>
        </ul>
    </body>
</html>