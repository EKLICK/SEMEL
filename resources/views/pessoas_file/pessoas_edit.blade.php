@extends('layouts.app')

@section('css.personalizado')@endsection
@section('breadcrumbs')
    <a href="{{route('home')}}" class="breadcrumb">Pessoas</a>
    <a href="{{Route('pessoas.edit', $pessoa->id)}}" class="breadcrumb">Editar</a>
@endsection
@section('title') Editar {{$pessoa->nome}} @endsection
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
                <form class="col s12" action="{{route('pessoas.update', $pessoa->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <input type="text" id="cidade" name="cidade" value="São Leopoldo" hidden/>
                    <div class="row">
                        <div class="input-field col s3">
                            <div class="file-field input-field">
                                <div class="file-field input-field">
                                    <div class="btn">
                                        <span>Foto 3x4</span>
                                        <input type="file" name="img_3x4">
                                    </div>
                                    <div class="file-path-wrapper">
                                        <input name="img_3x4" class="file-path validate" type="text" value="{{$pessoa->foto}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="input-field col s3">
                            <i class="material-icons prefix">account_circle</i>
                            <input name="nome" id="nome" type="text" class="validate" value="@if(is_null(old('nome'))) {{$pessoa->nome}} @else {{old('nome')}} @endif">
                            <label for="nome">Nome:</label>
                        </div>
                        <div class="input-field col s3">
                                <i class="material-icons prefix">child_friendly</i>
                            <input name="nascimento" id="nascimento" type="text" class="validate" value="@if(is_null(old('nascimento'))) {{$pessoa->nascimento}} @else {{old('nascimento')}} @endif">
                            <label for="nascimento">Data de nascimento:</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s3">
                                <i class="material-icons prefix">assignment_ind</i>
                            <input name="rg" id="rg" type="text" class="validate" value="@if(is_null(old('rg'))) {{$pessoa->rg}} @else {{old('rg')}} @endif">
                            <label for="rg">RG:</label>
                        </div>
                        <div class="input-field col s3">
                            <i class="material-icons prefix">credit_card</i>
                            <input onkeydown="javascript: fMasc(this, mCPF)" name="cpf" id="cpf" type="text" class="validate" value="@if(is_null(old('cpf'))) {{$pessoa->cpf}} @else {{old('cpf')}} @endif">
                            <label for="cpf">CPF próprio:</label>
                        </div>
                        <div class="input-field col s3">
                            <i class="material-icons prefix">credit_card</i>
                            <input onkeydown="javascript: fMasc(this, mCPF)" name="cpf_responsavel" id="cpf_responsavel" type="text" class="validate" value="@if(is_null(old('cpf_responsavel'))) {{$pessoa->cpf_responsavel}} @else {{old('cpf_responsavel')}} @endif">
                            <label for="cpf_responsavel">CPF opcional:</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s3">
                            <i class="material-icons prefix">location_city</i>
                            <input name="bairro" id="bairro" type="text" class="validate" value="@if(is_null(old('bairro'))) {{$pessoa->bairro}} @else {{old('bairro')}} @endif">
                            <label for="bairro">Bairro:</label>
                        </div>
                        <div class="input-field col s3">
                            <i class="material-icons prefix">confirmation_number</i>
                            <input name="rua" id="rua" type="text" class="validate"  value="@if(is_null(old('rua'))) {{$pessoa->rua}} @else {{old('rua')}} @endif">
                            <label for="rua">Rua:</label>
                        </div>
                        <div class="input-field col s2">
                            <i class="material-icons prefix">location_on</i>
                            <input onkeydown="javascript: fMasc(this, mNum)" name="numero_endereco" id="numero_endereco" type="number" class="validate" @if(is_null(old('numero_endereco'))) value="{{$pessoa->numero_endereco}}" @else value="{{old('numero_endereco')}}" @endif>
                            <label for="numero_endereco">Número:</label>
                        </div>
                        <div class="input-field col s3">
                            <i class="material-icons prefix">markunread_mailbox</i>
                            <input onkeydown="javascript: fMasc(this, mCEP)" name="cep" id="cep" type="text" class="validate" value="@if(is_null(old('cep'))) {{$pessoa->cep}} @else {{old('cep')}} @endif">
                            <label for="cep">CEP:</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s3">
                            <i class="material-icons prefix">phone</i>
                            <input onkeydown="javascript: fMasc(this, mTel)" name="telefone" id="icon_telephone" type="tel" class="validate" value="@if(is_null(old('telefone'))) {{$pessoa->telefone}} @else {{old('telefone')}} @endif">
                            <label for="icon_telephone">Telephone:</label>
                        </div>
                        <div class="input-field col s4">
                            <i class="material-icons prefix">contact_phone</i>
                            <input onkeydown="javascript: fMasc(this, mTel)" name="telefone_emergencia" id="icon_telephone" type="tel" class="validate" value="@if(is_null(old('telefone_emergencia'))) {{$pessoa->telefone_emergencia}} @else {{old('telefone_emergencia')}} @endif">
                            <label for="icon_telephone">Telephone de emergência:</label>
                        </div>
                        <div class="input-field col s3">
                            <i class="material-icons prefix">add_box</i>
                            <input name="convenio_medico" id="convenio_medico" type="text" class="validate" value="@if(is_null(old('convenio_medico'))) {{$pessoa->convenio_medico}} @else {{old('convenio_medico')}} @endif">
                            <label for="convenio_medico">Convênio médico:</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s3">
                            <i class="material-icons prefix">person</i>
                            <input name="nome_do_pai" id="nome_do_pai" type="text" class="validate" value="@if(is_null(old('nome_do_pai'))) {{$pessoa->nome_do_pai}} @else {{old('nome_do_pai')}} @endif">
                            <label for="nome_do_pai">Nome do pai:</label>
                        </div>
                        <div class="input-field col s3">
                            <i class="material-icons prefix">person_outline</i>
                            <input name="nome_da_mae" id="nome_da_mae" type="text" class="validate" value="@if(is_null(old('nome_da_mae'))) {{$pessoa->nome_da_mae}} @else {{old('nome_da_mae')}} @endif">
                            <label for="nome_da_mae">Nome da mãe:</label>
                        </div>
                        <div class="input-field col s4">
                            <i class="material-icons prefix">person_add</i>
                            <input name="pessoa_emergencia" id="pessoa_emergencia" type="text" class="validate" value="@if(is_null(old('pessoa_emergencia'))) {{$pessoa->pessoa_emergencia}} @else {{old('pessoa_emergencia')}} @endif">
                            <label for="pessoa_emergencia">Pessoa para emergência:</label>
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
                        <div class="input-field col s5">
                            <div class="file-field input-field">
                                <div class="file-field input-field">
                                    <div class="btn">
                                        <span>Matricula escolar</span>
                                        <input type="file" name="img_matricula">
                                    </div>
                                    <div class="file-path-wrapper">
                                        <input name="img_matricula" class="file-path validate" type="text" value="{{$pessoa->matricula}}">
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
                                        <input value="M" name="sexo" type="radio" @if(is_null(old('sexo'))) @if(old('sexo') == 'M') checked @endif @else @if ($pessoa->sexo == 'M') checked @endif @endif/>
                                        <span>Masculino</span>
                                    </label>
                                </p>
                                <p>
                                    <label>
                                        <input value="F" name="sexo" type="radio" @if(is_null(old('sexo'))) @if(old('sexo') == 'F') checked @endif @else @if ($pessoa->sexo == 'F') checked @endif @endif/>
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
                                        <input value="Solteiro" name="estado_civil" type="radio" @if(is_null(old('estado_civil'))) @if(old('estado_civil') == 'Solteiro') checked @endif @else @if ($pessoa->estado_civil == 'Solteiro') checked @endif @endif/>
                                        <span>Solteiro</span>
                                    </label>
                                </p>
                                <p>
                                    <label>
                                        <input value="Casado" name="estado_civil" type="radio" @if(is_null(old('estado_civil'))) @if(old('estado_civil') == 'Casado') checked @endif @else @if ($pessoa->estado_civil == 'Casado') checked @endif @endif/>
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
                                        <input value="1" name="mora_com_os_pais" type="radio" @if(is_null(old('mora_com_os_pais'))) @if(old('mora_com_os_pais') == '1') checked @endif @else @if ($pessoa->mora_com_os_pais == 1) checked @endif @endif/>
                                        <span>Sim</span>
                                    </label>
                                </p>
                                <p>
                                    <label>
                                        <input value="2" name="mora_com_os_pais" type="radio" @if(is_null(old('mora_com_os_pais'))) @if(old('mora_com_os_pais') == '2') checked @endif @else @if ($pessoa->mora_com_os_pais == 2) checked @endif @endif/>
                                        <span>Não</span>
                                    </label>
                                </p>
                            </label>
                        </div>
                    </div>
                    <br><br><br>
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