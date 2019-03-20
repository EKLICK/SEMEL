@extends('layouts.app')
@section('css.personalizado')@endsection
@section('breadcrumbs')
    <a href="{{route('home')}}" class="breadcrumb">Home</a>
    <a href="{{route('turmas.index')}}" class="breadcrumb">Turmas</a>
    <a href="{{route('turmas.edit', $turma->id)}}" class="breadcrumb">Editar</a>
@endsection
@section('title') Editar {{$turma->nome}} @endsection
@section('content')
    @include('layouts.Sessoes.errors')
    <div class="container">
        <div class="row">
            <form class="col s12" action="{{route('turmas.update', $turma->id)}}" method="post">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <div class="row">
                    <div class="input-field col s12 m5">
                        <i class="material-icons prefix">group</i>
                        <input name="nome" id="prefix" type="text" class="validate" value="@if(is_null(old('nome'))) {{$turma->nome}} @else {{old('nome')}} @endif" maxlength="30" required>
                        <label for="_prefix">Nome da turma:</label>
                    </div>
                    <div class="input-field col s12 m5">
                        <i class="material-icons prefix">assignment</i>
                        <input name="limite" id="prefix" type="number" class="validate" @if(is_null(old('limite'))) value="{{$turma->limite}}" @else value="{{old('limite')}}" @endif required>
                        <label for="prefix">Limite:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m5">
                        <i class="material-icons prefix">hourglass_full</i>
                        <input name="horario_inicial" id="horario_inicial" type="text" class="validate timepicker" value="@if(is_null(old('horario_inicial'))) {{$turma->horario_inicial}} @else {{old('horario_inicial')}} @endif" maxlength="8" required>
                        <label for="horario_inicial">Horário Inicial:</label>
                    </div>
                    <div class="input-field col s12 m5">
                        <i class="material-icons prefix">hourglass_empty</i>
                        <input name="horario_final" id="horario_final" type="text" class="validate timepicker" value="@if(is_null(old('horario_final'))) {{$turma->horario_final}} @else {{old('horario_final')}} @endif" maxlength="8" required>
                        <label for="horario_final">Horário Final:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m5">
                        <input type="text" name="old_dias" id="old_dias" value="{{old('old_dias')}}" hidden>
                        @php $old_ids_dias = explode(',', old('old_dias')) @endphp
                        <i class="material-icons prefix">date_range</i>&emsp;&emsp; Dias da semana
                        <select multiple name="data_semanal[]" id="lista_de_dias" onchange="old_dias_function()" required>
                            @foreach ($dias_semana as $dia)
                                <option value="{{$dia}}" @if(is_null(old('old_dias'))) @foreach ($datas_escolhidas as $escolhido) @if($dia == $escolhido) selected @endif @endforeach @else @foreach ($old_ids_dias as $old_dia) @if($dia == $old_dia) selected @endif @endforeach @endif>{{$dia}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input-field col s12 m5">
                        <input type="text" name="old_nucleo" id="old_nucleo" value="{{old('old_nucleo')}}" hidden>
                        <i class="material-icons prefix">filter_tilt_shift</i>&emsp;&emsp; Núcleos
                        <select name="nucleo_id" id="lista_de_nucleos" onchange="old_nucleo_function()" required>
                            @foreach ($nucleoslist as $nucleo)
                                <option value="{{$nucleo->id}}" @if(is_null(old('old_nucleo'))) @if($nucleo->id == $turma->nucleo_id) selected @endif @else @if($nucleo->id == old('old_nucleo')) selected @endif @endif>{{$nucleo->nome}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m10 l5">
                        <i class="material-icons prefix">description</i>
                        <textarea name="descricao" id="descricao" type="textarea" class="materialize-textarea" maxlength="100">@if(is_null(old('descricao'))) {{$turma->descricao}} @else {{old('descricao')}} @endif</textarea>
                        <label for="descricao">Descrição da turma:</label>
                    </div>
                    <div class="container">
                        <div class="input-field col s12 m3 right">
                            <button class="btn-floating btn-large waves-effect waves-light light-blue darken-1" type="submit" name="action">
                                <i class="large material-icons left">add</i>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection