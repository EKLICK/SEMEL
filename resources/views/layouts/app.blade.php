<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>SEMEL</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        {!! MaterializeCSS::include_full() !!}
        <link rel="stylesheet" href="{{asset('css/style.css')}}">
    </head>
    <body>
        <header>
            <div class="navbar-fixed">
                <nav class="#039be5 light-blue darken-1">
                    <div class="container nav-wrapper">
                        <a href="{{route('home')}}" class="brand-logo center"><b>ViverBem</b></a>
                        <div class="col s12">
                            @guest
                                <ul id="nav-mobile" class="right">
                                    <li><a href="{{route('login')}}"><b>Login</b></a></li>
                                </ul>
                            @else
                                <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                                <ul class="left hide-on-med-and-down">
                                    <h6><b>Usuário: &emsp;{{auth()->user()->nick}}</b></h6>
                                    <h6><b>Nível: &emsp;&emsp; @if(auth()->user()->admin_professor == 1) Administrador @else Professor @endif</b></h6>
                                </ul>
                                <ul id="nav-mobile" class="right">
                                    <li>
                                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="material-icons left">exit_to_app</i><b>{{ __('Sair') }}</b></a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                                    </li>
                                </ul>
                            @endguest
                        </div>
                    </div>
                </nav>
            </div>
        </header>
        @guest
            <main>
                @yield('content')
            </main>
        @else
            <div class="row">
                <div class="section">
                    <div class="col m2 hide-on-med-and-down">
                        <ul class="collapsible">
                            @if(auth()->user()->admin_professor == 1)
                                @include('layouts.menu')
                            @else
                                <div class="collection">
                                    <b><a class="collection-item" href="{{Route('professor_turmas', auth()->user()->admin_professor)}}" style="color: #039be5;">Minhas turmas</a></b>
                                    <b><a class="collection-item" href="{{Route('professor_info', $professor->id)}}" style="color: #039be5;">Suas informações</a></b>
                                </div>
                            @endif
                        </ul>
                    </div>
                    <div class="col m12 l10">
                        <div class="card-panel">
                            <nav class="hide-on-med-and-down">
                                <div class="nav-wrapper blue">
                                    <div class="col s12">
                                        <b>@yield('breadcrumbs')</b>
                                    </div>
                                </div>
                            </nav>
                            <div class="container">
                                <h2><b>@yield('title')</b></h2>
                            </div>
                            <br><br>
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
            <ul class="sidenav grey lighten-2" id="mobile-demo">
                <div class="row">
                    <div class="col s12 blue white-text">
                    <h6><b>Usuário: &emsp;{{auth()->user()->nick}}</b></h6>
                    <h6><b>Nivel: &emsp;&emsp; @if(auth()->user()->admin_professor == 1) Administrador @else Professor @endif</b></h6>
                    </div>
                    <div class="col s12">
                        <div class="card">
                            <ul class="collapsible">
                                @include('layouts.menu')
                            </ul>
                        </div>
                    </div>
                </div>
            </ul>
        @endguest
        <script>M.AutoInit();</script>
        <script type="text/javascript" src="{{asset('js/modais.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/script.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/ajax.js')}}"></script>
        <script>
            $(document).ready(function(){
                $('ul.tabs').tabs({
                    swipeable : true,
                    responsiveThreshold : 2500,
                });
            });
            $(document).ready(function(){
                $('.sidenav').sidenav();
            });
        </script>
    </body>
</html>