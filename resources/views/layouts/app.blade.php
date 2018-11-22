<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>SEMEL</title>
        <link rel="stylesheet" href="{{'css/style.css'}}">
        <script type="text/javascript" src="http://code.jquery.com/jquery-3.2.1.min.js"></script>

        {!! MaterializeCSS::include_full() !!}
    </head>
    <body>
        <header>
            <div class="navbar-fixed">
                <nav class="#039be5 light-blue darken-1">
                    <div class="container nav-wrapper">
                        <a href="#" class="brand-logo center">SEMEL</a>
                        <div class="col 12">
                            @guest
                                <ul id="nav-mobile" class="right hide-on-med-and-down">
                                    <li><a href="{{route('login')}}">Login</a></li>
                                    <li><a href="{{route('register')}}">Cadastro</a></li>
                                </ul>
                            @else
                                <ul id="nav-mobile" class="right hide-on-med-and-down"> 
                                    <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> {{ __('Logout') }}</a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            @endguest
                        </div>
                    </div>
                </nav>
            </div>
            <div class="row">
                <div class="col 3 white">
                    <div id='cssmenu'>
                        <ul>
                            <li class='active has-sub'><a href='#'>Usuarios</a>
                                <ul>
                                    <li><a href="{{route('professor.index')}}">Professores</a></li>
                                    <li><a href="{{route('pessoas.index')}}">Cliente</a></li>
                                </ul>
                            </li>
                            <li><a href="{{route('anamneses.index')}}">Anamneses</a></li>
                            <li><a href="{{route('doencas.index')}}">Doenças</a></li>
                            <li><a href="{{route('turmas.index')}}">Turmas</a></li>
                            <li><a href="{{route('nucleos.index')}}">Nucleos</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col s9">
                    <main>
                        @yield('content')
                    </main>
                </div>
            </div>
        </header>
        <script type="text/javascript" src="{{asset('js/script.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/delete.js')}}"></script>
    </body>
</html>