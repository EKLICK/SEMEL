@extends('layouts.app')

@section('css.personalizado')@endsection
@section('breadcrumbs')
    <a href="{{route('home')}}" class="breadcrumb">Pessoas</a>
    <a href="{{route('pessoas.create')}}" class="breadcrumb">Criar</a>
@endsection
@section('title') Criar pessoa @endsection
@section('content')
    <div class="container" style="margin-top: 3%;">
        <div class="card">
            <div class="row">
                <form class="col s12" action="{{route('pessoas.store')}}" method="post">
                    @csrf
                    <input type="text" id="cidade" name="cidade" value="São Leopoldo" hidden/>
                    <h5>Registro da pessoa:</h5>
                    <input type="number" name="escolha" value="1" hidden>
                    <div class="row">
                        <div class="input-field col s4">
                            <div class="file-field input-field">
                                <div class="file-field input-field">
                                    <div class="btn">
                                        <span>Foto 3x4</span>
                                        <input type="file" name="img_profissao">
                                    </div>
                                    <div class="file-path-wrapper">
                                        <input class="file-path validate" type="text">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="input-field col s3">
                            <i class="material-icons prefix">account_circle</i>
                            <input name="nome" id="nome" type="text" class="validate">
                            <label for="nome">Nome:</label>
                        </div>
                        <div class="input-field col s3">
                                <i class="material-icons prefix">child_friendly</i>
                            <input name="nascimento" id="nascimento" type="text" class="validate">
                            <label for="nascimento">Data de nascimento:</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s3">
                                <i class="material-icons prefix">assignment_ind</i>
                            <input name="rg" id="rg" type="text" class="validate">
                            <label for="rg">RG:</label>
                        </div>
                        <div class="input-field col s4">
                            <i class="material-icons prefix">credit_card</i>
                            <input name="cpf" id="cpf" type="text" class="validate">
                            <label for="cpf">CPF (do menor ou responsavel):</label>
                        </div>
                        <div class="input-field col s3">
                            <i class="material-icons prefix">location_on</i>
                            <input name="endereco" id="endereco" type="text" class="validate">
                            <label for="endereco">Endereço:</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s4">
                            <i class="material-icons prefix">location_city</i>
                            <input name="bairro" id="bairro" type="text" class="validate">
                            <label for="bairro">Bairro:</label>
                        </div>
                        <div class="input-field col s3">
                            <i class="material-icons prefix">markunread_mailbox</i>
                            <input name="cep" id="cep" type="text" class="validate">
                            <label for="cep">CEP:</label>
                        </div>
                        <div class="input-field col s3">
                            <i class="material-icons prefix">phone</i>
                            <input name="telefone" id="icon_telephone" type="tel" class="validate">
                            <label for="icon_telephone">Telephone:</label>
                        </div>
                        <div class="input-field col s4">
                            <i class="material-icons prefix">contact_phone</i>
                            <input name="telefone_emergencia" id="icon_telephone_emergencia" type="tel" class="validate">
                            <label for="icon_telephone_emergencia">Telephone de emergência:</label>
                        </div>
                        <div class="input-field col s3">
                            <i class="material-icons prefix">add_box</i>
                            <input name="convenio_medico" id="convenio_medico" type="text" class="validate">
                            <label for="convenio_medico">Convênio médico:</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s3">
                            <i class="material-icons prefix">person</i>
                            <input name="nome_do_pai" id="nome_da_pai" type="text" class="validate">
                            <label for="nome_da_pai">Nome do pai:</label>
                        </div>
                        <div class="input-field col s3">
                            <i class="material-icons prefix">person_outline</i>
                            <input name="nome_da_mae" id="nome_da_mae" type="text" class="validate">
                            <label for="nome_da_mae">Nome do mãe:</label>
                        </div>
                        <div class="input-field col s4">
                            <i class="material-icons prefix">person_add</i>
                            <input name="pessoa_emergencia" id="pessoa_emergencia" type="text" class="validate">
                            <label for="pessoa_emergencia">Pessoa para emergência:</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s2">
                            <i class="material-icons prefix">child_care</i>
                            <input name="filhos" id="filhos" type="number" class="validate" value="0">
                            <label for="filhos">Filhos:</label>
                        </div>
                        <div class="input-field col s2">
                            <i class="material-icons prefix">people</i>
                            <input name="irmaos" id="irmaos" type="number" class="validate" value="0">
                            <label for="irmaos">Irmãos:</label>
                        </div>
                        <div class="input-field col s6">
                            <div class="file-field input-field">
                                <div class="file-field input-field">
                                    <div class="btn">
                                        <span>Matricula escolar</span>
                                        <input type="file" name="img_profissao">
                                    </div>
                                    <div class="file-path-wrapper">
                                        <input class="file-path validate" type="text">
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
                                        <input value="M" name="sexo" type="radio"/>
                                        <span>Masculino</span>
                                    </label>
                                </p>
                                <p>
                                    <label>
                                        <input value="F" name="sexo" type="radio"/>
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
                                        <input value="Solteiro" name="estado_civil" type="radio"/>
                                        <span>Solteiro</span>
                                    </label>
                                </p>
                                <p>
                                    <label>
                                        <input value="Casado" name="estado_civil" type="radio"/>
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
                                        <input value="1" name="mora_com_os_pais" type="radio"/>
                                        <span>Sim</span>
                                    </label>
                                </p>
                                <p>
                                    <label>
                                        <input value="2" name="mora_com_os_pais" type="radio"/>
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
                            <input name="peso" id="icon_prefix" type="number" step="0.01" class="validate">
                            <label for="icon_prefix">Peso:</label>
                        </div>
                        <div class="input-field col s3">
                            <i class="material-icons prefix">format_color_text</i>
                            <input name="altura" id="icon_altura" type="number" step="0.01" class="validate">
                            <label for="icon_altura">Altura:</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s3">
                            Toma algum medicamento?
                            <label>
                                <p>
                                    <label>
                                        <input value="1" name="toma_medicacao" type="radio"/>
                                        <span>Sim</span>
                                    </label>
                                </p>
                                <p>
                                    <label>
                                        <input value="0" name="toma_medicacao" type="radio"/>
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
                                        <input value="1" name="alergia_medicacao" type="radio"/>
                                        <span>Sim</span>
                                    </label>
                                </p>
                                <p>
                                    <label>
                                        <input value="0" name="alergia_medicacao" type="radio"/>
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
                                        <input value="1" name="fumante" type="radio"/>
                                        <span>Sim</span>
                                    </label>
                                </p>
                                <p>
                                    <label>
                                        <input value="0" name="fumante" type="radio"/>
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
                                        <input value="1" name="cirurgia" type="radio"/>
                                        <span>Sim</span>
                                    </label>
                                </p>
                                <p>
                                    <label>
                                        <input value="0" name="cirurgia" type="radio"/>
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
                                        <input value="1" name="dor_ossea" type="radio"/>
                                        <span>Sim</span>
                                    </label>
                                </p>
                                <p>
                                    <label>
                                        <input value="0" name="dor_ossea" type="radio"/>
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
                                        <input value="1" name="dor_muscular" type="radio"/>
                                        <span>Sim</span>
                                    </label>
                                </p>
                                <p>
                                    <label>
                                        <input value="0" name="dor_muscular" type="radio"/>
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
                                        <input value="1" name="dor_articular" type="radio"/>
                                        <span>Sim</span>
                                    </label>
                                </p>
                                <p>
                                    <label>
                                        <input value="0" name="dor_articular" type="radio"/>
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
                            <textarea name="observacao" id="observacao" class="materialize-textarea"></textarea>
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