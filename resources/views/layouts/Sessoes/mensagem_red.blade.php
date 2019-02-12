@if(Session::get('mensagem_red'))
    <div class="center-align sessao">
        <div class="chip red lighten-2">
            {{Session::get('mensagem_red')}}
            <i class="close material-icons">close</i>
        </div>
    </div>
    {{Session::forget('mensagem_red')}}
@endif