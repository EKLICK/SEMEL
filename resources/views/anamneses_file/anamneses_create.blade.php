@extends('layouts.app')
@section('breadcrumbs')
    <a href="{{route('home')}}" class="breadcrumb">Home</a>
    <a href="{{Route('home')}}" class="breadcrumb">Pessoas</a>
    <a href="{{Route('pessoa_info', $pessoa->id)}}" class="breadcrumb">Informações</a>
    <a href="{{Route('pessoas.create')}}" class="breadcrumb">Criar Anamneses</a>
@endsection
@section('title') Anamneses de <?php $nomes = explode(' ',$pessoa->nome);?> {{$nomes[0]}} @endsection
@section('content')
    @include('layouts.Sessoes.errors')
    <div class="container">
        <div class="row">
            <form class="col s12" action="{{route('anamneses.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="text" name="pessoas_id" value="{{$pessoa->id}}" hidden>
                <div class="row">
                    <div class="input-field col s12 m3">
                        <i class="material-icons prefix">local_parking</i>
                        <input name="peso" id="peso" type="number" step="0.01" class="validate" @if(is_null(old('peso'))) value="{{$ultimaanamnese->peso}}" @else value="{{old('peso')}}" @endif>
                        <label for="peso">Peso:</label>
                    </div>
                    <div class="input-field col s12 m3">
                        <i class="material-icons prefix">format_color_text</i>
                        <input name="altura" id="altura" type="number" step="0.01" class="validate" @if(is_null(old('altura'))) value="{{$ultimaanamnese->altura}}" @else value="{{old('altura')}}" @endif>
                        <label for="altura">Altura:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m4">
                        Toma algum medicamento? <span style="color: red;">*</span>
                        <p>
                            <label>
                                <input onclick="toma_medicacao_click('S')" value="1" name="toma_medicacao" type="radio" @if(!is_null(old('toma_medicacao'))) @if(old('toma_medicacao') == 1) checked @endif @else @if ($ultimaanamnese->toma_medicacao != -1) checked @endif @endif/>
                                <span>Sim</span>
                            </label>
                            &emsp;&emsp;
                            <label>
                                <input onclick="toma_medicacao_click('N')" value="2" name="toma_medicacao" type="radio" @if(!is_null(old('toma_medicacao'))) @if(old('toma_medicacao') == 2) checked @endif @else @if ($ultimaanamnese->toma_medicacao == -1) checked @endif @endif/>
                                <span>Não</span>
                            </label>
                        </p>
                    </div>
                    <div class="input-field col s12 m6">
                        <i id="toma_medicacao_icon" class="material-icons prefix" @if(!is_null(old('toma_medicacao'))) @if(old('toma_medicacao') != 1) hidden @endif @else @if ($ultimaanamnese->toma_medicacao == -1) hidden @endif @endif>description</i>
                        <input id="string_toma_medicacao" name="string_toma_medicacao" type="text" class="validate" value="@if(is_null(old('toma_medicacao'))) @if($ultimaanamnese->toma_medicacao != -1) {{$ultimaanamnese->toma_medicacao}} @endif @else {{old('string_toma_medicacao')}} @endif" @if(!is_null(old('toma_medicacao'))) @if(old('toma_medicacao') == 2) hidden @endif @else @if($ultimaanamnese->toma_medicacao == -1) hidden @endif @endif maxlength="50">
                        <label id="toma_medicacao_label" for="string_toma_medicacao" @if(!is_null(old('toma_medicacao'))) @if(old('toma_medicacao') != 1) hidden @endif @else @if($ultimaanamnese->toma_medicacao == -1) hidden @endif @endif>Qual medicamento?</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m4">
                        Possui alergia médica? <span style="color: red;">*</span>
                        <p>
                            <label>
                                <input onclick="alergia_medicacao_click('S')" value="1" name="alergia_medicacao" type="radio" @if(!is_null(old('alergia_medicacao'))) @if(old('alergia_medicacao') == 1) checked @endif @else @if ($ultimaanamnese->alergia_medicacao != -1) checked @endif @endif/>
                                <span>Sim</span>
                            </label>
                            &emsp;&emsp;
                            <label>
                                <input onclick="alergia_medicacao_click('N')" value="2" name="alergia_medicacao" type="radio"  @if(!is_null(old('alergia_medicacao'))) @if(old('alergia_medicacao') == 2) checked @endif @else @if ($ultimaanamnese->alergia_medicacao == -1) checked @endif @endif/>
                                <span>Não</span>
                            </label>
                        </p>
                    </div>
                    <div class="input-field col s12 m6">
                        <i id="alergia_medicacao_icon" class="material-icons prefix" @if(!is_null(old('alergia_medicacao'))) @if(old('alergia_medicacao') != 1) hidden @endif @else @if ($ultimaanamnese->alergia_medicacao == -1) hidden @endif @endif>description</i>
                        <input id="string_alergia_medicacao" name="string_alergia_medicacao" type="text" class="validate" value="@if(is_null(old('alergia_medicacao'))) @if($ultimaanamnese->alergia_medicacao != -1) {{$ultimaanamnese->alergia_medicacao}} @endif @else {{old('string_alergia_medicacao')}} @endif" @if(!is_null(old('alergia_medicacao'))) @if(old('alergia_medicacao') == 2) hidden @endif @else @if ($ultimaanamnese->alergia_medicacao == -1) hidden @endif @endif maxlength="50">
                        <label id="alergia_medicacao_label" for="string_alergia_medicacao" @if(!is_null(old('alergia_medicacao'))) @if(old('alergia_medicacao') != 1) hidden @endif @else @if ($ultimaanamnese->alergia_medicacao == -1) hidden @endif @endif>Qual alergia médica?</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m4">
                        O usuário já fez cirurgia? <span style="color: red;">*</span>
                        <p>
                            <label>
                                <input onclick="cirurgia_click('S')" value="1" name="cirurgia" type="radio" @if(!is_null(old('cirurgia'))) @if(old('cirurgia') == 1) checked @endif @else @if ($ultimaanamnese->cirurgia != -1) checked @endif @endif/>
                                <span>Sim</span>
                            </label>
                            &emsp;&emsp;
                            <label>
                                <input onclick="cirurgia_click('N')" value="2" name="cirurgia" type="radio"  @if(!is_null(old('cirurgia'))) @if(old('cirurgia') == 2) checked @endif @else @if ($ultimaanamnese->cirurgia == -1) checked @endif @endif/>
                                <span>Não</span>
                            </label>
                        </p>
                    </div>
                    <div class="input-field col s12 m6">
                        <i id="cirurgia_icon" class="material-icons prefix" @if(!is_null(old('cirurgia'))) @if(old('cirurgia') != 1) hidden @endif @else @if ($ultimaanamnese->cirurgia == -1) hidden @endif @endif>description</i>
                        <input id="string_cirurgia" name="string_cirurgia" type="text" class="validate" value="@if(is_null(old('cirurgia'))) @if($ultimaanamnese->cirurgia != -1) {{$ultimaanamnese->cirurgia}} @endif @else {{old('string_cirurgia')}} @endif" @if(!is_null(old('cirurgia'))) @if(old('cirurgia') == 2) hidden @endif @else @if ($ultimaanamnese->cirurgia == -1) hidden @endif @endif maxlength="50">
                        <label id="cirurgia_label" for="string_cirurgia" @if(!is_null(old('cirurgia'))) @if(old('cirurgia') != 1) hidden @endif @else @if ($ultimaanamnese->cirurgia == -1) hidden @endif @endif>Aonde foi a cirurgia?</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m4">
                        Possui dores ósseas? <span style="color: red;">*</span>
                        <p>
                            <label>
                                <input onclick="dor_ossea_click('S')" value="1" name="dor_ossea" type="radio"  @if(!is_null(old('dor_ossea'))) @if(old('dor_ossea') == 1) checked @endif @else @if ($ultimaanamnese->dor_ossea != -1) checked @endif @endif/>
                                <span>Sim</span>
                            </label>
                            &emsp;&emsp;
                            <label>
                                <input onclick="dor_ossea_click('N')" value="2" name="dor_ossea" type="radio" @if(!is_null(old('dor_ossea'))) @if(old('dor_ossea') == 2) checked @endif @else @if ($ultimaanamnese->dor_ossea == -1) checked @endif @endif/>
                                <span>Não</span>
                            </label>
                        </p>
                    </div>
                    <div class="input-field col s12 m6">
                        <i id="dor_ossea_icon" class="material-icons prefix" @if(!is_null(old('dor_ossea'))) @if(old('dor_ossea') != 1) hidden @endif @else @if ($ultimaanamnese->dor_ossea == -1) hidden @endif @endif>description</i>
                        <input id="string_dor_ossea" name="string_dor_ossea" type="text" class="validate" value="@if(is_null(old('dor_ossea'))) @if($ultimaanamnese->dor_ossea != -1) {{$ultimaanamnese->dor_ossea}} @endif @else {{old('string_dor_ossea')}} @endif" @if(!is_null(old('dor_ossea'))) @if(old('dor_ossea') == 2) hidden @endif @else @if ($ultimaanamnese->dor_ossea == -1) hidden @endif @endif maxlength="50">
                        <label id="dor_ossea_label" for="string_dor_ossea" @if(!is_null(old('dor_ossea'))) @if(old('dor_ossea') != 1) hidden @endif @else @if ($ultimaanamnese->dor_ossea == -1) hidden @endif @endif>Aonde está a dor óssea?</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m4">
                        Possui dores musculares? <span style="color: red;">*</span>
                        <p>
                            <label>
                                <input onclick="dor_muscular_click('S')" value="1" name="dor_muscular" type="radio" @if(!is_null(old('dor_muscular'))) @if(old('dor_muscular') == 1) checked @endif @else @if ($ultimaanamnese->dor_muscular != -1) checked @endif @endif/>
                                <span>Sim</span>
                            </label>
                            &emsp;&emsp;
                            <label>
                                <input onclick="dor_muscular_click('N')" value="2" name="dor_muscular" type="radio" @if(!is_null(old('dor_muscular'))) @if(old('dor_muscular') == 2) checked @endif @else @if ($ultimaanamnese->dor_muscular == -1) checked @endif @endif/>
                                <span>Não</span>
                            </label>
                        </p>
                    </div>
                    <div class="input-field col s12 m6">
                        <i id="dor_muscular_icon" class="material-icons prefix" @if(!is_null(old('dor_muscular'))) @if(old('dor_muscular') != 1) hidden @endif @else @if ($ultimaanamnese->dor_muscular == -1) hidden @endif @endif>description</i>
                        <input id="string_dor_muscular" name="string_dor_muscular" type="text" class="validate" value="@if(is_null(old('dor_muscular'))) @if($ultimaanamnese->dor_muscular != -1) {{$ultimaanamnese->dor_muscular}} @endif @else {{old('string_dor_muscular')}} @endif" @if(!is_null(old('dor_muscular'))) @if(old('dor_muscular') == 2) hidden @endif @else @if ($ultimaanamnese->dor_muscular == -1) hidden @endif @endif maxlength="50">
                        <label id="dor_muscular_label" for="string_dor_muscular" @if(!is_null(old('dor_muscular'))) @if(old('dor_muscular') != 1) hidden @endif @else @if ($ultimaanamnese->dor_muscular == -1) hidden @endif @endif>Aonde está a dor muscular?</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m4">
                        Possui dores articulares? <span style="color: red;">*</span>
                        <p>
                            <label>
                                <input onclick="dor_articular_click('S')" value="1" name="dor_articular" type="radio" @if(!is_null(old('dor_articular'))) @if(old('dor_articular') == 2) checked @endif @else @if ($ultimaanamnese->dor_articular != -1) checked @endif @endif/>
                                <span>Sim</span>
                            </label>
                            &emsp;&emsp;
                            <label>
                                <input onclick="dor_articular_click('N')" value="2" name="dor_articular" type="radio" @if(!is_null(old('dor_articular'))) @if(old('dor_articular') == 2) checked @endif @else @if ($ultimaanamnese->dor_articular == -1) checked @endif @endif/>
                                <span>Não</span>
                            </label>
                        </p>
                    </div>
                    <div class="input-field col s12 m6">
                        <i id="dor_articular_icon" class="material-icons prefix" @if(!is_null(old('dor_articular'))) @if(old('dor_articular') != 1) hidden @endif @else @if ($ultimaanamnese->dor_articular == -1) hidden @endif @endif>description</i>
                        <input id="string_dor_articular" name="string_dor_articular" type="text" class="validate" value="@if(is_null(old('dor_articular'))) @if($ultimaanamnese->dor_articular != -1) {{$ultimaanamnese->dor_articular}} @endif @else {{old('string_dor_articular')}} @endif" @if(!is_null(old('dor_articular'))) @if(old('dor_articular') == 2) hidden @endif @else @if ($ultimaanamnese->dor_articular == -1) hidden @endif @endif maxlength="50">
                        <label id="dor_articular_label" for="string_dor_articular" @if(!is_null(old('dor_articular'))) @if(old('dor_articular') != 1) hidden @endif @else @if ($ultimaanamnese->dor_articular == -1) hidden @endif @endif>Aonde está a dor articular?</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m4">
                        O usuário fuma? <span style="color: red;">*</span>
                        <p>
                            <label>
                                <input onclick="fumante_click('S')" value="1" name="fumante" type="radio" @if(!is_null(old('fumante'))) @if(old('fumante') == 1) checked @endif @else @if ($ultimaanamnese->fumante == 1) checked @endif @endif/>
                                <span>Sim</span>
                            </label>
                            &emsp;&emsp;
                            <label>
                                <input onclick="fumante_click('N')" value="2" name="fumante" type="radio" @if(!is_null(old('fumante'))) @if(old('fumante') == 2) checked @endif @else @if ($ultimaanamnese->fumante == 2) checked @endif @endif/>
                                <span>Não</span>
                            </label>
                        </p>
                    </div>
                    <div class="input-field col s12 m6">
                        <i id="fumante_icon" class="material-icons prefix" @if(!is_null(old('fumante'))) @if(old('fumante') != 1) hidden @endif @else @if ($ultimaanamnese->fumante == -1) hidden @endif @endif>description</i>
                        <input id="string_fumante" name="string_fumante" type="text" class="validate" value="@if(is_null(old('fumante'))) @if($ultimaanamnese->fumante != -1) {{$ultimaanamnese->fumante}} @endif @else {{old('string_fumante')}} @endif" @if(!is_null(old('fumante'))) @if(old('fumante') == 2) hidden @endif @else @if ($ultimaanamnese->fumante == -1) hidden @endif @endif maxlength="50">
                        <label id="fumante_label" for="string_fumante" @if(!is_null(old('fumante'))) @if(old('fumante') != 1) hidden @endif @else @if ($ultimaanamnese->fumante == -1) hidden @endif @endif>Fuma há quanto tempo?</label>
                    </div>
                </div>
                <div class="row">
                    <input type="text" name="old_doencas" id="old_doencas" value="{{old('old_doencas')}}" hidden>
                    @php $old_ids_doencas = explode(',', old('old_doencas')) @endphp
                    <div class="input-field col s12 m5">
                        Possui doenças?
                        <select multiple name="doencas[]" id="lista_de_pessoas" onchange="old_doencas_function()">
                            @foreach ($doencaslist as $doenca)
                                <option value="{{$doenca->id}}" @if(!is_null($old_ids_doencas)) @foreach ($ultimaanamnese->doencas as $doencaconfirm) @if($doenca->id == $doencaconfirm->id) selected @endif @endforeach @else @foreach ($old_ids_doencas as $old_doenca) @if($doenca->id == $old_doenca) selected @endif @endforeach @endif>{{$doenca->nome}}</option>
                            @endforeach
                        </select>
                        <input type="text" value="2" name="possui_doenca" hidden>
                    </div>
                    <div class="input-field col s12 m5">
                        <a href="#adicionardoenca" class="btn-floating modal-trigger btn-modal_inativar light-blue darken-1"><i class="material-icons">note_add</i></a>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m5">
                        <div class="file-field input-field">
                            <div class="btn">
                                <span>Atestado médico <span style="color: red;">*</span></span>
                                <input id="img_atestado" type="file" name="img_atestado">
                            </div>
                            <a id="limpar_atestado"  class="waves-effect waves-light btn" style="margin-left: 5%;">Limpar</a>
                            <br><br><br>
                            <div class="file-path-wrapper">
                                <input id="atestado" name="atestado" class="file-path validate" type="text" required>
                            </div>
                        </div>
                    </div>
                    <div class="input-field col s12 m6 right" style="margin-top: -0.1%;">
                        <img id="atestado_image" class="materialboxed imagensparafoto" src="@if(!is_null($ultimaanamnese->atestado)) {{asset($ultimaanamnese->atestado)}} @else {{asset('/img/unset_image_atestado.png')}} @endif">
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m5">
                        <i class="material-icons prefix">description</i>
                        <textarea name="observacao" id="observacao" class="materialize-textarea" maxlength="100">@if(is_null('observacao')) {{old('observacao')}} @else {{$ultimaanamnese->observacao}} @endif</textarea>
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
                            <input id="nome_doenca" type="text" class="validate" maxlength="30" required>
                            <label for="nome_doenca">Nome da doença: <span style="color: red;">*</span></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12 m10">
                            <i class="material-icons prefix">description</i>
                            <textarea id="descricao_doenca" class="materialize-textarea" maxlength="100" required></textarea>
                            <label for="descricao_doenca">Observação: <span style="color: red;">*</span></label>
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