@extends('layouts.app')

    @section('css.personalizado')
    @endsection

    @section('content')

    <div class="container" style="margin-top: 3%;">
        <div class="card">
            <div class="row">
                <form class="col s12" action="{{route('pessoas.store')}}" method="post">
                    @csrf
                    <input type="text" id="cidade" name="cidade" value="São Leopoldo" hidden/>
                    <div class="row">
                        <div class="input-field col s4">
                            <i class="material-icons prefix">account_circle</i>
                            <input name="nome" id="nome" type="text" class="validate">
                            <label for="nome">Nome:</label>
                        </div>
                        <div class="input-field col s3">
                                <i class="material-icons prefix">child_friendly</i>
                            <input name="nascimento" id="nascimento" type="text" class="validate">
                            <label for="nascimento">Data de nascimento:</label>
                        </div>
                        <div class="input-field col s2">
                                <i class="material-icons prefix">assignment_ind</i>
                            <input name="rg" id="rg" type="text" class="validate">
                            <label for="rg">RG:</label>
                        </div>
                        <div class="input-field col s2">
                            <i class="material-icons prefix">credit_card</i>
                            <input name="cpf" id="cpf" type="text" class="validate">
                            <label for="cpf">CPF:</label>
                        </div>
                        <div class="input-field col s4">
                            <i class="material-icons prefix">location_on</i>
                            <input name="endereco" id="endereco" type="text" class="validate">
                            <label for="endereco">Endereço:</label>
                        </div>
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
                        <div class="input-field col s3">
                            <i class="material-icons prefix">contact_phone</i>
                            <input name="telefone_emergencia" id="icon_telephone" type="tel" class="validate">
                            <label for="icon_telephone">Telephone de emergência:</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s4">
                            <i class="material-icons prefix">person</i>
                            <input name="nome_do_pai" id="nome_da_pai" type="text" class="validate">
                            <label for="nome_da_pai">Nome do pai:</label>
                        </div>
                        <div class="input-field col s4">
                            <i class="material-icons prefix">person_outline</i>
                            <input name="nome_do_mae" id="nome_da_mae" type="text" class="validate">
                            <label for="nome_da_mae">Nome do mãe:</label>
                        </div>
                        <div class="input-field col s4">
                            <i class="material-icons prefix">person_add</i>
                            <input name="pessoa_emergencia" id="pessoa_emergencia" type="text" class="validate">
                            <label for="pessoa_emergencia">Pessoa para emergência:</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s4">
                            <i class="material-icons prefix">add_box</i>
                            <input name="convenio_medico" id="convenio_medico" type="text" class="validate">
                            <label for="convenio_medico">Convênio médico:</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s2 left">
                            <i class="material-icons prefix">child_care</i>
                            <input name="filhos" id="filhos" type="number" class="validate">
                            <label for="filhos">Filhos:</label>
                        </div>
                        <div class="input-field col s2">
                            <i class="material-icons prefix">people</i>
                            <input name="irmaos" id="irmaos" type="number" class="validate">
                            <label for="irmaos">Irmãos:</label>
                        </div>
                        <div class="input-field col s2 right">
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
                        <div class="input-field col s2 right">
                            Estado Civil:
                            <label>
                                <p>
                                    <label>
                                        <input value="solteiro" name="estado_civil" type="radio"/>
                                        <span>Solteiro</span>
                                    </label>
                                </p>
                                <p>
                                    <label>
                                        <input value="casado" name="estado_civil" type="radio"/>
                                        <span>Casado</span>
                                    </label>
                                </p>
                            </label>
                        </div>
                        <div class="input-field col s2 right">
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
                        <div class="input-field col s2 right">
                            Inativo?
                            <label>
                                <p>
                                    <label>
                                        <input value="1" name="inativo" type="radio"/>
                                        <span>Sim</span>
                                    </label>
                                </p>
                                <p>
                                    <label>
                                        <input value="0" name="inativo" type="radio"/>
                                        <span>Não</span>
                                    </label>
                                </p>
                            </label>
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

<!--
    <div class="input-field col s2">
        Sexo:
        <label>
            <p>
                <label>
                    <input name="sexo" type="radio"/>
                    <span>Masculino</span>
                </label>
            </p>
            <p>
                <label>
                    <input name="sexo" type="radio"/>
                    <span>Feminino</span>
                </label>
            </p>
        </label>
    </div>
-->