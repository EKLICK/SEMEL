@extends('layouts.app')

    @section('css.personalizado')
    @endsection

    @section('content')

    <div class="container" style="margin-top: 3%;">
        <div class="card">
            <div class="row">
                <form class="col s12" action="{{route('anamneses.store')}}" method="post">
                    @csrf
                    <div class="row">
                        <input type="text" name="ano" id="ano" value="{{date('Y')}}" hidden>
                        <input type="number" name="pessoas_id" id="pessoas_id" value="{{$pessoa['id']}}" hidden>
                        <h4>Nome do Usuário: {{$pessoa['nome']}}</h4>
                        <div class="input-field col s3">
                            <i class="material-icons prefix">local_parking</i>
                            <input name="peso" id="icon_prefix" type="number" step="0.01" class="validate">
                            <label for="icon_prefix">Peso:</label>
                        </div>
                        <div class="input-field col s3">
                            <i class="material-icons prefix">format_color_text</i>
                            <input name="altura" id="icon_altura" type="number" step="0.01" class="validate">
                            <label for="icon_matricula">Altura:</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s2 left">
                            Possui alguma doença?
                            <label>
                                <p>
                                    <label>
                                        <input value="1" name="possui_doenca" type="radio"/>
                                        <span>Sim</span>
                                    </label>
                                </p>
                                <p>
                                    <label>
                                        <input value="0" name="possui_doenca" type="radio"/>
                                        <span>Não</span>
                                    </label>
                                </p>
                            </label>
                        </div>
                        <div class="input-field col s3 left">
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
                        <div class="input-field col s2 left">
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
                        <div class="input-field col s2 left">
                            O usuário já fez cirurgia?
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
                    </div>
                    <br><br><br>
                    <div class="row">
                        <div class="input-field col s2 left">
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
                        <div class="input-field col s2 left">
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
                        <div class="input-field col s2 left">
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
                        <div class="input-field col s3 left">
                            Se sim, quais?
                            <label>
                                <p>
                                    <label>
                                        @foreach ($doencaslist as $doenca)
                                        <input type="checkbox" />
                                        <span>{{$doenca->nome}}</span>
                                        <br>
                                        @endforeach
                                    </label>
                                </p>
                            </label>
                        </div>
                    </div>
                    <br><br><br>
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