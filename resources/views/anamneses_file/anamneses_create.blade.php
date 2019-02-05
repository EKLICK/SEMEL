@extends('layouts.app')

@section('css.personalizado')@endsection
@section('breadcrumbs')
    <a href="{{route('home')}}" class="breadcrumb">Pessoas</a>
    <a href="{{route('lista_anamnese', $pessoa->id)}}" class="breadcrumb">Anamneses</a>
    <a href="{{route('pessoas.create')}}" class="breadcrumb">Criar Anamneses</a>
@endsection
@section('title') Anamneses de <?php $nomes = explode(' ',$pessoa->nome);?> {{$nomes[0]}} @endsection
@section('content')
    <br><br>
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
                                <input onclick="toma_medicacao_click('S')" value="1" name="toma_medicacao" type="radio" @if(old('toma_medicacao') == 1) checked @endif/>
                                <span>Sim</span>
                            </label>
                        </p>
                        <p>
                            <label>
                                <input onclick="toma_medicacao_click('N')" value="2" name="toma_medicacao" type="radio" @if(old('toma_medicacao') == 2) checked @endif/>
                                <span>Não</span>
                            </label>
                        </p>
                    </div>
                    <div class="input-field col s12 m6">
                        <i id="toma_medicacao_icon" class="material-icons prefix" @if(old('toma_medicacao') != 'S') hidden @endif>description</i>
                        <input id="string_toma_medicacao" name="string_toma_medicacao" type="text" class="validate" value="{{old('string_toma_medicacao')}}" @if(old('toma_medicacao') != 'S') hidden @endif>
                        <label id="toma_medicacao_label" for="string_toma_medicacao" @if(old('toma_medicacao') != 'N') hidden @endif>Qual medicamento?</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m4">
                        Possui alergia médica?
                        <p>
                            <label>
                                <input onclick="alergia_medicacao_click('S')" value="1" name="alergia_medicacao" type="radio" @if(old('alergia_medicacao') == 1) checked @endif/>
                                <span>Sim</span>
                            </label>
                        </p>
                        <p>
                            <label>
                                <input onclick="alergia_medicacao_click('N')" value="2" name="alergia_medicacao" type="radio" @if(old('alergia_medicacao') == 2) checked @endif/>
                                <span>Não</span>
                            </label>
                        </p>
                    </div>
                    <div class="input-field col s12 m6">
                        <i id="alergia_medicacao_icon" class="material-icons prefix" @if(old('alergia_medicacao') != 'S') hidden @endif>description</i>
                        <input id="string_alergia_medicacao" name="string_alergia_medicacao" type="text" class="validate" value="{{old('string_alergia_medicacao')}}" @if(old('alergia_medicacao') != 'S') hidden @endif>
                        <label id="alergia_medicacao_label" for="string_alergia_medicacao" @if(old('alergia_medicacao') != 'S') hidden @endif>Qual alergia médica?</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m4">
                        O usuário já fez cirurgia?
                        <p>
                            <label>
                                <input onclick="cirurgia_click('S')" value="1" name="cirurgia" type="radio" @if(old('cirurgia') == 2) checked @endif/>
                                <span>Sim</span>
                            </label>
                        </p>
                        <p>
                            <label>
                                <input onclick="cirurgia_click('N')" value="2" name="cirurgia" type="radio" @if(old('cirurgia') == 2) checked @endif/>
                                <span>Não</span>
                            </label>
                        </p>
                    </div>
                    <div class="input-field col s12 m6">
                        <i id="cirurgia_icon" class="material-icons prefix" @if(old('cirurgia') != 'S') hidden @endif>description</i>
                        <input id="string_cirurgia" name="string_cirurgia" type="text" class="validate" value="{{old('string_cirurgia')}}" @if(old('cirurgia') != 'S') hidden @endif>
                        <label id="cirurgia_label" for="string_cirurgia" @if(old('cirurgia') != 'S') hidden @endif>Aonde foi a cirurgia?</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m4">
                        Possui dores ósseas?
                        <p>
                            <label>
                                <input onclick="dor_ossea_click('S')" value="1" name="dor_ossea" type="radio" @if(old('dor_ossea') == 1) checked @endif/>
                                <span>Sim</span>
                            </label>
                        </p>
                        <p>
                            <label>
                                <input onclick="dor_ossea_click('N')" value="2" name="dor_ossea" type="radio" @if(old('dor_ossea') == 2) checked @endif/>
                                <span>Não</span>
                            </label>
                        </p>
                    </div>
                    <div class="input-field col s12 m6">
                        <i id="dor_ossea_icon" class="material-icons prefix" @if(old('dor_ossea') != 'S') hidden @endif>description</i>
                        <input id="string_dor_ossea" name="string_dor_ossea" type="text" class="validate" value="{{old('string_dor_ossea')}}" @if(old('dor_ossea') != 'S') hidden @endif>
                        <label id="dor_ossea_label" for="string_dor_ossea" @if(old('dor_ossea') != 'S') hidden @endif>Aonde está a dor óssea?</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m4">
                        Possui dores musculares?
                        <p>
                            <label>
                                <input onclick="dor_muscular_click('S')" value="1" name="dor_muscular" type="radio" @if(old('dor_muscular') == 1) checked @endif/>
                                <span>Sim</span>
                            </label>
                        </p>
                        <p>
                            <label>
                                <input onclick="dor_muscular_click('N')" value="2" name="dor_muscular" type="radio" @if(old('dor_muscular') == 2) checked @endif/>
                                <span>Não</span>
                            </label>
                        </p>
                    </div>
                    <div class="input-field col s12 m6">
                        <i id="dor_muscular_icon" class="material-icons prefix" @if(old('dor_muscular') != 'S') hidden @endif>description</i>
                        <input id="string_dor_muscular" name="string_dor_muscular" type="text" class="validate" value="{{old('string_dor_muscular')}}" @if(old('dor_muscular') != 'S') hidden @endif>
                        <label id="dor_muscular_label" for="string_dor_muscular" @if(old('dor_muscular') != 'S') hidden @endif>Aonde está a dor muscular?</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m4">
                        Possui dores articulares?
                        <p>
                            <label>
                                <input onclick="dor_articular_click('S')" value="1" name="dor_articular" type="radio" @if(old('dor_articular') == 1) checked @endif/>
                                <span>Sim</span>
                            </label>
                        </p>
                        <p>
                            <label>
                                <input onclick="dor_articular_click('N')" value="2" name="dor_articular" type="radio" @if(old('dor_articular') == 2) checked @endif/>
                                <span>Não</span>
                            </label>
                        </p>
                    </div>
                    <div class="input-field col s12 m6">
                        <i id="dor_articular_icon" class="material-icons prefix" @if(old('dor_articular') != 'S') hidden @endif>description</i>
                        <input id="string_dor_articular" name="string_dor_articular" type="text" class="validate" value="{{old('string_dor_articular')}}" @if(old('dor_articular') != 'S') hidden @endif>
                        <label id="dor_articular_label" for="string_dor_articular" @if(old('dor_articular') != 'S') hidden @endif>Aonde está a dor articular?</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m4">
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