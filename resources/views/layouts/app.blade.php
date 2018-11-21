<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <script type="text/javascript" src="http://code.jquery.com/jquery-3.2.1.min.js"></script>

        {!! MaterializeCSS::include_full() !!}
    </head>
    <body>
        <nav>
            <div class="nav-wrapper #039be5 light-blue darken-1">
                <a href="#" class="brand-logo center">SEMEL</a>
                @guest
                    <ul id="nav-mobile" class="right hide-on-med-and-down">
                        <li><a href="{{route('login')}}">Login</a></li>
                        <li><a href="{{route('register')}}">Cadastro</a></li>
                    </ul>
                @else
                    <ul id="nav-mobile" class="left hide-on-med-and-down">
                            <ul id="dropdown1" class="dropdown-content">
                                <li><a href="{{route('professor.index')}}">Professor</a></li>
                                <li><a href="{{route('pessoas.index')}}">Cliente</a></li>
                            </ul>
                            <nav>
                                <ul class="right hide-on-med-and-down lighten-3 green">
                                    <li><a class="dropdown-trigger" href="#!" data-target="dropdown1">Usuarios<i class="material-icons right"></i></a></li>
                                </ul>
                            </nav>
                    </ul>
                    <ul id="nav-mobile" class="left hide-on-med-and-down">
                        <li><a href="{{route('anamneses.index')}}">Anamneses</a></li>
                        <li><a href="{{route('doencas.index')}}">Doenças</a></li>
                        <li><a href="{{route('turmas.index')}}">Turmas</a></li>
                        <li><a href="{{route('nucleos.index')}}">Nucleos</a></li>
                    </ul>
                    <ul id="nav-mobile" class="right hide-on-med-and-down"> 
                        <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> {{ __('Logout') }}</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                @endguest
            </div>
        </nav>
        <main>
            @yield('content')
        </main>
        <script type="text/javascript" src="{{asset('js/script.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/delete.js')}}"></script>
    </body>
</html>