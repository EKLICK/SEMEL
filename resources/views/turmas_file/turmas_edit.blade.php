@extends('layouts.app')

    @section('css.personalizado')
    @endsection

    @section('content')

    <div class="container" style="margin-top: 3%;">
        <div class="card">
            <div class="row">
                <form class="col s12" action="{{route('turmas.update', $turma->id)}}" method="post">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <div class="row">
                        <div class="input-field col s6">
                            <i class="material-icons prefix">warning</i>
                            <input name="nome" id="icon_prefix" type="text" class="validate" value="{{$turma->nome}}">
                            <label for="icon_prefix">Nome da turma:</label>
                        </div>
                        <div class="input-field col s5 right">
                            <label>
                                    Nucleos:
                                @foreach ($nucleoslist as $nucleo)
                                    <p>
                                        <label>
                                            <input type="radio" value="{{$nucleo->id}}" name="nucleo_id" @if($nucleo->id == $turma->nucleo_id) checked @endif/>
                                            <span>{{$nucleo->nome}}</span>
                                        </label>
                                    </p>
                                @endforeach
                            </label>
                        </div>
                    </div>
                    <div class="row">
                            <div class="input-field col s6">
                                <i class="material-icons prefix">assignment</i>
                                <input name="limite" id="icon_prefix" type="number" class="validate" value="{{$turma->limite}}">
                                <label for="icon_prefix">Limite:</label>
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