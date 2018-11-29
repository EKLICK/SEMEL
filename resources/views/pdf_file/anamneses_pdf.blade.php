<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Anamnese de {{$nome}}</title>
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
        <h2>Dados da anamnese:</h2>
        <br>
        <h3>Nome da pessoa: {{$nome}}</h3>
        <hr>
            <table>
                <tr>
                    <td>Possui doença:</td>
                    <td>@if($anamnese->possui_doenca == 0) Não @else Sim @endif</td>
                    <td>Alergia a algum medicamento:</td>
                    <td>@if($anamnese->alergia_medicacao) Não @else Sim @endif</td>
                </tr>
                <tr>
                    <td>Altura:</td>
                    <td>{{$anamnese->altura}}</td>
                    <td>Toma medicamento:</td>
                    <td>@if($anamnese->toma_medicacao) Não @else Sim @endif</td>
                </tr>
                <tr>
                    <td>Peso:</td>
                    <td>{{$anamnese->peso}}</td>
                    <td>Dor muscular:</td>
                    <td>@if($anamnese->dor_muscular == '0') Sim @else Não @endif</td>
                </tr>
                <tr>
                    <td>Fumante:</td>
                    <td>@if($anamnese->fumante == 0) Não @else Sim @endif</td>
                    <td>Dor articular:</td>
                    <td>@if($anamnese->dor_articular) Sim @else Não @endif</td>
                </tr>
                <tr>
                    <td>Atestado</td>
                    <td>@if($anamnese->atestado) Sim @else Não @endif</td>
                    <td>Dor óssea:</td>
                    <td>@if($anamnese->dor_ossea) Sim @else Não @endif</td>
                </tr>
            </table>
            <br>
            <h3>Observação:</h3>
            <p>@if($anamnese->observacao == null) Não possui observações @else {{$anamnese->observacao}} @endif</p>
        <hr>
    </body>
</html>

