@extends('layouts.app')
@section('css.personalizado')@endsection
@section('breadcrumbs')
    <a href="{{route('turmas.index')}}" class="breadcrumb">Turmas</a>
    <a href="{{route('turmas.create')}}" class="breadcrumb">Criar</a>
@endsection
@section('title') Criar turma @endsection
@section('content')
    @if(isset($errors) && count($errors) > 0 )
        <div class="center-align">
            @foreach( $errors->all() as $error )
                <div class="chip red">
                    {{$error}}
                    <i class="close material-icons">close</i>
                </div>
            @endforeach
        </div>
     @endif

    <div class="container" style="margin-top: 3%;">
        <div class="card">
            <div class="row">
                <form class="col s12" action="{{route('turmas.store')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="input-field col s5">
                            <i class="material-icons prefix">warning</i>
                            <input name="nome" id="icon_nome" type="text" class="validate">
                            <label for="icon_nome">Nome da turma:</label>
                        </div>
                        <div class="input-field col s5 right">
                            <label>
                                Nucleos:
                                @foreach ($nucleoslist as $nucleo)
                                    <p>
                                        <label>
                                            <input type="radio" value="{{$nucleo->id}}" name="nucleo_id"/>
                                            <span>{{$nucleo->nome}}</span>
                                        </label>
                                    </p>
                                @endforeach
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s2">
                            <i class="material-icons prefix">assignment</i>
                            <input name="limite" id="icon_limite" type="number" class="validate">
                            <label for="icon_limite">Limite:</label>
                        </div>
                        <div class="input-field col s3">
                            <i class="material-icons prefix">date_range</i>
                            <input name="data_semanal" id="icon_data_semanal" type="text" class="validate">
                            <label for="icon_data_semanal">Dias da semana:</label>
                        </div>
                        <div class="input-field col s3">
                            <i class="material-icons prefix">hourglass_full</i>
                            <input name="horario" id="icon_horario" type="text" class="validate">
                            <label for="icon_horario">Horário:</label>
                        </div>
                    </div>
                    <button style="margin-bottom: 2%;" class="btn waves-effect waves-light" type="submit" name="action">Enviar
                        <i class="material-icons right">send</i>
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection