@extends('layouts.app')
@section('css.personalizado')@endsection
@section('breadcrumbs')
    <a href="{{route('pessoas.index')}}" class="breadcrumb">Pessoas</a>
    <a href="{{route('pessoas.create')}}" class="breadcrumb">Criar pessoa/anamnese</a>
@endsection
@section('title') <h4>Criar anamneses de {{$cadastropessoa->nome}}</h4> @endsection
@section('content')
    <div class="container" style="margin-top: 3%;">
        <div class="card">
            <div class="row">
                <form class="col s12" action="{{route('anamneses.store')}}" method="post">
                    @csrf
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
                            Possui atestado?
                            <label>
                                <p>
                                    <label>
                                        <input value="1" name="atestado" type="radio"/>
                                        <span>Sim</span>
                                    </label>
                                </p>
                                <p>
                                    <label>
                                        <input value="0" name="atestado" type="radio"/>
                                        <span>Não</span>
                                    </label>
                                </p>
                            </label>
                        </div>
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
                            <select multiple>
                                @foreach ($doencaslist as $doenca)
                                    <option value="{{$doenca->id}}" name="doencas[]">{{$doenca->nome}}</option>
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
                    <button style="margin-bottom: 2%;" class="btn waves-effect waves-light" type="submit" name="action">Enviar
                        <i class="material-icons right">send</i>
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection