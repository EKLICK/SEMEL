<li>
    <div class="collapsible-header"><i class="material-icons">settings</i>Ferramentas de administração</div>
    <div class="collapsible-body">
        <div class="collection">
            <b><a class="collection-item" href="{{route('register')}}" style="color: #039be5;">Cadastrar administrador</a></b>
            <b><a class="collection-item" href="{{route('professor.create')}}" style="color: #039be5;">Cadastrar professor</a></b>
            <b><a class="collection-item" href="{{route('audits.index')}}" style="color: #039be5;">Auditorias</a></b>
        </div>
    </div>
</li>
<li>
    <div class="collapsible-header"><i class="material-icons">people</i>Usuarios</div>
    <div class="collapsible-body">
        <div class="collection">
            <b><a class="collection-item" href="{{route('professor.index')}}" style="color: #039be5;">Professores</a></b>
            <b><a class="collection-item" href="{{route('pessoas.index')}}"style="color: #039be5;">Cliente</a></b>
        </div>
    </div>
</li>
<li>
    <div class="collapsible-header"><i class="material-icons">assignment</i>Anamneses</div>
    <div class="collapsible-body">
        <div class="collection">
            <b><a class="collection-item" href="{{route('anamneses.index')}}" style="color: #039be5;">Anamneses de {{date('Y')}}</a></b>
            <b><a class="collection-item" href="{{route('anamneses.index2')}}" style="color: #039be5;">Anamneses Históricas</a></b>
        </div>
    </div>
</li>
<div class="collection">
    <b><a class="collection-item" href="{{route('doencas.index')}}" style="color: #039be5;">Doenças</a></b>
    <b><a class="collection-item" href="{{route('turmas.index')}}" style="color: #039be5;">Turmas</a></b>
    <b><a class="collection-item" href="{{route('nucleos.index')}}" style="color: #039be5;">Nucleos</a></b>
</div>