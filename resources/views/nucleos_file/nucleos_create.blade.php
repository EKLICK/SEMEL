@extends('layouts.app')

    @section('css.personalizado')
    @endsection

    @section('content')

    <div class="container" style="margin-top: 3%;">
        <div class="card">
            <div class="row">
                <form class="col s12" action="{{route('nucleos.store')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="input-field col s6">
                            <i class="material-icons prefix">filter_tilt_shift</i>
                            <input name="nome" id="icon_nome" type="text" class="validate">
                            <label for="icon_nome">Nome da turma:</label>
                        </div>
                    </div>
                    <div class="row">
                            <div class="input-field col s6">
                                <i class="material-icons prefix">location_city</i>
                                <input name="limite" id="icon_bairro" type="number" class="validate">
                                <label for="icon_bairro">Bairro:</label>
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