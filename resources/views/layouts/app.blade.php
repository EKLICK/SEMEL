<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>SEMEL</title>
        <link rel="stylesheet" href="{{asset('css/style.css')}}">
        @yield('css.personalizado')
        <script type="text/javascript" src="http://code.jquery.com/jquery-3.2.1.min.js"></script>

        {!! MaterializeCSS::include_full() !!}
    </head>
    <body>
        <header>
            <div class="navbar-fixed">
                <nav class="#039be5 light-blue darken-1">
                    @guest
                    @else
                        <div class="subtitle">
                            <h6><b>Usuário: &emsp;@if(auth()->user()->admin_professor == 1) Administrador @else Professor @endif</b></h6>
                            <h6><b>Nome: &emsp;&emsp;{{auth()->user()->name}}</b></h6>
                        </div>
                    @endguest
                    <div class="container nav-wrapper">
                        <a href="{{route('home')}}" class="brand-logo center">SEMEL</a>
                        <div class="col 12">
                            @guest
                                <ul id="nav-mobile" class="right hide-on-med-and-down">
                                    <li><a href="{{route('login')}}"><b>Login</b></a></li>
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
                    <div class="col s2 white">
                        <div id='cssmenu'>
                            @if(auth()->user()->admin_professor == 1)
                                <ul>
                                    <li class='active has-sub'><a href='#'>Ferramentas de administração</a>
                                        <ul>
                                            <li class='active has-sub'><a href='#'>Registrar usuário</a>
                                                <ul>
                                                    <li><a href="{{route('register')}}">Cadastrar administradores</a></li>
                                                    <li><a href="{{route('professor.create')}}">Cadastrar professores</a></li>
                                                </ul>
                                            </li>
                                            <li class='active has-sub'><a href='#'>Registros deletados</a>
                                                <ul>
                                                    <li><a href="{{route('pessoas_softdeletes')}}">Pessoas deletados</a></li>
                                                    <li><a href="{{route('professores_softdeletes')}}">Professores deletados</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="{{route('audits.index')}}">Auditorias</a></li>
                                        </ul>
                                    </li>
                                    <li class='active has-sub'><a href='#'>Usuarios</a>
                                        <ul>
                                            <li><a href="{{route('professor.index')}}">Professores</a></li>
                                            <li><a href="{{route('pessoas.index')}}">Cliente</a></li>
                                        </ul>
                                    </li>
                                    <li class='active has-sub'><a href='#'>anamneses</a>
                                        <ul>
                                            <li><a href="{{route('anamneses.index')}}">Anamneses de {{date('Y')}}</a></li>
                                            <li><a href="{{route('anamneses.index2')}}">Anamneses Históricas</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="{{route('doencas.index')}}">Doenças</a></li>
                                    <li><a href="{{route('turmas.index')}}">Turmas</a></li>
                                    <li><a href="{{route('nucleos.index')}}">Nucleos</a></li>
                                </ul>
                            @else
                                <ul>
                                    <li><a href="{{route('professor.edit', 1)}}">Mudar informações da conta</a></li>
                                    <li><a href="{{route('professor_turmas', 1)}}">Minhas turmas</a></li>
                                </ul>
                            @endif
                        </div>
                    </div>
                    <div class="col s9">
                        <main>
                            <div class="section">
                                <div class="container">
                                    <nav>
                                        <div class="nav-wrapper blue">
                                            <div class="col s12 ">
                                                @yield('breadcrumbs')
                                            </div>
                                        </div>
                                    </nav>
                                    <h4>@yield('title')</h4>
                                    <div class="divider"></div>
                                </div>
                                @yield('content')
                            </div>
                        </main>
                    </div>
                </div>
            @endguest
        </header>
        <script type="text/javascript" src="{{asset('js/script.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/delete.js')}}"></script>
        @yield('js.personalizado')
    </body>
</html>