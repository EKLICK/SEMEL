@extends('layouts.app')

@section('content')
    <div class="section">
        <div class="container">
            <h4>Turmas</h4>
            <div class="divider"></div>
        </div>
        
        <div class="container z-depth-4">
            <div class="card-panel">
                <table class="centered">
                    <thead>
                        <tr>
                            <th>Nome da turma</th>
                            <th>limite</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($nucleo->turmas as $turma)
                            <tr>
                                <td><p>{{$turma->nome}}</p><i class="small material-icons" @if(count($turma->pessoas) >= $turma->limite) style="color: yellow;" @else style="color: green;" @endif>sim_card_alert</i></td>
                                <td><p>{{count($turma->pessoas)}} / {{$turma->limite}}</p></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection