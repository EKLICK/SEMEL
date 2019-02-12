@if(Session::get('mensagem_green'))
    <div class="center-align sessao">
        <div class="chip green lighten-2">
            {{Session::get('mensagem_green')}}
            <i class="close material-icons">close</i> 
        </div>
    </div>
    {{Session::forget('mensagem_green')}}
@endif