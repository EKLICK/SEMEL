@extends('layouts.app')
@section('breadcrumbs')
    <a href="{{route('home')}}" class="breadcrumb">Home</a>
    <a href="{{route('pessoas.index')}}" class="breadcrumb">Pessoas</a>
    <a href="{{Route('pessoas.edit', $pessoa->id)}}" class="breadcrumb">Editar</a>
@endsection
@section('title') Editar <?php $nomes = explode(' ',$pessoa->nome);?> {{$nomes[0]}} @endsection
@section('content')
    @include('layouts.Sessoes.errors')
    <div class="container">
        <div class="row">
            <form class="col s12" action="{{route('pessoas.update', $pessoa->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <input type="text" id="id" name="id" value="{{$pessoa->id}}" hidden/>
                <h5>Registro da pessoa:</h5>
                <a id="muda_foto" onclick="muda_foto('{{asset('/img/unset_image_3x4.png')}}')" class="waves-effect waves-light btn-large blue" href="#!">Trocar para pastas&emsp;&nbsp; <i class="material-icons">satellite</i></a>
                <div id="image_file" class="row" style="display: none">
                    <div class="file-field input-field col s12 m5">
                        <br><br>
                        <p>Foto 3 por 4 (.img | .png | .jpg):</p>
                        <div class="btn blue">
                            <span>Abrir arquivo</span>
                            <input id="img_3x4" type="file" name="img_3x4" value="@if(is_null(old('img_3x4'))) {{$pessoa->foto}} @else {{old('img_3x4')}} @endif">
                        </div>
                        <a id="limpar_3x4" class="waves-effect waves-light btn blue" style="margin-left: 5%;">Limpar</a>
                        <br><br><br>
                        <div class="file-path-wrapper container left">
                            <input id="3x4" class="file-path validate" type="text" value="{{$pessoa->foto}}">
                        </div>
                    </div>
                    <div class="input-field col s12 m7 right" style="margin-top: -2%;">
                        <img id="3x4_image" class="materialboxed imagensparafoto" src="@if(!is_null($pessoa->foto)) {{asset($pessoa->foto)}} @else {{asset('/img/unset_image_3x4.png')}} @endif">
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
                        <img id="img_web" class="materialboxed imagensparafoto" src="@if(!is_null($pessoa->foto)) {{asset($pessoa->foto)}} @else {{asset('/img/unset_image_3x4.png')}} @endif">
                        <input id="web_image" type="text" name="foto_web" id="base64" hidden>
                        <canvas id="canvas_foto" width="400" height="300" hidden></canvas>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m5">
                        <i class="material-icons prefix">account_circle</i>
                        <input name="nome" id="nome" type="text" class="validate" value="@if(is_null(old('nome'))) {{$pessoa->nome}} @else {{old('nome')}} @endif" maxlength="30" required>
                        <label for="nome">Nome:  <span style="color: red;">*</span></label>
                    </div>
                    <div class="input-field col s12 m5">
                        <i class="material-icons prefix">child_friendly</i>
                        <input id="nascimento" type="text" class="datepicker validate" name="nascimento" value="@if(is_null(old('nascimento'))) {{$pessoa->nascimento}} @else {{old('nascimento')}} @endif" maxlength="10" required>
                        <label for="nascimento">Data de nascimento:  <span style="color: red;">*</span></label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m5">
                        <i class="material-icons prefix">credit_card</i>
                        <input onkeydown="javascript: fMasc(this, mCPF)" name="cpf" id="cpf" type="text" class="validate" value="@if(is_null(old('cpf'))) {{$pessoa->cpf}} @else {{old('cpf')}} @endif" maxlength="14">
                        <label for="cpf">CPF próprio:</label>
                    </div>
                    <div class="input-field col s12 m5">
                        <i class="material-icons prefix">credit_card</i>
                        <input onkeydown="javascript: fMasc(this, mCPF)" name="cpf_responsavel" id="cpf_responsavel" type="text" class="validate" value="@if(is_null(old('cpf_responsavel'))) {{$pessoa->cpf_responsavel}} @else {{old('cpf_responsavel')}} @endif" maxlength="14">
                        <label for="cpf_responsavel">CPF do responsavel:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m5">
                        <i class="material-icons prefix">assignment_ind</i>
                        <input name="rg" id="rg" type="text" class="validate" value="@if(is_null(old('rg'))) {{$pessoa->rg}} @else {{old('rg')}} @endif" maxlength="13">
                        <label for="rg">RG:</label>
                    </div>
                    <div class="input-field col s12 m5">
                        <i class="material-icons prefix">assignment_ind</i>
                        <input name="rg_responsavel" id="rg_responsavel" type="text" class="validate" value="@if(is_null(old('rg_responsavel'))) {{$pessoa->rg_responsavel}} @else {{old('rg_responsavel')}} @endif" maxlength="13">
                        <label for="rg_responsavel">RG do responsavel:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m5">
                        <i class="material-icons prefix">business</i>
                        <input name="cidade" id="cidade" type="text" class="validate" value="@if(is_null(old('cidade'))) {{$pessoa->cidade}} @else {{old('cidade')}} @endif" maxlength="30">
                        <label for="cidade">Cidade:</label>
                    </div>
                    <div class="input-field col s12 m5">
                        <a class="btn-floating right light-blue darken-1" style="margin-top: -10%;" onclick="change_bairro()"><i class="material-icons">cached</i></a>
                        <div id="div_bairro_list" @if($pessoa->bairro != null || !is_null(old('string_bairro'))) hidden @endif>
                            <i class="material-icons prefix">location_city</i>&emsp;&emsp;&emsp;Bairros
                            <select name="bairro" onchange="change_bairro_select()" id="bairro_select">
                                <option value="" selected disabled>Selecione o bairro</option>
                                @foreach ($bairroslist as $bairro)
                                    <option value="{{$bairro}}" @if(old('string_bairro') == $bairro) selected @endif>{{$bairro}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div id="div_bairro_string" @if(is_null(old('string_bairro')) && $pessoa->bairro == null) hidden @endif>
                            <i class="material-icons prefix">location_city</i>
                            <input id="string_bairro" name="string_bairro" type="text" class="validate" value="@if(is_null(old('string_bairro'))) {{$pessoa->bairro}} @else {{old('string_bairro')}} @endif" maxlength="15">
                            <label for="string_bairro">Bairro:</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m5">
                        <i class="material-icons prefix">confirmation_number</i>
                        <input name="rua" id="rua" type="text" class="validate"  value="@if(is_null(old('rua'))) {{$pessoa->rua}} @else {{old('rua')}} @endif" maxlength="15">
                        <label for="rua">Rua:</label>
                    </div>
                    <div class="input-field col s12 m5">
                        <i class="material-icons prefix">explore</i>
                        <input onkeydown="javascript: fMasc(this, mCEP)" name="cep" id="cep" type="text" class="validate" value="@if(is_null(old('cep'))) {{$pessoa->cep}} @else {{old('cep')}} @endif" maxlength="10">
                        <label for="cep">CEP:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m5">
                        <i class="material-icons prefix">location_on</i>
                        <input onkeydown="javascript: fMasc(this, mNum)" name="numero_endereco" id="numero_endereco" type="number" class="validate" @if(is_null(old('numero_endereco'))) value="{{$pessoa->numero_endereco}}" @else value="{{old('numero_endereco')}}" @endif maxlength="5">
                        <label for="numero_endereco">Número:</label>
                    </div>
                    <div class="input-field col s12 m5">
                        <i class="material-icons prefix">bookmark</i>
                        <input name="complemento" id="complemento" type="text" class="validate" @if(is_null(old('complemento'))) value="{{$pessoa->complemento}}" @else value="{{old('complemento')}}" @endif maxlength="10">
                        <label for="complemento">Complemento de endereço:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m5">
                        <i class="material-icons prefix">phone</i>
                        <input onkeydown="javascript: fMasc(this, mTel)" name="telefone" id="icon_telephone" type="tel" class="validate" value="@if(is_null(old('telefone'))) {{$pessoa->telefone}} @else {{old('telefone')}} @endif" maxlength="16">
                        <label for="icon_telephone">Telefone:</label>
                    </div>
                    <div class="input-field col s12 m5">
                        <i class="material-icons prefix">contact_phone</i>
                        <input onkeydown="javascript: fMasc(this, mTel)" name="telefone_emergencia" id="icon_telephone" type="tel" class="validate" value="@if(is_null(old('telefone_emergencia'))) {{$pessoa->telefone_emergencia}} @else {{old('telefone_emergencia')}} @endif" maxlength="16">
                        <label for="icon_telephone">Telefone de emergência:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m3">
                        <i class="material-icons prefix">person</i>
                        <input name="nome_do_pai" id="nome_do_pai" type="text" class="validate" value="@if(is_null(old('nome_do_pai'))) {{$pessoa->nome_do_pai}} @else {{old('nome_do_pai')}} @endif" maxlength="100">
                        <label for="nome_do_pai">Nome do pai:</label>
                    </div>
                    <div class="input-field col s12 m3">
                        <i class="material-icons prefix">person_outline</i>
                        <input name="nome_da_mae" id="nome_da_mae" type="text" class="validate" value="@if(is_null(old('nome_da_mae'))) {{$pessoa->nome_da_mae}} @else {{old('nome_da_mae')}} @endif" maxlength="100">
                        <label for="nome_da_mae">Nome da mãe:</label>
                    </div>
                    <div class="input-field col s4">
                        <i class="material-icons prefix">person_add</i>
                        <input name="pessoa_emergencia" id="pessoa_emergencia" type="text" class="validate" value="@if(is_null(old('nome_da_mae'))) {{$pessoa->pessoa_emergencia}} @else {{old('pessoa_emergencia')}} @endif" maxlength="100">
                        <label for="pessoa_emergencia">Pessoa emergência:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s2">
                        <i class="material-icons prefix">child_care</i>
                        <input name="filhos" id="filhos" type="number" class="validate" @if(is_null(old('filhos'))) value="{{$pessoa->filhos}}" @else value="{{old('filhos')}}" @endif>
                        <label for="filhos">Filhos:</label>
                    </div>
                    <div class="input-field col s2">
                        <i class="material-icons prefix">people</i>
                        <input name="irmaos" id="irmaos" type="number" class="validate" @if(is_null(old('irmaos'))) value="{{$pessoa->irmaos}}" @else value="{{old('irmaos')}}" @endif>
                        <label for="irmaos">Irmãos:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m4">
                        Possui convênio médico?
                        <p>
                            <label>
                                <input onclick="convenio_medico_click('S')" value="1" name="convenio_medico" type="radio" @if(!is_null(old('convenio_medico'))) @if(old('convenio_medico') == 1) checked @endif @else @if ($pessoa->convenio_medico != -1) checked @endif @endif/>
                                <span>Sim</span>
                            </label>
                        </p>
                        <p>
                            <label>
                                <input onclick="convenio_medico_click('N')" value="2" name="convenio_medico" type="radio" @if(!is_null(old('convenio_medico'))) @if(old('convenio_medico') == 2) checked @endif @else @if ($pessoa->convenio_medico == -1) checked @endif @endif/>
                                <span>Não</span>
                            </label>
                        </p>
                    </div>
                    <div class="input-field col s12 m6">
                        <i id="convenio_icon" class="material-icons prefix" @if(!is_null(old('convenio_medico'))) @if(old('convenio_medico') != 1) hidden @endif @else @if ($pessoa->convenio_medico == -1) hidden @endif @endif>add_box</i>
                        <input id="string_convenio_medico" name="string_convenio_medico" type="text" class="validate" value="@if(is_null(old('convenio_medico'))) @if($pessoa->convenio_medico != -1) {{$pessoa->convenio_medico}} @endif @else {{old('string_convenio_medico')}} @endif" @if(!is_null(old('convenio_medico'))) @if(old('toma_medicacao') == 2) hidden @endif @else @if($pessoa->convenio_medico == -1) hidden @endif @endif>
                        <label id="convenio_label" for="string_convenio_medico" @if(!is_null(old('convenio_medico'))) @if(old('convenio_medico') != 1) hidden @endif @else @if($pessoa->convenio_medico == -1) hidden @endif @endif>Convênio médico:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m5">
                        <div class="file-field input-field">
                            <div class="btn">
                                <span>matricula escolar</span>
                                <input id="img_matricula" type="file" name="img_matricula" value="@if(is_null(old('img_matricula'))) {{$pessoa->matricula}} @else {{old('img_matricula')}} @endif">
                            </div>
                            <a id="limpar_matricula" class="waves-effect waves-light btn" style="margin-left: 5%;">Limpar</a>
                            <br><br><br>
                            <div class="file-path-wrapper">
                                <input id="matricula" name="matricula" class="file-path validate" type="text" value="@if(is_null(old('matricula'))) {{$pessoa->matricula}} @else {{old('matricula')}} @endif">
                            </div>
                        </div>
                    </div>
                    <div class="input-field col s12 m6 right" style="margin-top: -0.1%;">
                        <img id="matricula_image" class="materialboxed imagensparafoto" src="@if(!is_null($pessoa->matricula)) {{asset($pessoa->matricula)}} @else {{asset('/img/unset_image_matricula.png')}} @endif">
                    </div>
                </div>             
                <div class="row">
                    <div class="input-field col s12 m3">
                        Sexo: <span style="color: red;">*</span>
                        <p>
                            <label>
                                <input value="M" name="sexo" type="radio" @if(old('sexo') == 'M') checked @else @if ($pessoa->sexo == 'M') checked @endif @endif />
                                <span>Masculino</span>
                            </label>
                        </p>
                        <p>
                            <label>
                                <input value="F" name="sexo" type="radio"  @if(old('sexo') == 'F') checked @else @if ($pessoa->sexo == 'F') checked @endif @endif />
                                <span>Feminino</span>
                            </label>
                        </p>
                    </div>
                    <div class="input-field col s12 m3">
                        Mora com os pais?
                        <p>
                            <label>
                                <input value="1" name="mora_com_os_pais" type="radio" @if(old('mora_com_os_pais') == '1') checked @else @if ($pessoa->mora_com_os_pais == 1) checked @endif @endif/>
                                <span>Sim</span>
                            </label>
                        </p>
                        <p>
                            <label>
                                <input value="2" name="mora_com_os_pais" type="radio" @if(old('mora_com_os_pais') == '2') checked @else @if ($pessoa->mora_com_os_pais == 2) checked @endif @endif/>
                                <span>Não</span>
                            </label>
                        </p>
                    </div>
                    <div class="input-field col s12 m3">
                        Estado Civil:
                        <p>
                            <label>
                                <input value="Solteiro" name="estado_civil" type="radio" @if(old('estado_civil') == 'Solteiro') checked @else @if ($pessoa->estado_civil == 'Solteiro') checked @endif @endif/>
                                <span>Solteiro(a)</span>
                            </label>
                        </p>
                        <p>
                            <label>
                                <input value="Casado" name="estado_civil" type="radio" @if(old('estado_civil') == 'Casado') checked @else @if ($pessoa->estado_civil == 'Casado') checked @endif @endif/>
                                <span>Casado(a)</span>
                            </label>
                        </p>
                        <p>
                            <label>
                                <input value="Viuva(o)" name="estado_civil" type="radio" @if(old('estado_civil') == 'Viuva(o)') checked @else @if ($pessoa->estado_civil == 'Viuva(o)') checked @endif @endif/>
                                <span>Viuvo(a)</span>
                            </label>
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m4">
                        A pessoa faleceu?
                        <p>
                            <label>
                                <input onclick="morte_click('S')" value="1" name="morte" type="radio" @if(!is_null(old('morte'))) @if(old('morte') == 1) checked @endif @else @if ($pessoa->morte != -1) checked @endif @endif/>
                                <span>Sim</span>
                            </label>
                        </p>
                        <p>
                            <label>
                                <input onclick="morte_click('N')" value="2" name="morte" type="radio" @if(!is_null(old('morte'))) @if(old('morte') == 2) checked @endif @else @if ($pessoa->morte == -1) checked @endif @endif/>
                                <span>Não</span>
                            </label>
                        </p>
                    </div>
                    <div class="input-field col s12 m6">
                        <i id="morte_icon" class="material-icons prefix" @if(!is_null(old('morte'))) @if(old('morte') != 1) hidden @endif @else @if ($pessoa->morte == -1) hidden @endif @endif>event_busy</i>
                        <input id="string_morte" name="string_morte" type="text" class="validate" value="@if(is_null(old('morte'))) @if($pessoa->morte != -1) {{$pessoa->morte}} @endif @else {{old('string_morte')}} @endif" @if(!is_null(old('morte'))) @if(old('morte') == 2) hidden @endif @else @if($pessoa->morte == -1) hidden @endif @endif>
                        <label id="morte_label" for="string_morte" @if(!is_null(old('morte'))) @if(old('morte') != 1) hidden @endif @else @if($pessoa->morte == -1) hidden @endif @endif>Motivo do falecimento:</label>
                    </div>
                </div>
                <div class="row">
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