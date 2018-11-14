@extends('layouts.app')

    @section('css.personalizado')
    @endsection

    @section('content')

    <div class="container" style="margin-top: 3%;">
        <div class="card">
            <div class="row">
                <form class="col s12" action="{{route('turmas.store')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="input-field col s6">
                            <i class="material-icons prefix">warning</i>
                            <input name="nome" id="icon_prefix" type="text" class="validate">
                            <label for="icon_prefix">Nome da turma:</label>
                        </div>
                    </div>
                    <div class="row">
                            <div class="input-field col s6">
                                <i class="material-icons prefix">assignment</i>
                                <input name="nome" id="icon_prefix" type="number" class="validate">
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