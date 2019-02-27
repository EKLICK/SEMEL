@if(isset(auth()->user()->id))
    @if(auth()->user()->id == 1)
        <li>
            <div class="collapsible-header"><i class="material-icons">settings</i>Administração</div>
            <div class="collapsible-body">
                <div class="collection">
                    <b><a class="collection-item" href="{{route('users.index')}}" style="color: #039be5;"><i class="material-icons">folder</i> Registros</a></b>
                    <b><a class="collection-item" href="{{route('register')}}" style="color: #039be5;"><i class="material-icons">loupe</i> Cadastrar</a></b>
                    <b><a class="collection-item" href="{{route('audits.index')}}" style="color: #039be5;"><i class="material-icons">access_time</i> Auditorias</a></b>
                </div>
            </div>
        </li>
    @endif
@endif
<li>
    <div class="collapsible-header"><i class="material-icons">local_library</i>Professores</div>
    <div class="collapsible-body">
        <div class="collection">
            <b><a class="collection-item" href="{{route('professor.index')}}" style="color: #039be5;"><i class="material-icons">folder</i> Registros</a></b>
            <b><a class="collection-item" href="{{route('professor.create')}}"style="color: #039be5;"><i class="material-icons">loupe</i> Cadastrar</a></b>
        </div>
    </div>
</li>
<li>
    <div class="collapsible-header"><i class="material-icons">people</i>Usuarios</div>
    <div class="collapsible-body">
        <div class="collection">
            <b><a class="collection-item" href="{{route('pessoas.index')}}"style="color: #039be5;"><i class="material-icons">folder</i> Registros</a></b>
            <b><a class="collection-item" href="{{route('pessoas.create')}}" style="color: #039be5;"><i class="material-icons">loupe</i> Cadastrar</a></b>
        </div>
    </div>
</li>
<li>
    <div class="collapsible-header"><i class="material-icons">add_box</i>Anamneses</div>
    <div class="collapsible-body">
        <div class="collection">
            <b><a class="collection-item" href="{{route('anamneses.index')}}" style="color: #039be5;"><i class="material-icons">folder</i> Registros</a></b>
        </div>
    </div>
</li>
<li>
    <div class="collapsible-header"><i class="material-icons">warning</i>Doenças</div>
    <div class="collapsible-body">
        <div class="collection">
            <b><a class="collection-item" href="{{route('doencas.index')}}" style="color: #039be5;"><i class="material-icons">folder</i> Registros</a></b>
            <b><a class="collection-item" href="{{route('doencas.create')}}" style="color: #039be5;"><i class="material-icons">loupe</i> Cadastrar</a></b>
        </div>
    </div>
</li>
@if(isset(auth()->user()->id))
    @if(auth()->user()->id == 1)
        <li>
            <div class="collapsible-header"><i class="material-icons">art_track</i>Turmas</div>
            <div class="collapsible-body">
                <div class="collection">
                    <b><a class="collection-item" href="{{route('turmas.index')}}" style="color: #039be5;"><i class="material-icons">folder</i> Registros</a></b>
                    <b><a class="collection-item" href="{{route('doencas.create')}}" style="color: #039be5;"><i class="material-icons">loupe</i> Cadastrar</a></b>
                </div>
            </div>
        </li>
        <li>
            <div class="collapsible-header"><i class="material-icons">filter_tilt_shift</i>Núcleos</div>
            <div class="collapsible-body">
                <div class="collection">
                    <b><a class="collection-item" href="{{route('nucleos.index')}}" style="color: #039be5;"><i class="material-icons">folder</i> Registros</a></b>
                    <b><a class="collection-item" href="{{route('doencas.create')}}" style="color: #039be5;"><i class="material-icons">loupe</i> Cadastrar</a></b>
                </div>
            </div>
        </li>
    @else
        <div class="collection">
            <b><a class="collection-item" href="{{route('turmas.index')}}" style="color: #039be5;">Turmas</a></b>
            <b><a class="collection-item" href="{{route('nucleos.index')}}" style="color: #039be5;">Nucleos</a></b>
        </div>
    @endif
@endif