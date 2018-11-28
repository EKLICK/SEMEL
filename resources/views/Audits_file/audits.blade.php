@extends('layouts.app')

@section('content')
    <div class="section">
        <div class="container">
            <h4>Auditorias</h4>
            <div class="divider"></div>
        </div>
        
        <div class="container z-depth-4">
            <div class="card-panel">
                <table class="centered">
                    <thead>
                        <tr>
                            <th>User Type</th>
                            <th>User id</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($auditslist as $audit)
                            <tr>
                                <td><p>{{$audit->user_type}}</p></td>
                                <td><p>{{$audit->user_id}}</p></td>
                            </tr>
                        @endforeach 
                    </tbody>
                </table>
                {{$auditslist->links()}}
            </div>
        </div>
    </div>
@endsection