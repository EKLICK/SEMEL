@extends('layouts.app')
@section('css.personalizado')@endsection
@section('breadcrumbs')
    <a href="{{route('anamneses.index')}}" class="breadcrumb">Anamneses</a>
    <a href="{{route('anamneses.edit', $anamnese->id)}}" class="breadcrumb">Editar</a>
@endsection
@section('title') Editar anamneses @endsection
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
            <form class="col s12" action="{{route('anamneses.update', $anamnese->id)}}" method="post">
                @csrf
                <input type="text" name="ano" id="ano" value="{{date('Y')}}" hidden>
                <input type="number" name="{{$anamnese->pessoas->id}}" id="{{$anamnese->pessoas->id}}" value="{{$anamnese->pessoas->id}}" hidden>
                <input type="hidden" name="_method" value="PUT">
                <div class="row">
                    <h4 class="center">Nome do Usuário: {{$anamnese->pessoas->nome}}</h4>
                    <div class="input-field col s12 m3">
                        <i class="material-icons prefix">local_parking</i>
                        <input name="peso" id="icon_prefix" type="number" step="0.01" class="validate" @if(is_null(old('peso'))) value="{{$anamnese->peso}}" @else value="{{old('peso')}}" @endif>
                        <label for="icon_prefix">Peso:</label>
                    </div>
                    <div class="input-field col s12 m3">
                        <i class="material-icons prefix">format_color_text</i>
                        <input name="altura" id="icon_altura" type="number" step="0.01" class="validate" @if(is_null(old('altura'))) value="{{$anamnese->altura}}" @else value="{{old('altura')}}" @endif>
                        <label for="icon_matricula">Altura:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m3">
                        Toma algum medicamento?
                        <p>
                            <label>
                                <input value="1" name="toma_medicacao" type="radio" @if(!is_null(old('toma_medicacao'))) @if(old('toma_medicacao') == 1) checked @endif @else @if ($anamnese->toma_medicacao == 1) checked @endif @endif/>
                                <span>Sim</span>
                            </label>
                        </p>
                        <p>
                            <label>
                                <input value="2" name="toma_medicacao" type="radio" @if(!is_null(old('toma_medicacao'))) @if(old('toma_medicacao') == 2) checked @endif @else @if ($anamnese->toma_medicacao == 2) checked @endif @endif/>
                                <span>Não</span>
                            </label>
                        </p>
                    </div>
                    <div class="input-field col s12 m3">
                        Possui alergia médica?
                        <p>
                            <label>
                                <input value="1" name="alergia_medicacao" type="radio" @if(!is_null(old('alergia_medicacao'))) @if(old('alergia_medicacao') == 1) checked @endif @else @if ($anamnese->alergia_medicacao == 1) checked @endif @endif/>
                                <span>Sim</span>
                            </label>
                        </p>
                        <p>
                            <label>
                                <input value="2" name="alergia_medicacao" type="radio"  @if(!is_null(old('alergia_medicacao'))) @if(old('alergia_medicacao') == 2) checked @endif @else @if ($anamnese->alergia_medicacao == 2) checked @endif @endif/>
                                <span>Não</span>
                            </label>
                        </p>
                    </div>
                    <div class="input-field col s12 m3">
                        O usuário fuma?
                        <p>
                            <label>
                                <input value="1" name="fumante" type="radio" @if(!is_null(old('fumante'))) @if(old('fumante') == 1) checked @endif @else @if ($anamnese->fumante == 1) checked @endif @endif/>
                                <span>Sim</span>
                            </label>
                        </p>
                        <p>
                            <label>
                                <input value="2" name="fumante" type="radio" @if(!is_null(old('fumante'))) @if(old('fumante') == 2) checked @endif @else @if ($anamnese->fumante == 2) checked @endif @endif/>
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
                                <input value="1" name="cirurgia" type="radio" @if(!is_null(old('cirurgia'))) @if(old('cirurgia') == 1) checked @endif @else @if ($anamnese->cirurgia == 1) checked @endif @endif/>
                                <span>Sim</span>
                            </label>
                        </p>
                        <p>
                            <label>
                                <input value="2" name="cirurgia" type="radio"  @if(!is_null(old('cirurgia'))) @if(old('cirurgia') == 2) checked @endif @else @if ($anamnese->cirurgia == 2) checked @endif @endif/>
                                <span>Não</span>
                            </label>
                        </p>
                    </div>
                    <div class="input-field col s12 m3">
                        Possui dores ósseas?
                        <p>
                            <label>
                                <input value="1" name="dor_ossea" type="radio"  @if(!is_null(old('dor_ossea'))) @if(old('dor_ossea') == 1) checked @endif @else @if ($anamnese->dor_ossea == 1) checked @endif @endif/>
                                <span>Sim</span>
                            </label>
                        </p>
                        <p>
                            <label>
                                <input value="2" name="dor_ossea" type="radio" @if(!is_null(old('dor_ossea'))) @if(old('dor_ossea') == 2) checked @endif @else @if ($anamnese->dor_ossea == 2) checked @endif @endif/>
                                <span>Não</span>
                            </label>
                        </p>
                    </div>
                    <div class="input-field col s12 m3">
                        Possui dores musculares?
                        <p>
                            <label>
                                <input value="1" name="dor_muscular" type="radio" @if(!is_null(old('dor_muscular'))) @if(old('dor_muscular') == 1) checked @endif @else @if ($anamnese->dor_muscular == 1) checked @endif @endif/>
                                <span>Sim</span>
                            </label>
                        </p>
                        <p>
                            <label>
                                <input value="2" name="dor_muscular" type="radio" @if(!is_null(old('dor_muscular'))) @if(old('dor_muscular') == 2) checked @endif @else @if ($anamnese->dor_muscular == 2) checked @endif @endif/>
                                <span>Não</span>
                            </label>
                        </p>
                    </div>
                    <div class="input-field col s12 m3">
                        Possui dores articulares?
                        <p>
                            <label>
                                <input value="1" name="dor_articular" type="radio" @if(!is_null(old('dor_articular'))) @if(old('dor_articular') == 2) checked @endif @else @if ($anamnese->dor_articular == 1) checked @endif @endif/>
                                <span>Sim</span>
                            </label>
                        </p>
                        <p>
                            <label>
                                <input value="2" name="dor_articular" type="radio" @if(!is_null(old('dor_articular'))) @if(old('dor_articular') == 2) checked @endif @else @if ($anamnese->dor_articular == 2) checked @endif @endif/>
                                <span>Não</span>
                            </label>
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m5">
                        Possui doenças?
                        <select multiple name="doencas[]">
                            @foreach ($doencaslist as $doenca)
                                <option value="{{$doenca->id}}" @foreach ($anamnese->doencas as $doencaconfirm) @if($doenca->id == $doencaconfirm->id) selected @endif @endforeach>{{$doenca->nome}}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="text" value="2" name="possui_doenca" hidden>
                </div>
                <div class="row">
                    <div class="input-field col s12 m5">
                        <i class="material-icons prefix">description</i>
                        <textarea name="observacao" id="observacao" class="materialize-textarea">@if(is_null('observacao')) {{old('observacao')}} @else {{$anamnese->observacao}} @endif</textarea>
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