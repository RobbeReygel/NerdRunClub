<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Nerd Running Club</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    </head>
    <body>
    @section('header')
        <header>
            <a href="../activities"><p>activities</p></a>
            <img src="" alt="">
        </header>
    @show

    <div class="container">
            @yield('content')
    </div>

    </body>
</html>
