@if(Session::get('mensagem_yellow'))
    <div class="center-align sessao">
        <div class="chip yellow darken-2">
            {{Session::get('mensagem_yellow')}}
            <i class="close material-icons">close</i>
        </div>
    </div>
    {{Session::forget('mensagem_yellow')}}
@endif