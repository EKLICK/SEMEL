@extends('layouts.app')

@section('css.personalizado')@endsection
@section('breadcrumbs')
    <a href="{{route('anamneses.index')}}" class="breadcrumb">Anamneses</a>
    <a href="{{route('anamneses.edit', $anamnese->id)}}" class="breadcrumb">Editar</a>
@endsection
@section('title') Editar anamneses @endsection
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
            <form class="col s12" action="{{route('anamneses.update', $anamnese->id)}}" method="post">
                @csrf
                <input type="text" name="ano" id="ano" value="{{date('Y')}}" hidden>
                <input type="number" name="pessoa_id" value="{{$anamnese->pessoas->id}}" hidden>
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
                    <div class="input-field col s12 m4">
                        Toma algum medicamento?
                        <p>
                            <label>
                                <input onclick="toma_medicacao_click('S')" value="1" name="toma_medicacao" type="radio" @if(!is_null(old('toma_medicacao'))) @if(old('toma_medicacao') == 1) checked @endif @else @if ($anamnese->toma_medicacao != -1) checked @endif @endif/>
                                <span>Sim</span>
                            </label>
                        </p>
                        <p>
                            <label>
                                <input onclick="toma_medicacao_click('N')" value="2" name="toma_medicacao" type="radio" @if(!is_null(old('toma_medicacao'))) @if(old('toma_medicacao') == 2) checked @endif @else @if ($anamnese->toma_medicacao == -1) checked @endif @endif/>
                                <span>Não</span>
                            </label>
                        </p>
                    </div>
                    <div class="input-field col s12 m6">
                        <i id="toma_medicacao_icon" class="material-icons prefix" @if(!is_null(old('toma_medicacao'))) @if(old('toma_medicacao') == 2) hidden @endif @else @if ($anamnese->toma_medicacao == -1) hidden @endif @endif>description</i>
                        <input id="string_toma_medicacao" name="string_toma_medicacao" type="text" class="validate" value="@if(is_null(old('toma_medicacao'))) @if($anamnese->toma_medicacao != -1) {{$anamnese->toma_medicacao}} @endif @else {{old('string_toma_medicacao')}} @endif" @if(!is_null(old('toma_medicacao'))) @if(old('toma_medicacao') == -1) hidden @endif @else @if($anamnese->toma_medicacao == -1) hidden @endif @endif>
                        <label id="toma_medicacao_label" for="string_toma_medicacao" @if(!is_null(old('toma_medicacao'))) @if(old('toma_medicacao') == 2) hidden @endif @else @if($anamnese->toma_medicacao == -1) hidden @endif @endif>Qual medicamento?</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m4">
                        Possui alergia médica?
                        <p>
                            <label>
                                <input onclick="alergia_medicacao_click('S')" value="1" name="alergia_medicacao" type="radio" @if(!is_null(old('alergia_medicacao'))) @if(old('alergia_medicacao') == 1) checked @endif @else @if ($anamnese->alergia_medicacao != -1) checked @endif @endif/>
                                <span>Sim</span>
                            </label>
                        </p>
                        <p>
                            <label>
                                <input onclick="alergia_medicacao_click('N')" value="2" name="alergia_medicacao" type="radio"  @if(!is_null(old('alergia_medicacao'))) @if(old('alergia_medicacao') == 2) checked @endif @else @if ($anamnese->alergia_medicacao == -1) checked @endif @endif/>
                                <span>Não</span>
                            </label>
                        </p>
                    </div>
                    <div class="input-field col s12 m6">
                        <i id="alergia_medicacao_icon" class="material-icons prefix" @if(!is_null(old('alergia_medicacao'))) @if(old('alergia_medicacao') == 2) hidden @endif @else @if ($anamnese->alergia_medicacao == -1) hidden @endif @endif>description</i>
                        <input id="string_alergia_medicacao" name="string_alergia_medicacao" type="text" class="validate" value="@if(is_null(old('alergia_medicacao'))) @if($anamnese->alergia_medicacao != -1) {{$anamnese->alergia_medicacao}} @endif @else {{old('string_alergia_medicacao')}} @endif" @if(!is_null(old('alergia_medicacao'))) @if(old('alergia_medicacao') == -1) hidden @endif @else @if ($anamnese->alergia_medicacao == -1) hidden @endif @endif>
                        <label id="alergia_medicacao_label" for="string_alergia_medicacao" @if(!is_null(old('alergia_medicacao'))) @if(old('alergia_medicacao') == 2) hidden @endif @else @if ($anamnese->alergia_medicacao == -1) hidden @endif @endif>Qual alergia médica?</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m4">
                        O usuário já fez cirurgia?
                        <p>
                            <label>
                                <input onclick="cirurgia_click('S')" value="1" name="cirurgia" type="radio" @if(!is_null(old('cirurgia'))) @if(old('cirurgia') == 1) checked @endif @else @if ($anamnese->cirurgia != -1) checked @endif @endif/>
                                <span>Sim</span>
                            </label>
                        </p>
                        <p>
                            <label>
                                <input onclick="cirurgia_click('N')" value="2" name="cirurgia" type="radio"  @if(!is_null(old('cirurgia'))) @if(old('cirurgia') == 2) checked @endif @else @if ($anamnese->cirurgia == -1) checked @endif @endif/>
                                <span>Não</span>
                            </label>
                        </p>
                    </div>
                    <div class="input-field col s12 m6">
                        <i id="cirurgia_icon" class="material-icons prefix" @if(!is_null(old('cirurgia'))) @if(old('cirurgia') == 2) hidden @endif @else @if ($anamnese->cirurgia == -1) hidden @endif @endif>description</i>
                        <input id="string_cirurgia" name="string_cirurgia" type="text" class="validate" value="@if(is_null(old('cirurgia'))) @if($anamnese->cirurgia != -1) {{$anamnese->cirurgia}} @endif @else {{old('string_cirurgia')}} @endif" @if(!is_null(old('cirurgia'))) @if(old('cirurgia') == -1) hidden @endif @else @if ($anamnese->cirurgia == -1) hidden @endif @endif>
                        <label id="cirurgia_label" for="string_cirurgia" @if(!is_null(old('cirurgia'))) @if(old('cirurgia') == 2) hidden @endif @else @if ($anamnese->cirurgia == -1) hidden @endif @endif>Aonde foi a cirurgia?</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m4">
                        Possui dores ósseas?
                        <p>
                            <label>
                                <input onclick="dor_ossea_click('S')" value="1" name="dor_ossea" type="radio"  @if(!is_null(old('dor_ossea'))) @if(old('dor_ossea') == 1) checked @endif @else @if ($anamnese->dor_ossea != -1) checked @endif @endif/>
                                <span>Sim</span>
                            </label>
                        </p>
                        <p>
                            <label>
                                <input onclick="dor_ossea_click('N')" value="2" name="dor_ossea" type="radio" @if(!is_null(old('dor_ossea'))) @if(old('dor_ossea') == 2) checked @endif @else @if ($anamnese->dor_ossea == -1) checked @endif @endif/>
                                <span>Não</span>
                            </label>
                        </p>
                    </div>
                    <div class="input-field col s12 m6">
                        <i id="dor_ossea_icon" class="material-icons prefix" @if(!is_null(old('dor_ossea'))) @if(old('dor_ossea') == 2) hidden @endif @else @if ($anamnese->dor_ossea == -1) hidden @endif @endif>description</i>
                        <input id="string_dor_ossea" name="string_dor_ossea" type="text" class="validate" value="@if(is_null(old('dor_ossea'))) @if($anamnese->dor_ossea != -1) {{$anamnese->dor_ossea}} @endif @else {{old('string_dor_ossea')}} @endif" @if(!is_null(old('dor_ossea'))) @if(old('dor_ossea') == -1) hidden @endif @else @if ($anamnese->dor_ossea == -1) hidden @endif @endif>
                        <label id="dor_ossea_label" for="string_dor_ossea" @if(!is_null(old('dor_ossea'))) @if(old('dor_ossea') == 2) hidden @endif @else @if ($anamnese->dor_ossea == -1) hidden @endif @endif>Aonde está a dor óssea?</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m4">
                        Possui dores musculares?
                        <p>
                            <label>
                                <input onclick="dor_muscular_click('S')" value="1" name="dor_muscular" type="radio" @if(!is_null(old('dor_muscular'))) @if(old('dor_muscular') == 1) checked @endif @else @if ($anamnese->dor_muscular != -1) checked @endif @endif/>
                                <span>Sim</span>
                            </label>
                        </p>
                        <p>
                            <label>
                                <input onclick="dor_muscular_click('N')" value="2" name="dor_muscular" type="radio" @if(!is_null(old('dor_muscular'))) @if(old('dor_muscular') == 2) checked @endif @else @if ($anamnese->dor_muscular == -1) checked @endif @endif/>
                                <span>Não</span>
                            </label>
                        </p>
                    </div>
                    <div class="input-field col s12 m6">
                        <i id="dor_muscular_icon" class="material-icons prefix" @if(!is_null(old('dor_muscular'))) @if(old('dor_muscular') == 2) hidden @endif @else @if ($anamnese->dor_muscular == -1) hidden @endif @endif>description</i>
                        <input id="string_dor_muscular" name="string_dor_muscular" type="text" class="validate" value="@if(is_null(old('dor_muscular'))) @if($anamnese->dor_muscular != -1) {{$anamnese->dor_muscular}} @endif @else {{old('string_dor_muscular')}} @endif" @if(!is_null(old('dor_muscular'))) @if(old('dor_muscular') == -1) hidden @endif @else @if ($anamnese->dor_muscular == -1) hidden @endif @endif>
                        <label id="dor_muscular_label" for="string_dor_muscular" @if(!is_null(old('dor_muscular'))) @if(old('dor_muscular') == 2) hidden @endif @else @if ($anamnese->dor_muscular == -1) hidden @endif @endif>Aonde está a dor muscular?</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m4">
                        Possui dores articulares?
                        <p>
                            <label>
                                <input onclick="dor_articular_click('S')" value="1" name="dor_articular" type="radio" @if(!is_null(old('dor_articular'))) @if(old('dor_articular') == 2) checked @endif @else @if ($anamnese->dor_articular != -1) checked @endif @endif/>
                                <span>Sim</span>
                            </label>
                        </p>
                        <p>
                            <label>
                                <input onclick="dor_articular_click('N')" value="2" name="dor_articular" type="radio" @if(!is_null(old('dor_articular'))) @if(old('dor_articular') == 2) checked @endif @else @if ($anamnese->dor_articular == -1) checked @endif @endif/>
                                <span>Não</span>
                            </label>
                        </p>
                    </div>
                    <div class="input-field col s12 m6">
                        <i id="dor_articular_icon" class="material-icons prefix" @if(!is_null(old('dor_articular'))) @if(old('dor_articular') == 2) hidden @endif @else @if ($anamnese->dor_articular == -1) hidden @endif @endif>description</i>
                        <input id="string_dor_articular" name="string_dor_articular" type="text" class="validate" value="@if(is_null(old('dor_articular'))) @if($anamnese->dor_articular != -1) {{$anamnese->dor_articular}} @endif @else {{old('string_dor_articular')}} @endif" @if(!is_null(old('dor_articular'))) @if(old('dor_articular') == -1) hidden @endif @else @if ($anamnese->dor_articular == -1) hidden @endif @endif>
                        <label id="dor_articular_label" for="string_dor_articular" @if(!is_null(old('dor_articular'))) @if(old('dor_articular') == 2) hidden @endif @else @if ($anamnese->dor_articular == -1) hidden @endif @endif>Aonde está a dor articular?</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m4">
                        O usuário fuma?
                        <p>
                            <label>
                                <input value="1" name="fumante" type="radio" @if(!is_null(old('fumante'))) @if(old('fumante') == 1) checked @endif @else @if ($anamnese->fumante == 'sim') checked @endif @endif/>
                                <span>Sim</span>
                            </label>
                        </p>
                        <p>
                            <label>
                                <input value="2" name="fumante" type="radio" @if(!is_null(old('fumante'))) @if(old('fumante') == 2) checked @endif @else @if ($anamnese->fumante == 'não') checked @endif @endif/>
                                <span>Não</span>
                            </label>
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m5">
                        Possui doenças?
                        <select multiple name="doencas[]" id="lista_de_pessoas">
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

            
    <div id="adicionardoenca" class="modal" style="width: 50%; height: 55%;">
        <div class="container">
            <br>
            <h5>Criar Doença</h5>
            <form id="ajax_doenca">
                @csrf
                <div class="modal-content">
                    <div class="row">
                        <div class="input-field col s12 m10">
                            <i class="material-icons prefix">new_releases</i>
                            <input id="nome_doenca" type="text" class="validate">
                            <label for="nome_doenca">Nome da doença:</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12 m10">
                            <i class="material-icons prefix">description</i>
                            <textarea id="descricao_doenca" class="materialize-textarea"></textarea>
                            <label for="descricao_doenca">Observação</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a class="btn-floating btn-large" id="botao"><i class="material-icons">add</i></a>
                </div>
            </form>
        </div>
    </div>
@endsection