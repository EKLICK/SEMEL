<li>
    <div class="collapsible-header"><i class="material-icons">settings</i>Ferramentas de administração</div>
    <div class="collapsible-body">
        <div class="collection">
            <b><a class="collection-item" href="{{route('register')}}">Cadastrar administrador</a></b>
            <b><a class="collection-item" href="{{route('professor.create')}}">Cadastrar professor</a></b>
            <b><a class="collection-item" href="{{route('audits.index')}}">Auditorias</a></b>
        </div>
    </div>
</li>
<li>
    <div class="collapsible-header"><i class="material-icons">people</i>Usuarios</div>
    <div class="collapsible-body">
        <div class="collection">
            <b><a class="collection-item" href="{{route('professor.index')}}">Professores</a></b>
            <b><a class="collection-item" href="{{route('pessoas.index')}}">Cliente</a></b>
        </div>
    </div>
</li>
<li>
    <div class="collapsible-header"><i class="material-icons">assignment</i>Anamneses</div>
    <div class="collapsible-body">
        <div class="collection">
            <b><a class="collection-item" href="{{route('anamneses.index')}}">Anamneses de {{date('Y')}}</a></b>
            <b><a class="collection-item" href="{{route('anamneses.index2')}}">Anamneses Históricas</a></b>
        </div>
    </div>
</li>
<div class="collection">
    <b><a class="collection-item" href="{{route('doencas.index')}}">Doenças</a></b>
    <b><a class="collection-item" href="{{route('turmas.index')}}">Turmas</a></b>
    <b><a class="collection-item" href="{{route('nucleos.index')}}">Nucleos</a></b>
</div>