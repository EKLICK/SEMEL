@extends('layouts.app')

@section('css.personalizado')@endsection
@section('breadcrumbs')
    <a href="{{route('home')}}" class="breadcrumb">Pessoas</a>
    <a href="{{route('pessoas.create')}}" class="breadcrumb">Criar</a>
@endsection
@section('title') Criar pessoa @endsection
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
    <div class="container" style="margin-top: 3%;">
        <div class="card">
            <div class="row">
                <form class="col s12" action="{{route('pessoas.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="text" id="cidade" name="cidade" value="São Leopoldo" hidden/>
                    <input type="text" name="atestado" value="0" hidden>
                    <h5>Registro da pessoa:</h5>
                    <div class="row">
                        <div class="input-field col s2">
                            <img id="3x4_image" class="materialboxed" width="150" src="{{asset('img/img_3x4.png')}}">
                        </div>
                        <div class="input-field col s4">
                            <div class="file-field input-field" style="margin-left: 10%;">
                                <div class="file-field input-field">
                                    <div class="btn">
                                        <span>Foto 3x4</span>
                                        <input type="file" name="img_3x4">
                                    </div>
                                    <br><br><br>
                                    <div class="file-path-wrapper">
                                        <input class="file-path validate" type="text">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="input-field col s4">
                            <i class="material-icons prefix">account_circle</i>
                            <input name="nome" id="nome" type="text" class="validate" value="{{old('nome')}}">
                            <label for="nome">Nome:</label>
                        </div>
                        <div class="input-field col s3">
                            <i class="material-icons prefix">child_friendly</i>
                            <input id="nascimento" type="text" class="datepicker validate" name="nascimento" value="{{old('nascimento')}}">
                            <label for="nascimento">Data de nascimento:</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s3">
                            <i class="material-icons prefix">assignment_ind</i>
                            <input name="rg" id="rg" type="text" class="validate" value="{{old('rg')}}">
                            <label for="rg">RG:</label>
                        </div>
                        <div class="input-field col s3">
                            <i class="material-icons prefix">credit_card</i>
                            <input onkeydown="javascript: fMasc(this, mCPF)" name="cpf" id="cpf" type="text" class="validate" value="{{old('cpf')}}">
                            <label for="cpf">CPF próprio:</label>
                        </div>
                        <div class="input-field col s3">
                            <i class="material-icons prefix">credit_card</i>
                            <input onkeydown="javascript: fMasc(this, mCPF)" name="cpf_responsavel" id="cpf_responsavel" type="text" class="validate" value="{{old('cpf_responsavel')}}">
                            <label for="cpf_responsavel">CPF opcional:</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s3">
                            <i class="material-icons prefix">location_city</i>
                            <input name="bairro" id="bairro" type="text" class="validate" value="{{old('bairro')}}">
                            <label for="bairro">Bairro:</label>
                        </div>
                        <div class="input-field col s3">
                            <i class="material-icons prefix">confirmation_number</i>
                            <input name="rua" id="rua" type="text" class="validate" value="{{old('rua')}}">
                            <label for="rua">Rua:</label>
                        </div>
                        <div class="input-field col s2">
                            <i class="material-icons prefix">location_on</i>
                            <input onkeydown="javascript: fMasc(this, mNum)" name="numero_endereco" id="numero_endereco" type="number" class="validate" value="{{old('numero_endereco')}}">
                            <label for="numero_endereco">Número:</label>
                        </div>
                        <div class="input-field col s3">
                            <i class="material-icons prefix">markunread_mailbox</i>
                            <input onkeydown="javascript: fMasc(this, mCEP)" name="cep" id="cep" type="text" class="validate" value="{{old('cep')}}">
                            <label for="cep">CEP:</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s3">
                            <i class="material-icons prefix">phone</i>
                            <input onkeydown="javascript: fMasc(this, mTel)" name="telefone" id="icon_telephone" type="tel" class="validate" value="{{old('telefone')}}">
                            <label for="icon_telephone">Telephone:</label>
                        </div>
                        <div class="input-field col s4">
                            <i class="material-icons prefix">contact_phone</i>
                            <input onkeydown="javascript: fMasc(this, mTel)" name="telefone_emergencia" id="icon_telephone_emergencia" type="tel" class="validate" value="{{old('telefone_emergencia')}}">
                            <label for="icon_telephone_emergencia">Telephone emergência:</label>
                        </div>
                        <div class="input-field col s3">
                            <i class="material-icons prefix">add_box</i>
                            <input name="convenio_medico" id="convenio_medico" type="text" class="validate" value="{{old('convenio_medico')}}">
                            <label for="convenio_medico">Convênio médico:</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s3">
                            <i class="material-icons prefix">person</i>
                            <input name="nome_do_pai" id="nome_do_pai" type="text" class="validate" value="{{old('nome_do_pai')}}">
                            <label for="nome_do_pai">Nome do pai:</label>
                        </div>
                        <div class="input-field col s3">
                            <i class="material-icons prefix">person_outline</i>
                            <input name="nome_da_mae" id="nome_da_mae" type="text" class="validate" value="{{old('nome_da_mae')}}">
                            <label for="nome_da_mae">Nome do mãe:</label>
                        </div>
                        <div class="input-field col s3">
                            <i class="material-icons prefix">person_add</i>
                            <input name="pessoa_emergencia" id="pessoa_emergencia" type="text" class="validate" value="{{old('pessoa_emergencia')}}">
                            <label for="pessoa_emergencia">Pessoa emergência:</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s2">
                            <i class="material-icons prefix">child_care</i>
                            <input name="filhos" id="filhos" type="number" class="validate" value="0" value="{{old('filhos')}}">
                            <label for="filhos">Filhos:</label>
                        </div>
                        <div class="input-field col s2">
                            <i class="material-icons prefix">people</i>
                            <input name="irmaos" id="irmaos" type="number" class="validate" value="0" value="{{old('irmaos')}}">
                            <label for="irmaos">Irmãos:</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s2">
                            <div class="input-field col s2">
                                <img id="matricula_image" class="materialboxed" width="150" src="{{asset('img/img_3x4.png')}}">
                            </div>
                        </div>
                        <div class="input-field col s4">
                            <div class="file-field input-field">
                                <div class="file-field input-field" style="margin-left: 10%;">
                                    <div class="file-field input-field">
                                        <div class="btn">
                                            <span>matricula escolar</span>
                                            <input type="file" name="img_matricula">
                                        </div>
                                        <br><br><br>
                                        <div class="file-path-wrapper">
                                            <input class="file-path validate" type="text">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s3">
                            Sexo:
                            <label>
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
                            </label>
                        </div>
                        <div class="input-field col s3">
                            Estado Civil:
                            <label>
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
                            </label>
                        </div>
                        <div class="input-field col s3">
                            Mora com os pais?
                            <label>
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
                            </label>
                        </div>
                    </div>
                    <br>
                    <br>
                    <br>
                    <br>
                    <h5>Registro da anamnese:</h5>
                    <div class="row">
                        <div class="input-field col s3">
                            <i class="material-icons prefix">local_parking</i>
                            <input name="peso" id="icon_prefix" type="number" step="0.01" class="validate" value="{{old('peso')}}">
                            <label for="icon_prefix">Peso:</label>
                        </div>
                        <div class="input-field col s3">
                            <i class="material-icons prefix">format_color_text</i>
                            <input name="altura" id="icon_altura" type="number" step="0.01" class="validate" value="{{old('altura')}}">
                            <label for="icon_altura">Altura:</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s3">
                            Toma algum medicamento?
                            <label>
                                <p>
                                    <label>
                                        <input value="1" name="toma_medicacao" type="radio" @if(old('toma_medicacao') == '1') checked @endif/>
                                        <span>Sim</span>
                                    </label>
                                </p>
                                <p>
                                    <label>
                                        <input value="2" name="toma_medicacao" type="radio" @if(old('toma_medicacao') == '2') checked @endif/>
                                        <span>Não</span>
                                    </label>
                                </p>
                            </label>
                        </div>
                        <div class="input-field col s3 ">
                            Possui alergia médica?
                            <label>
                                <p>
                                    <label>
                                        <input value="1" name="alergia_medicacao" type="radio" @if(old('alergia_medicacao') == '1') checked @endif/>
                                        <span>Sim</span>
                                    </label>
                                </p>
                                <p>
                                    <label>
                                        <input value="2" name="alergia_medicacao" type="radio" @if(old('alergia_medicacao') == '2') checked @endif/>
                                        <span>Não</span>
                                    </label>
                                </p>
                            </label>
                        </div>
                        <div class="input-field col s2 left">
                            O usuário fuma?
                            <label>
                                <p>
                                    <label>
                                        <input value="1" name="fumante" type="radio" @if(old('fumante') == '1') checked @endif/>
                                        <span>Sim</span>
                                    </label>
                                </p>
                                <p>
                                    <label>
                                        <input value="2" name="fumante" type="radio" @if(old('fumante') == '2') checked @endif/>
                                        <span>Não</span>
                                    </label>
                                </p>
                            </label>
                        </div>
                    </div>
                    <br><br><br>
                    <div class="row">
                        <div class="input-field col s3 left">
                            O usuário já fez cirurgia?
                            <br>
                            <label>
                                <p>
                                    <label>
                                        <input value="1" name="cirurgia" type="radio" @if(old('cirurgia') == '1') checked @endif/>
                                        <span>Sim</span>
                                    </label>
                                </p>
                                <p>
                                    <label>
                                        <input value="2" name="cirurgia" type="radio" @if(old('cirurgia') == '2') checked @endif/>
                                        <span>Não</span>
                                    </label>
                                </p>
                            </label>
                        </div>
                        <div class="input-field col s3">
                            Possui dores ósseas?
                            <label>
                                <p>
                                    <label>
                                        <input value="1" name="dor_ossea" type="radio" @if(old('dor_ossea') == '1') checked @endif/>
                                        <span>Sim</span>
                                    </label>
                                </p>
                                <p>
                                    <label>
                                        <input value="2" name="dor_ossea" type="radio" @if(old('dor_ossea') == '2') checked @endif/>
                                        <span>Não</span>
                                    </label>
                                </p>
                            </label>
                        </div>
                        <div class="input-field col s3 left">
                            Possui dores musculares?
                            <label>
                                <p>
                                    <label>
                                        <input value="1" name="dor_muscular" type="radio" @if(old('dor_muscular') == '1') checked @endif/>
                                        <span>Sim</span>
                                    </label>
                                </p>
                                <p>
                                    <label>
                                        <input value="2" name="dor_muscular" type="radio" @if(old('dor_muscular') == '2') checked @endif/>
                                        <span>Não</span>
                                    </label>
                                </p>
                            </label>
                        </div>
                        <div class="input-field col s3">
                            Possui dores articulares?
                            <label>
                                <p>
                                    <label>
                                        <input value="1" name="dor_articular" type="radio" @if(old('dor_articular') == '1') checked @endif/>
                                        <span>Sim</span>
                                    </label>
                                </p>
                                <p>
                                    <label>
                                        <input value="2" name="dor_articular" type="radio" @if(old('dor_articular') == '2') checked @endif/>
                                        <span>Não</span>
                                    </label>
                                </p>
                            </label>
                        </div>
                    </div>
                    <br><br><br>
                    <div class="row">
                        <div class="input-field col s3">
                            Possui doenças?
                            <select multiple name="doencas[]">
                                @foreach ($doencaslist as $doenca)
                                    <option value="{{$doenca->id}}">{{$doenca->nome}}</option>
                                @endforeach
                            </select>
                            <input type="text" value="0" name="possui_doenca" hidden>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s8">
                            <textarea name="observacao" id="observacao" class="materialize-textarea">{{old('observacao')}}</textarea>
                            <label for="observacao">Observação</label>
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="row">
                        <div class="input-field col s3">
                            <button class="btn waves-effect waves-light" type="submit" name="action">Enviar
                                <i class="material-icons right">send</i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection