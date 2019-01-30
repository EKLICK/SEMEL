<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>SEMEL</title>
        {!! MaterializeCSS::include_full() !!}
        <link rel="stylesheet" href="{{asset('css/style.css')}}">
    </head>
    <body>
        <header>
            <div class="navbar-fixed">
                <nav class="#039be5 light-blue darken-1">
                    <div class="container nav-wrapper">
                        <a href="{{route('home')}}" class="brand-logo center"><b>SEMEL</b></a>
                        <div class="col 12">
                            @guest
                                <ul id="nav-mobile" class="right hide-on-med-and-down">
                                    <li><a href="{{route('login')}}"><i class="material-icons"></i><b>Login</b></a></li>
                                </ul>
                            @else
                                <ul id="nav-mobile" class="right hide-on-med-and-down"> 
                                    <li>
                                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><b>{{ __('Logout') }}</b></a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                                    </li>
                                </ul>
                            @endguest
                        </div>
                    </div>
                </nav>
            </div>
            @guest
                <main>
                    @yield('content')
                </main>
            @else
                <div class="row">
                    <div class="col s2.5">
                        <ul class="collapsible" id="cssmenu">
                            @if(auth()->user()->admin_professor == 1)
                                <li>
                                    <div class="collapsible-header"><i class="material-icons">settings</i>Ferramentas de administração</div>
                                    <div class="collapsible-body">
                                        <div class="collection">
                                            <b><a class="collection-item" href="{{route('register')}}">Cadastrar administradores</a></b>
                                            <b><a class="collection-item" href="{{route('professor.create')}}">Cadastrar professores</a></b>
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
                            @else
                                <div class="collection">
                                    <b><a class="collection-item" href="{{route('professor_turmas', auth()->user()->admin_professor)}}">Meus Alunos</a></b>
                                </div>
                            @endif
                        </ul>
                    </div>
                    <div class="col s9">
                        <main>
                            <div class="section">
                                <div class="card-panel">
                                    <nav>
                                        <div class="nav-wrapper blue">
                                            <div class="col s12 ">
                                                @yield('breadcrumbs')
                                            </div>
                                        </div>
                                    </nav>
                                    <div class="container">
                                    <h2>@yield('title')</h2>
                                    </div>
                                    @yield('content')
                                </div>
                            </div>
                        </main>
                    </div>
                </div>
            @endguest
        </header>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/js/materialize.min.js"></script>
        <script type="text/javascript" src="{{asset('js/script.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/modais.js')}}"></script>
        <script>
            $(document).ready(function(){
              $('ul.tabs').tabs({
                swipeable : true,
                responsiveThreshold : 1900,
              });
            });
        </script>
    </body>
</html>