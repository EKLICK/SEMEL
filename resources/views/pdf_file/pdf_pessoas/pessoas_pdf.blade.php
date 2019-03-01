<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Relatório de pessoas</title>
        <style>
            table {font-family: arial, sans-serif;border-collapse: collapse;width: 100%;}
            td, th {border: solid #dddddd;text-align: center; padding: 10px;}
            .pmsl {float: left;}
            .header {height: 250px;padding-bottom: 10px;}
        </style>
    </head>
    <body>
        <div class="header"><img src="{{asset('img/logo_prefeitura.jpg')}}" class="pmsl"></div>
        @foreach ($pessoaslist as $pessoa)
            <div style="border-style: solid; border-color: #999999; border-width: 2px;">
                <h3 style="margin-left: 2%;">Nome: <b>{{$pessoa->nome}}</b></h3>
                <br>
                <table>
                    <tr>
                        @if($opcoes_colunas[0] == 1)<th style="width: 200px;">Endereço</th>@endif
                        @if($opcoes_colunas[1] == 1)<th style="width: 110px;">Telefone</th>@endif
                        @if($opcoes_colunas[2] == 1)<th style="width: 100px;">Data de nascimento</th>@endif
                        @if($opcoes_colunas[3] == 1)<th>RG</th>@endif
                        @if($opcoes_colunas[4] == 1)<th>Usuário morto?</th>@endif
                    </tr>
                    <tr>
                        @if(isset($pessoa->bairro))
                            @if($opcoes_colunas[0] == 1)<td>{{$pessoa->bairro}}<br>{{$pessoa->rua}}<br>{{$pessoa->numero_endereco}}</td>@endif
                        @else
                            <td>Não informado</td>
                        @endif
                        @if(isset($pessoa->telefone))
                            @if($opcoes_colunas[1] == 1)<td>{{$pessoa->telefone}}</td>@endif
                        @else
                            <td>Não informado</td>
                        @endif
                        @if(isset($pessoa->nascimento))
                            @if($opcoes_colunas[2] == 1)
                                @php 
                                    $dia_hora = explode(' ', $pessoa->nascimento);
                                    $dia = explode('-',$dia_hora[0]);
                                @endphp
                                <td>{{$dia[1].'/'.$dia[1].'/'.$dia[0]}}</td>
                            @endif
                        @else
                            <td>Não informado</td>
                        @endif
                        @if(isset($pessoa->rg))
                            @if($opcoes_colunas[3] == 1)<td>{{$pessoa->rg}}</td>@endif
                        @else
                            <td>Não informado</td>
                        @endif
                        @if($opcoes_colunas[4] == 1)
                            <td>@if($pessoa->morte == -1) Não @else Sim @endif</td>
                        @endif
                    </tr>
                </table>
            </div>
            <br>
        @endforeach
    </body>
</html>