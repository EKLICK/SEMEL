<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>

        {!! MaterializeCSS::include_full() !!}
        <link rel="stylesheet" href="{{asset('css/style.css')}}">
    </head>
    <body>
        <nav>
            <div class="nav-wrapper lighten-3 green">
                <a href="#" class="brand-logo center">SEMEL</a>
                @guest
                    <ul id="nav-mobile" class="right hide-on-med-and-down">
                        <li><a href="{{route('login')}}">Login</a></li>
                        <li><a href="{{route('register')}}">Cadastro</a></li>
                    </ul>
                @else
                    <ul id="nav-mobile" class="left hide-on-med-and-down">
                            <ul id="dropdown1" class="dropdown-content">
                                <li><a href="#!">Professor</a></li>
                                <li><a href="#!">Cliente</a></li>
                            </ul>
                            <nav>
                                <ul class="right hide-on-med-and-down lighten-3 green">
                                    <li><a class="dropdown-trigger" href="#!" data-target="dropdown1">Usuarios<i class="material-icons right">arrow_drop_down</i></a></li>
                                </ul>
                            </nav>
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
        <main class="py-4">
            @yield('content')
        </main>
        <script type="text/javascript" src="{{asset('js/script.js')}}"></script>
    </body>
</html>