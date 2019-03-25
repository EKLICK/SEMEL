@extends('layouts.app')
@section('breadcrumbs')
    <a href="{{route('home')}}" class="breadcrumb">Home</a>
    <a href="{{route('pessoas.index')}}" class="breadcrumb">Pessoas</a>
    <a href="{{route('pessoas.create')}}" class="breadcrumb">Criar</a>
@endsection
@section('title') Criar pessoa @endsection
@section('content')
    @include('layouts.Sessoes.errors')
    <div class="container">
        <div class="row">
            <form class="col s12" action="{{route('pessoas.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <h5>Registro da pessoa:</h5>
                <a id="muda_foto" onclick="muda_foto('{{asset('/img/unset_image_3x4.png')}}')" class="waves-effect waves-light btn-large blue" href="#!">Trocar para pastas&emsp;&nbsp; <i class="material-icons">satellite</i></a>
                <div id="image_file" class="row" style="display: none">
                    <div class="file-field input-field col s12 m5">
                        <br><br>
                        <p>Foto 3 por 4 (.img | .png | .jpg):</p>
                        <div class="btn blue">
                            <span>Abrir arquivo</span>
                            <input id="img_3x4" type="file" name="img_3x4" value="{{old('img_3x4')}}">
                        </div>
                        <a id="limpar_3x4" class="waves-effect waves-light btn blue" style="margin-left: 5%;">Limpar</a>
                        <br><br><br>
                        <div class="file-path-wrapper container left">
                            <input id="3x4" class="file-path validate" type="text">
                        </div>
                    </div>
                    <div class="input-field col s12 m7 right">
                        <img id="3x4_image" class="materialboxed imagensparafoto" src="{{asset('/img/unset_image_3x4.png')}}">
                    </div>
                </div>
                <div id="image_web" class='row'>
                    <div class="file-field input-field col s12 m5">
                        <br><br>
                        <p>Foto 3 por 4:</p>
                        <a href="#fotomodal" onclick="foto()" class="modal-trigger btn-large light-blue darken-1">Abrir webcam</a>
                        <a onclick="apagar_web()" class="btn-large waves-effect waves-light blue" style="margin-left: 5%;">limpar</a>
                    </div>
                    <div class="file-field input-field col s12 m5">
                        <img id="img_web" class="materialboxed imagensparafoto" src="{{asset('/img/unset_image_3x4.png')}}">
                        <input id="web_image" type="text" name="foto_web" hidden>
                        <canvas id="canvas_foto" width="400" height="300" hidden></canvas>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m5">
                        <i class="material-icons prefix">account_circle</i>
                        <input name="nome" id="nome" type="text" class="validate" value="{{old('nome')}}" maxlength="30" required>
                        <label for="nome">Nome (obrigatório):</label>
                    </div>
                    <div class="input-field col s12 m5">
                        <i class="material-icons prefix">child_friendly</i>
                        <input id="nascimento" type="text" class="datepicker validate" name="nascimento" value="{{old('nascimento')}}" maxlength="10" required>
                        <label for="nascimento">Data de nascimento (obrigatório):</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m5">
                        <i class="material-icons prefix">credit_card</i>
                        <input onkeydown="javascript: fMasc(this, mCPF)" name="cpf" id="cpf" type="text" class="validate" value="{{old('cpf')}}" maxlength="14">
                        <label for="cpf">CPF próprio:</label>
                    </div>
                    <div class="input-field col s12 m5">
                        <i class="material-icons prefix">credit_card</i>
                        <input onkeydown="javascript: fMasc(this, mCPF)" name="cpf_responsavel" id="cpf_responsavel" type="text" class="validate" value="{{old('cpf_responsavel')}}" maxlength="14">
                        <label for="cpf_responsavel">CPF do responsavel:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m5">
                        <i class="material-icons prefix">assignment_ind</i>
                        <input name="rg" id="rg" type="text" class="validate" value="{{old('rg')}}" maxlength="13">
                        <label for="rg">RG:</label>
                    </div>
                    <div class="input-field col s12 m5">
                        <i class="material-icons prefix">assignment_ind</i>
                        <input name="rg_responsavel" id="rg_responsavel" type="text" class="validate" value="{{old('rg_responsavel')}}" maxlength="13">
                        <label for="rg_responsavel">RG do responsavel:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m5">
                        <i class="material-icons prefix">business</i>
                        <input name="cidade" id="cidade" type="text" class="validate" @if(!is_null(old('cidade'))) value="{{old('cidade')}}" @else value="São Leopoldo" @endif maxlength="30">
                        <label for="cidade">Cidade:</label>
                    </div>
                    <div class="input-field col s12 m5">
                        <a class="waves-effect waves-light btn-floating right" style="margin-top: -10%; background-color: #039be5;" onclick="change_bairro()"><i class="material-icons">cached</i></a>
                        <div id="div_bairro_list" @if(!is_null(old('string_bairro'))) hidden @endif>
                            <i class="material-icons prefix">location_city</i>&emsp;&emsp; Bairros
                            <select name="bairro" onchange="change_bairro_select()" id="bairro_select">
                                <option value="" selected disabled>Selecione o bairro</option>
                                @foreach ($bairroslist as $bairro)
                                    <option value="{{$bairro}}" @if(old('string_bairro') == $bairro) selected @endif>{{$bairro}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div id="div_bairro_string" @if(is_null(old('string_bairro'))) hidden @endif>
                            <i class="material-icons prefix">location_city</i>
                            <input id="string_bairro" name="string_bairro" type="text" class="validate" value="{{old('string_bairro')}}" maxlength="15">
                            <label for="string_bairro">Bairro:</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m5">
                        <i class="material-icons prefix">confirmation_number</i>
                        <input name="rua" id="rua" type="text" class="validate" value="{{old('rua')}}" maxlength="15">
                        <label for="rua">Rua:</label>
                    </div>
                    <div class="input-field col s12 m5">
                        <i class="material-icons prefix">explore</i>
                        <input onkeydown="javascript: fMasc(this, mCEP)" name="cep" id="cep" type="text" class="validate" value="{{old('cep')}}" maxlength="10">
                        <label for="cep">CEP:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m5">
                        <i class="material-icons prefix">location_on</i>
                        <input onkeydown="javascript: fMasc(this, mNum)" name="numero_endereco" id="numero_endereco" type="number" class="validate" value="{{old('numero_endereco')}}" maxlength="5">
                        <label for="numero_endereco">Número:</label>
                    </div>
                    <div class="input-field col s12 m5">
                        <i class="material-icons prefix">bookmark</i>
                        <input name="complemento" id="complemento" type="text" class="validate" value="{{old('complemento')}}" maxlength="10">
                        <label for="complemento">Complemento de endereço:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m5">
                        <i class="material-icons prefix">phone</i>
                        <input onkeydown="javascript: fMasc(this, mTel)" name="telefone" id="telephone" type="tel" class="validate" value="{{old('telefone')}}" maxlength="16">
                        <label for="telephone">Telefone:</label>
                    </div>
                    <div class="input-field col s12 m5">
                        <i class="material-icons prefix">contact_phone</i>
                        <input onkeydown="javascript: fMasc(this, mTel)" name="telefone_emergencia" id="telephone_emergencia" type="tel" class="validate" value="{{old('telefone_emergencia')}}" maxlength="16">
                        <label for="telephone_emergencia">Telefone emergência:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m3">
                        <i class="material-icons prefix">person</i>
                        <input name="nome_do_pai" id="nome_do_pai" type="text" class="validate" value="{{old('nome_do_pai')}}" maxlength="30">
                        <label for="nome_do_pai">Nome do pai:</label>
                    </div>
                    <div class="input-field col s12 m3">
                        <i class="material-icons prefix">person_outline</i>
                        <input name="nome_da_mae" id="nome_da_mae" type="text" class="validate" value="{{old('nome_da_mae')}}" maxlength="30">
                        <label for="nome_da_mae">Nome do mãe:</label>
                    </div>
                    <div class="input-field col s12 m4">
                        <i class="material-icons prefix">person_add</i>
                        <input name="pessoa_emergencia" id="pessoa_emergencia" type="text" class="validate" value="{{old('pessoa_emergencia')}}" maxlength="30">
                        <label for="pessoa_emergencia">Pessoa emergência:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m2">
                        <i class="material-icons prefix">child_care</i>
                        <input name="filhos" id="filhos" type="number" min=0 class="validate" @if(is_null(old('filhos'))) value="0" @else value="{{old('filhos')}}" @endif>
                        <label for="filhos">Filhos:</label>
                    </div>
                    <div class="input-field col s12 m2">
                        <i class="material-icons prefix">people</i>
                        <input name="irmaos" id="irmaos" type="number" min=0 class="validate" @if(is_null(old('irmaos'))) value="0" @else  value="{{old('irmaos')}}" @endif>
                        <label for="irmaos">Irmãos:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m4">
                        Possui convênio médico?
                        <p>
                            <label>
                                <input onclick="convenio_medico_click('S')" value="1" name="convenio_medico" type="radio" @if(old('convenio_medico') == 1) checked @endif/>
                                <span>Sim</span>
                            </label>
                        </p>
                        <p>
                            <label>
                                <input onclick="convenio_medico_click('N')" value="2" name="convenio_medico" type="radio" @if(old('convenio_medico') == 2) checked @endif/>
                                <span>Não</span>
                            </label>
                        </p>
                    </div>
                    <div class="input-field col s12 m6">
                        <i id="convenio_icon" class="material-icons prefix" @if(old('convenio_medico') != 1) hidden @endif>add_box</i>
                        <input id="string_convenio_medico" name="string_convenio_medico" type="text" class="validate" value="{{old('string_convenio_medico')}}" @if(old('convenio_medico') != 1) hidden @endif>
                        <label id="convenio_label" for="string_convenio_medico" @if(old('convenio_medico') != 1) hidden @endif>Convênio médico:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m5">
                        <div class="file-field input-field">
                            <p>matricula escolar (.img | .png | .jpg):</p>
                            <div class="btn blue">
                                <span>Abrir arquivo</span>
                                <input id="img_matricula" type="file" name="img_matricula">
                            </div>
                            <a id="limpar_matricula"  class="waves-effect waves-light btn blue" style="margin-left: 5%;">Limpar</a>
                            <br><br><br>
                            <div class="file-path-wrapper">
                                <input id="matricula" name="matricula" class="file-path validate" type="text">
                            </div>
                        </div>
                    </div>
                    <div class="input-field col s12 m6 right" style="margin-top: -0.1%;">
                        <img id="matricula_image" class="materialboxed imagensparafoto" src="{{asset('/img/unset_image_matricula.png')}}">
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m3">
                        Sexo (obrigatório):
                        <p>
                            <label>
                                <input value="M" name="sexo" type="radio" @if(old('sexo') == 'M') checked @endif/>
                                <span>Masculino</span>
                            </label>
                        </p>
                        <p>
                            <label>
                                <input value="F" name="sexo" type="radio" @if(old('sexo') == 'F') checked @endif/>
                                <span>Feminino</span>
                            </label>
                        </p>
                    </div>
                    <div class="input-field col s12 m3">
                        Mora com os pais?
                        <p>
                            <label>
                                <input value="1" name="mora_com_os_pais" type="radio" @if(old('mora_com_os_pais') == '1') checked @endif/>
                                <span>Sim</span>
                            </label>
                        </p>
                        <p>
                            <label>
                                <input value="2" name="mora_com_os_pais" type="radio" @if(old('mora_com_os_pais') == '2') checked @endif/>
                                <span>Não</span>
                            </label>
                        </p>
                    </div>
                    <div class="input-field col s12 m3">
                        Estado Civil:
                        <p>
                            <label>
                                <input value="Solteiro" name="estado_civil" type="radio" @if(old('estado_civil') == 'Solteiro') checked @endif/>
                                <span>Solteiro</span>
                            </label>
                        </p>
                        <p>
                            <label>
                                <input value="Casado" name="estado_civil" type="radio" @if(old('estado_civil') == 'Casado') checked @endif/>
                                <span>Casado</span>
                            </label>
                        </p>
                        <p>
                            <label>
                                <input value="Viuva(o)" name="estado_civil" type="radio" @if(old('estado_civil') == 'Viuva(o)') checked @endif/>
                                <span>Viuva(o)</span>
                            </label>
                        </p>
                    </div>
                </div>
                <br><br>
                <h5>Registro da anamnese:</h5>
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
                        Toma algum medicamento? (obrigatório)
                        <p>
                            <label>
                                <input onclick="toma_medicacao_click('S')" value="1" name="toma_medicacao" type="radio" @if(old('toma_medicacao') == 1) checked @endif/>
                                <span>Sim</span>
                            </label>
                            &emsp;&emsp;
                            <label>
                                <input onclick="toma_medicacao_click('N')" value="2" name="toma_medicacao" type="radio" @if(old('toma_medicacao') == 2) checked @endif/>
                                <span>Não</span>
                            </label>
                        </p>
                    </div>
                    <div class="input-field col s12 m6">
                        <i id="toma_medicacao_icon" class="material-icons prefix" @if(old('toma_medicacao') != 1) hidden @endif>description</i>
                        <input id="string_toma_medicacao" name="string_toma_medicacao" type="text" class="validate" value="{{old('string_toma_medicacao')}}" @if(old('toma_medicacao') != 1) hidden @endif maxlength="50">
                        <label id="toma_medicacao_label" for="string_toma_medicacao" @if(old('toma_medicacao') != 1) hidden @endif>Qual medicamento?</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m4">
                        Possui alergia médica? (obrigatório)
                        <p>
                            <label>
                                <input onclick="alergia_medicacao_click('S')" value="1" name="alergia_medicacao" type="radio" @if(old('alergia_medicacao') == 1) checked @endif/>
                                <span>Sim</span>
                            </label>
                            &emsp;&emsp;
                            <label>
                                <input onclick="alergia_medicacao_click('N')" value="2" name="alergia_medicacao" type="radio" @if(old('alergia_medicacao') == 2) checked @endif/>
                                <span>Não</span>
                            </label>
                        </p>
                    </div>
                    <div class="input-field col s12 m6">
                        <i id="alergia_medicacao_icon" class="material-icons prefix" @if(old('alergia_medicacao') != 1) hidden @endif>description</i>
                        <input id="string_alergia_medicacao" name="string_alergia_medicacao" type="text" class="validate" value="{{old('string_alergia_medicacao')}}" @if(old('alergia_medicacao') != 1) hidden @endif maxlength="50">
                        <label id="alergia_medicacao_label" for="string_alergia_medicacao" @if(old('alergia_medicacao') != 1) hidden @endif>Qual alergia médica?</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m4">
                        O usuário já fez cirurgia? (obrigatório)
                        <p>
                            <label>
                                <input onclick="cirurgia_click('S')" value="1" name="cirurgia" type="radio" @if(old('cirurgia') == 1) checked @endif/>
                                <span>Sim</span>
                            </label>
                            &emsp;&emsp;
                            <label>
                                <input onclick="cirurgia_click('N')" value="2" name="cirurgia" type="radio" @if(old('cirurgia') == 2) checked @endif/>
                                <span>Não</span>
                            </label>
                        </p>
                    </div>
                    <div class="input-field col s12 m6">
                        <i id="cirurgia_icon" class="material-icons prefix" @if(old('cirurgia') != 1) hidden @endif>description</i>
                        <input id="string_cirurgia" name="string_cirurgia" type="text" class="validate" value="{{old('string_cirurgia')}}" @if(old('cirurgia') != 1) hidden @endif maxlength="50">
                        <label id="cirurgia_label" for="string_cirurgia" @if(old('cirurgia') != 1) hidden @endif>Em que região foi a cirurgia?</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m4">
                        Possui dores ósseas? (obrigatório)
                        <p>
                            <label>
                                <input onclick="dor_ossea_click('S')" value="1" name="dor_ossea" type="radio" @if(old('dor_ossea') == 1) checked @endif/>
                                <span>Sim</span>
                            </label>
                            &emsp;&emsp;
                            <label>
                                <input onclick="dor_ossea_click('N')" value="2" name="dor_ossea" type="radio" @if(old('dor_ossea') == 2) checked @endif/>
                                <span>Não</span>
                            </label>
                        </p>
                    </div>
                    <div class="input-field col s12 m6">
                        <i id="dor_ossea_icon" class="material-icons prefix" @if(old('dor_ossea') != 1) hidden @endif>description</i>
                        <input id="string_dor_ossea" name="string_dor_ossea" type="text" class="validate" value="{{old('string_dor_ossea')}}" @if(old('dor_ossea') != 1) hidden @endif maxlength="50">
                        <label id="dor_ossea_label" for="string_dor_ossea" @if(old('dor_ossea') != 1) hidden @endif>Onde está a dor óssea?</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m4">
                        Possui dores musculares? (obrigatório)
                        <p>
                            <label>
                                <input onclick="dor_muscular_click('S')" value="1" name="dor_muscular" type="radio" @if(old('dor_muscular') == 1) checked @endif/>
                                <span>Sim</span>
                            </label>
                            &emsp;&emsp;
                            <label>
                                <input onclick="dor_muscular_click('N')" value="2" name="dor_muscular" type="radio" @if(old('dor_muscular') == 2) checked @endif/>
                                <span>Não</span>
                            </label>
                        </p>
                    </div>
                    <div class="input-field col s12 m6">
                        <i id="dor_muscular_icon" class="material-icons prefix" @if(old('dor_muscular') != 1) hidden @endif>description</i>
                        <input id="string_dor_muscular" name="string_dor_muscular" type="text" class="validate" value="{{old('string_dor_muscular')}}" @if(old('dor_muscular') != 1) hidden @endif maxlength="50">
                        <label id="dor_muscular_label" for="string_dor_muscular" @if(old('dor_muscular') != 1) hidden @endif>Onde está a dor muscular?</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m4">
                        Possui dores articulares? (obrigatório)
                        <p>
                            <label>
                                <input onclick="dor_articular_click('S')" value="1" name="dor_articular" type="radio" @if(old('dor_articular') == 1) checked @endif/>
                                <span>Sim</span>
                            </label>
                            &emsp;&emsp;
                            <label>
                                <input onclick="dor_articular_click('N')" value="2" name="dor_articular" type="radio" @if(old('dor_articular') == 2) checked @endif/>
                                <span>Não</span>
                            </label>
                        </p>
                    </div>
                    <div class="input-field col s12 m6">
                        <i id="dor_articular_icon" class="material-icons prefix" @if(old('dor_articular') != 1) hidden @endif>description</i>
                        <input id="string_dor_articular" name="string_dor_articular" type="text" class="validate" value="{{old('string_dor_articular')}}" @if(old('dor_articular') != 1) hidden @endif maxlength="50">
                        <label id="dor_articular_label" for="string_dor_articular" @if(old('dor_articular') != 1) hidden @endif>Onde está a dor articular?</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m4">
                        O usuário fuma? (obrigatório)
                        <p>
                            <label>
                                <input onclick="fumante_click('S')" value="1" name="fumante" type="radio" @if(old('fumante') == 1) checked @endif/>
                                <span>Sim</span>
                            </label>
                            &emsp;&emsp;
                            <label>
                                <input onclick="fumante_click('N')" value="2" name="fumante" type="radio" @if(old('fumante') == 2) checked @endif/>
                                <span>Não</span>
                            </label>
                        </p>
                    </div>
                    <div class="input-field col s12 m6">
                        <i id="fumante_icon" class="material-icons prefix" @if(old('fumante') != 1) hidden @endif>description</i>
                        <input id="string_fumante" name="string_fumante" type="text" class="validate" value="{{old('string_fumante')}}" @if(old('fumante') != 1) hidden @endif maxlength="50">
                        <label id="fumante_label" for="string_fumante" @if(old('fumante') != 1) hidden @endif>Fuma há quanto tempo?</label>
                    </div>
                </div>
                <div class="row">
                    <input type="text" name="old_doencas" id="old_doencas" value="{{old('old_doencas')}}" hidden>
                    @php $old_ids_doencas = explode(',', old('old_doencas')) @endphp
                    <div class="input-field col s12 m5">
                        Possui doenças?
                        <select multiple name="doencas[]" id="lista_de_pessoas" onchange="old_doencas_function()">
                            @foreach ($doencaslist as $doenca)
                                <option value="{{$doenca->id}}" @foreach ($old_ids_doencas as $old_doenca) @if($doenca->id == $old_doenca) selected @endif @endforeach>{{$doenca->nome}}</option>
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
                            <p>Atestado médico (.img | .png | .jpg) (obrigatório):</p>
                            <div class="btn blue">
                                <span>Abrir arquivo</span>
                                <input id="img_atestado" type="file" name="img_atestado" required>
                            </div>
                            <a id="limpar_atestado"  class="waves-effect waves-light btn blue" style="margin-left: 5%;">Limpar</a>
                            <br><br><br>
                            <div class="file-path-wrapper">
                                <input id="atestado" name="atestado" class="file-path validate" type="text">
                            </div>
                        </div>
                    </div>
                    <div class="input-field col s12 m6 right" style="margin-top: -0.1%;">
                        <img id="atestado_image" class="materialboxed imagensparafoto" src="{{asset('/img/unset_image_atestado.png')}}">
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m5">
                        <textarea name="observacao" id="observacao" class="materialize-textarea" maxlength="100">{{old('observacao')}}</textarea>
                        <label for="observacao">Observação</label>
                    </div>
                    <div class="container">
                        <div class="input-field col s12 m3 right">
                            <button id="criar_pessoa" class="btn-floating btn-large waves-effect waves-light light-blue darken-1" type="submit" name="action">
                                <i class="large material-icons left">add</i>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div id="adicionardoenca" class="modal" style="width: 33%; height: 52%;">
        <div class="col s1.5 right">
            <a class="modal-close"><i class="material-icons medium" style="color: red;">cancel</i></a>
        </div>
        <br><br>
        <div class="container">
            <div class="row">
                <div class="input-field col s12 m5">
                    <h5>Criar Doença</h5>
                </div>
            </div>
            <form id="ajax_doenca">
                @csrf
                <div class="modal-content">
                    <div class="row">
                        <div class="input-field col s12 m12">
                            <i class="material-icons prefix">new_releases</i>
                            <input id="nome_doenca" type="text" class="validate">
                            <label for="nome_doenca">Nome da doença:</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s10 m10">
                            <i class="material-icons prefix">description</i>
                            <textarea id="descricao_doenca" class="materialize-textarea" maxlength="100"></textarea>
                            <label for="descricao_doenca">Observação</label>
                        </div>
                        <div class="input-field col s2 m2 right">
                            <a class="btn-floating btn-large" id="botao_doenca"><i class="material-icons">add</i></a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div id="fotomodal" class="modal">
        <div class="center">
            <br>
            <video id='video' class="grey lighten-1 center" style='border: solid 10px; black; width: 393px; height:300px;'></video>
            <div class='container'>
                <hr>
            </div>
            <br>
            <a id="capture" class="modal-close waves-effect waves-light btn-large modal-trigger blue" href="#!">Tirar foto&emsp;&nbsp; <i class="material-icons">contacts</i></a>
        </div>
        <br>
    </div>
@endsection