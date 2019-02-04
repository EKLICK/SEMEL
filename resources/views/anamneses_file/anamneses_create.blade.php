@extends('layouts.app')

@section('css.personalizado')@endsection
@section('breadcrumbs')
    <a href="{{route('home')}}" class="breadcrumb">Pessoas</a>
    <a href="{{route('lista_anamnese', $pessoa->id)}}" class="breadcrumb">Anamneses</a>
    <a href="{{route('pessoas.create')}}" class="breadcrumb">Criar Anamneses</a>
@endsection
@section('title') Anamneses de <?php $nomes = explode(' ',$pessoa->nome);?> {{$nomes[0]}} @endsection
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
            <form class="col s12" action="{{route('anamneses.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="text" name="pessoas_id" value="{{$pessoa->id}}" hidden>
                <div class="row">
                    <div class="input-field col s12 m3">
                        <i class="material-icons prefix">local_parking</i>
                        <input name="peso" id="icon_prefix" type="number" step="0.01" class="validate" value="{{old('peso')}}">
                        <label for="icon_prefix">Peso:</label>
                    </div>
                    <div class="input-field col s12 m3">
                        <i class="material-icons prefix">format_color_text</i>
                        <input name="altura" id="icon_altura" type="number" step="0.01" class="validate" value="{{old('altura')}}">
                        <label for="icon_altura">Altura:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m4">
                        Toma algum medicamento?
                        <p>
                            <label>
                                <input value="S" class="teste" name="toma_medicacao" type="radio" @if(old('toma_medicacao') == 'S') checked @endif/>
                                <span>Sim</span>
                            </label>
                        </p>
                        <p>
                            <label>
                                <input value="N" class="teste" name="toma_medicacao" type="radio" @if(old('toma_medicacao') == 'N') checked @endif/>
                                <span>Não</span>
                            </label>
                        </p>
                    </div>
                    <div class="input-field col s12 m6">
                        <i id="toma_medicacao_icon" class="material-icons prefix" @if(old('toma_medicacao') == 'N' || empty(old('toma_medicacao'))) hidden @endif>description</i>
                        <input id="string_toma_medicacao" name="string_toma_medicacao" type="text" class="validate" value="{{old('toma_medicacao')}}" @if(old('toma_medicacao') == 'N' || empty(old('toma_medicacao'))) hidden @endif>
                        <label id="toma_medicacao_label" for="string_toma_medicacao" @if(old('toma_medicacao') == 'N' || empty(old('toma_medicacao'))) hidden @endif>Qual medicamento?</label>
                    </div>
                </div>
                    <div class="input-field col s12 m3">
                        Possui alergia médica?
                        <p>
                            <label>
                                <input value="1" name="alergia_medicacao" type="radio" @if(old('alergia_medicacao') == 1) checked @endif/>
                                <span>Sim</span>
                            </label>
                        </p>
                        <p>
                            <label>
                                <input value="2" name="alergia_medicacao" type="radio" @if(old('alergia_medicacao') == 2) checked @endif/>
                                <span>Não</span>
                            </label>
                        </p>
                    </div>
                    <div class="input-field col s12 m3">
                        O usuário fuma?
                        <p>
                            <label>
                                <input value="1" name="fumante" type="radio" @if(old('fumante') == 1) checked @endif/>
                                <span>Sim</span>
                            </label>
                        </p>
                        <p>
                            <label>
                                <input value="2" name="fumante" type="radio" @if(old('fumante') == 2) checked @endif/>
                                <span>Não</span>
                            </label>
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m3">
                        O usuário já fez cirurgia?
                        <p>
                            <label>
                                <input value="1" name="cirurgia" type="radio" @if(old('cirurgia') == 1) checked @endif/>
                                <span>Sim</span>
                            </label>
                        </p>
                        <p>
                            <label>
                                <input value="2" name="cirurgia" type="radio" @if(old('cirurgia') == 2) checked @endif/>
                                <span>Não</span>
                            </label>
                        </p>
                    </div>
                    <div class="input-field col s12 m3">
                        Possui dores ósseas?
                        <p>
                            <label>
                                <input value="1" name="dor_ossea" type="radio" @if(old('dor_ossea') == 1) checked @endif/>
                                <span>Sim</span>
                            </label>
                        </p>
                        <p>
                            <label>
                                <input value="2" name="dor_ossea" type="radio" @if(old('dor_ossea') == 2) checked @endif/>
                                <span>Não</span>
                            </label>
                        </p>
                    </div>
                    <div class="input-field col s12 m3">
                        Possui dores musculares?
                        <p>
                            <label>
                                <input value="1" name="dor_muscular" type="radio" @if(old('dor_muscular') == 1) checked @endif/>
                                <span>Sim</span>
                            </label>
                        </p>
                        <p>
                            <label>
                                <input value="2" name="dor_muscular" type="radio" @if(old('dor_muscular') == 2) checked @endif/>
                                <span>Não</span>
                            </label>
                        </p>
                    </div>
                    <div class="input-field col s12 m3">
                        Possui dores articulares?
                        <p>
                            <label>
                                <input value="1" name="dor_articular" type="radio" @if(old('dor_articular') == 1) checked @endif/>
                                <span>Sim</span>
                            </label>
                        </p>
                        <p>
                            <label>
                                <input value="2" name="dor_articular" type="radio" @if(old('dor_articular') == 2) checked @endif/>
                                <span>Não</span>
                            </label>
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m5">
                        <i class="material-icons prefix">new_releases</i>Possui doenças?
                        <select multiple name="doencas[]">
                            @foreach ($doencaslist as $doenca)
                                <option value="{{$doenca->id}}">{{$doenca->nome}}</option>
                            @endforeach
                        </select>
                        <input type="text" value="2" name="possui_doenca" hidden>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m5">
                        <i class="material-icons prefix">description</i>
                        <textarea name="observacao" id="observacao" class="materialize-textarea">{{old('observacao')}}</textarea>
                        <label for="observacao">Observação</label>
                    </div>
                    <div class="input-field col s12 m5 right">
                        <button class="btn-floating btn-large waves-effect waves-light" type="submit" name="action">
                            <i class="large material-icons left">add</i>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection