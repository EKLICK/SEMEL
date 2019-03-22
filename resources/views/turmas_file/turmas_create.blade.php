@extends('layouts.app')
@section('breadcrumbs')
    <a href="{{route('home')}}" class="breadcrumb">Home</a>
    <a href="{{route('turmas.index')}}" class="breadcrumb">Turmas</a>
    <a href="{{route('turmas.create')}}" class="breadcrumb">Criar</a>
@endsection
@section('title') Criar turma @endsection
@section('content')
    @include('layouts.Sessoes.errors')
    <div class="container">
        <div class="row">
            <form class="col s12" action="{{route('turmas.store')}}" method="post">
                @csrf
                <div class="row">
                    <div class="input-field col s12 m5">
                        <i class="material-icons prefix">group</i>
                        <input name="nome" id="icon_nome" type="text" class="validate" value="{{old('nome')}}" maxlength="30" required>
                        <label for="icon_nome">Turma da turma:</label>
                    </div>
                    <div class="input-field col s12 m5">
                        <i class="material-icons prefix">assignment</i>
                        <input name="limite" id="icon_limite" type="number" class="validate" value="{{old('limite')}}" required>
                        <label for="icon_limite">Limite:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m5">
                        <i class="material-icons prefix">hourglass_full</i>
                        <input name="horario_inicial" id="icon_horario_inicial" type="text" class="validate timepicker" value="{{old('horario_inicial')}}" maxlength="8" required>
                        <label for="icon_horario_inicial">Horário Inicial:</label>
                    </div>
                    <div class="input-field col s12 m5">
                        <i class="material-icons prefix">hourglass_empty</i>
                        <input name="horario_final" id="icon_horario_final" type="text" class="validate timepicker" value="{{old('horario_final')}}" maxlength="8" required>
                        <label for="icon_horario_final">Horário Final:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m5">
                        <input type="text" name="old_dias" id="old_dias" value="{{old('old_dias')}}" hidden>
                        @php $old_ids_dias = explode(',', old('old_dias')) @endphp
                        <i class="material-icons prefix">date_range</i>&emsp;&emsp; Dias da semana
                        <select multiple name="data_semanal[]" id="lista_de_dias" onchange="old_dias_function()" required>
                            @foreach ($dias_semana as $dia)
                                <option value="{{$dia}}" @foreach ($old_ids_dias as $old_dia) @if($dia == $old_dia) selected @endif @endforeach>{{$dia}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input-field col s12 m5">
                        <input type="text" name="old_nucleo" id="old_nucleo" value="{{old('old_nucleo')}}"  hidden>
                        <i class="material-icons prefix">filter_tilt_shift</i>&emsp;&emsp; Núcleos
                        <select name="nucleo_id" id="lista_de_nucleos" onchange="old_nucleo_function()" required>
                            <option value="" selected disabled>Selecione o núcleo</option>
                            @foreach ($nucleoslist as $nucleo)
                                <option value="{{$nucleo->id}}" @if($nucleo->id == old('old_nucleo')) selected @endif>{{$nucleo->nome}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m10 l5">
                        <i class="material-icons prefix">description</i>
                        <textarea name="descricao" id="icon_descricao" type="textarea" class="materialize-textarea" maxlength="100">{{old('descricao')}}</textarea>
                        <label for="icon_descricao">Descrição da turma:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s8 m5 xl4">
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
                            <button class="btn-floating btn-large waves-effect waves-light light-blue darken-1" type="submit" name="action">
                                <i class="large material-icons left">add</i>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection