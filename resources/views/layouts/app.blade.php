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
                <a href="{{route('home')}}" class="brand-logo">SEMEL</a>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                    
                </ul>
            </div>
        </nav>
        <main class="py-4">
            @yield('content')
        </main>
        <script type="text/javascript" src="{{asset('js/script.js')}}"></script>
    </body>
</html>