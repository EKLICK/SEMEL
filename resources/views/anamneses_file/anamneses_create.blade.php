@extends('layouts.app')

@section('css.personalizado')@endsection
@section('breadcrumbs')
    <a href="{{route('home')}}" class="breadcrumb">Pessoas</a>
    <a href="{{route('lista_anamnese', $pessoa->id)}}" class="breadcrumb">Anamneses</a>
    <a href="{{route('pessoas.create')}}" class="breadcrumb">Criar Anamneses</a>
@endsection
@section('title') Anamneses de <?php $nomes = explode(' ',$pessoa->nome);?> {{$nomes[0]}} @endsection
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
    <div class="container edicao-criacao">
        <div class="row">
            <form class="col s12" action="{{route('anamneses.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="text" name="pessoas_id" value="{{$pessoa->id}}" hidden>
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
                    <div class="input-field col s4">
                        Toma algum medicamento?
                        <label>
                            <p>
                                <label>
                                    <input value="1" name="toma_medicacao" type="radio" @if(old('toma_medicacao') == 1) checked @endif/>
                                    <span>Sim</span>
                                </label>
                            </p>
                            <p>
                                <label>
                                    <input value="2" name="toma_medicacao" type="radio" @if(old('toma_medicacao') == 2) checked @endif/>
                                    <span>Não</span>
                                </label>
                            </p>
                        </label>
                    </div>
                    <div class="input-field col s4">
                        Possui alergia médica?
                        <label>
                            <p>
                                <label>
                                    <input value="1" name="alergia_medicacao" type="radio" @if(old('alergia_medicacao') == 1) checked @endif/>
                                    <span>Sim</span>
                                </label>
                            </p>
                            <p>
                                <label>
                                    <input value="2" name="alergia_medicacao" type="radio" @if(old('alergia_medicacao') == 2) checked @endif/>
                                    <span>Não</span>
                                </label>
                            </p>
                        </label>
                    </div>
                    <div class="input-field col s4">
                        O usuário fuma?
                        <label>
                            <p>
                                <label>
                                    <input value="1" name="fumante" type="radio" @if(old('fumante') == 1) checked @endif/>
                                    <span>Sim</span>
                                </label>
                            </p>
                            <p>
                                <label>
                                    <input value="2" name="fumante" type="radio" @if(old('fumante') == 2) checked @endif/>
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
                                    <input value="1" name="cirurgia" type="radio" @if(old('cirurgia') == 1) checked @endif/>
                                    <span>Sim</span>
                                </label>
                            </p>
                            <p>
                                <label>
                                    <input value="2" name="cirurgia" type="radio" @if(old('cirurgia') == 2) checked @endif/>
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
                                    <input value="1" name="dor_ossea" type="radio" @if(old('dor_ossea') == 1) checked @endif/>
                                    <span>Sim</span>
                                </label>
                            </p>
                            <p>
                                <label>
                                    <input value="2" name="dor_ossea" type="radio" @if(old('dor_ossea') == 2) checked @endif/>
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
                                    <input value="1" name="dor_muscular" type="radio" @if(old('dor_muscular') == 1) checked @endif/>
                                    <span>Sim</span>
                                </label>
                            </p>
                            <p>
                                <label>
                                    <input value="2" name="dor_muscular" type="radio" @if(old('dor_muscular') == 2) checked @endif/>
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
                                    <input value="1" name="dor_articular" type="radio" @if(old('dor_articular') == 1) checked @endif/>
                                    <span>Sim</span>
                                </label>
                            </p>
                            <p>
                                <label>
                                    <input value="2" name="dor_articular" type="radio" @if(old('dor_articular') == 2) checked @endif/>
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
                        <input type="text" value="2" name="possui_doenca" hidden>
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
@endsection