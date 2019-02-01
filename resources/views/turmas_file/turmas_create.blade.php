@extends('layouts.app')
@section('css.personalizado')@endsection
@section('breadcrumbs')
    <a href="{{route('turmas.index')}}" class="breadcrumb">Turmas</a>
    <a href="{{route('turmas.create')}}" class="breadcrumb">Criar</a>
@endsection
@section('title') Criar turma @endsection
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
    <div class="container edicao-criacao">
        <div class="row">
            <form class="col s12" action="{{route('turmas.store')}}" method="post">
                @csrf
                <div class="row">
                    <div class="input-field col s12 m5">
                        <i class="material-icons prefix">group</i>
                        <input name="nome" id="icon_nome" type="text" class="validate" value="{{old('nome')}}">
                        <label for="icon_nome">Turma da turma:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m2">
                        <i class="material-icons prefix">assignment</i>
                        <input name="limite" id="icon_limite" type="number" class="validate" value="{{old('limite')}}">
                        <label for="icon_limite">Limite:</label>
                    </div>
                    <div class="input-field col s12 m3">
                        <i class="material-icons prefix">hourglass_full</i>
                        <input name="horario_inicial" id="icon_horario_inicial" type="text" class="validate timepicker" value="{{old('horario_inicial')}}">
                        <label for="icon_horario_inicial">Horário Inicial:</label>
                    </div>
                    <div class="input-field col s12 m3">
                        <i class="material-icons prefix">hourglass_empty</i>
                        <input name="horario_final" id="icon_horario_final" type="text" class="validate timepicker" value="{{old('horario_final')}}">
                        <label for="icon_horario_final">Horário Final:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m4">
                        <i class="material-icons prefix">date_range</i>&emsp;&emsp; Dias da semana
                        <select name="data_semanal[]" multiple>
                            @foreach ($dias_semana as $dia)
                                <option value="{{$dia}}">{{$dia}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input-field col s12 m4">
                        <i class="material-icons prefix">filter_tilt_shift</i>&emsp;&emsp; Núcleos
                        <select name="nucleo_id">
                            <option value="" selected disabled>Selecione o núcleo</option>
                            @foreach ($nucleoslist as $nucleo)
                                <option value="{{$nucleo->id}}">{{$nucleo->nome}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m4">
                        <i class="material-icons prefix">description</i>
                        <textarea name="descricao" id="icon_descricao" type="textarea" class="materialize-textarea">{{old('descricao')}}</textarea>
                        <label for="icon_descricao">Descrição da turma:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m3">
                        <i class="material-icons prefix">sim_card_alert</i>&emsp;&emsp; Turma ativo | inativo:
                        <div style="margin-left: 30%;">
                            <p>
                                <label>
                                    <input value="1" name="inativo" type="radio" @if(old('inativo') == 1) checked @endif/>
                                    <span>Ativo</span>
                                </label>
                            </p>
                            <p>
                                <label>
                                    <input value="2" name="inativo" type="radio" @if(old('inativo') == 2) checked @endif/>
                                    <span>Inativo</span>
                                </label>
                            </p>
                        </div>
                    </div>
                    <div class="container">
                        <div class="input-field col s12 m3 right">
                            <button class="btn-floating btn-large waves-effect waves-light" type="submit" name="action">
                                <i class="large material-icons left">add</i>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection