@extends('layouts.app')
@section('css.personalizado')@endsection
@section('breadcrumbs')
    <a href="{{route('turmas.index')}}" class="breadcrumb">Turmas</a>
    <a href="{{route('turmas.edit', $turma->id)}}" class="breadcrumb">Editar</a>
@endsection
@section('title') Editar {{$turma->nome}} @endsection
@section('content')
    <div class="container" style="margin-top: 3%;">
        <div class="card">
            <div class="row">
                <form class="col s12" action="{{route('turmas.update', $turma->id)}}" method="post">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <div class="row">
                        <div class="input-field col s5">
                            <i class="material-icons prefix">warning</i>
                            <input name="nome" id="icon_prefix" type="text" class="validate" value="{{$turma->nome}}">
                            <label for="icon_prefix">Nome da turma:</label>
                        </div>
                        <div class="input-field col s2">
                            <i class="material-icons prefix">assignment</i>
                            <input name="limite" id="icon_prefix" type="number" class="validate" value="{{$turma->limite}}">
                            <label for="icon_prefix">Limite:</label>
                        </div>
                        <div class="input-field col s3">
                            <i class="material-icons prefix">hourglass_full</i>
                            <input name="horario" id="icon_horario" type="text" class="validate" value="{{$turma->horario}}">
                            <label for="icon_horario">Horário:</label>
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
                                    <option value="{{$nucleo->id}}" @if($nucleo->id == $turma->nucleo_id) checked @endif>{{$nucleo->nome}}</option>
                                @endforeach
                            </select>
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