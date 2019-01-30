@extends('layouts.app')
@section('css.personalizado')@endsection
@section('breadcrumbs')
    <a href="{{route('turmas.index')}}" class="breadcrumb">Turmas</a>
    <a href="{{route('turmas.edit', $turma->id)}}" class="breadcrumb">Editar</a>
@endsection
@section('title') Editar {{$turma->nome}} @endsection
@section('content')
    @if(isset($errors) && count($errors) > 0)
        @foreach($errors->all() as $error)
            <div style="margin-left: 15%; margin-top: 1%;">
                <div class="chip red lighten-2">
                    {{$error}}
                    <i class="close material-icons">close</i>
                </div>
            </div>
        @endforeach
    @endif
    <div class="container">
        <div class="row">
            <form class="col s12" action="{{route('turmas.update', $turma->id)}}" method="post">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <div class="row">
                    <div class="input-field col s5">
                        <i class="material-icons prefix">group</i>
                        <input name="nome" id="icon_prefix" type="text" class="validate" value="@if(is_null(old('nome'))) {{$turma->nome}} @else {{old('nome')}} @endif">
                        <label for="icon_prefix">Nome da turma:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s2">
                        <i class="material-icons prefix">assignment</i>
                        <input name="limite" id="icon_prefix" type="number" class="validate" @if(is_null(old('limite'))) value="{{$turma->limite}}" @else value="{{old('limite')}}" @endif>
                        <label for="icon_prefix">Limite:</label>
                    </div>
                    <div class="input-field col s3">
                        <i class="material-icons prefix">hourglass_full</i>
                        <input name="horario_inicial" id="icon_horario_inicial" type="text" class="validate timepicker" value="@if(is_null(old('horario_inicial'))) {{$turma->horario_inicial}} @else {{old('horario_inicial')}} @endif">
                        <label for="icon_horario_inicial">Horário Inicial:</label>
                    </div>
                    <div class="input-field col s3">
                        <i class="material-icons prefix">hourglass_empty</i>
                        <input name="horario_final" id="icon_horario_final" type="text" class="validate timepicker" value="@if(is_null(old('horario_final'))) {{$turma->horario_final}} @else {{old('horario_final')}} @endif">
                        <label for="icon_horario_final">Horário Final:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s4">
                        <i class="material-icons prefix">date_range</i>&emsp;&emsp; Dias da semana
                        <select name="data_semanal[]" multiple>
                            @foreach ($dias_semana as $dia)
                                <option value="{{$dia}}" @foreach ($datas_escolhidas as $escolhido) @if($dia == $escolhido) selected @endif @endforeach>{{$dia}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input-field col s4">
                        <i class="material-icons prefix">filter_tilt_shift</i>&emsp;&emsp; Núcleos
                        <select name="nucleo_id">
                            @foreach ($nucleoslist as $nucleo)
                                <option value="{{$nucleo->id}}" @if($nucleo->id == $turma->nucleo_id) selected @endif>{{$nucleo->nome}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s8">
                        <i class="material-icons prefix">description</i>
                        <textarea name="descricao" id="icon_descricao" type="textarea" class="materialize-textarea">@if(is_null(old('descricao'))) {{$turma->descricao}} @else {{old('descricao')}} @endif</textarea>
                        <label for="icon_descricao">Descrição da turma:</label>
                    </div>
                </div>
                <button style="margin-bottom: 2%;" class="btn waves-effect waves-light" type="submit" name="action">Enviar
                    <i class="material-icons right">send</i>
                </button>
            </form>
        </div>
    </div>
@endsection