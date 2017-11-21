<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Nerd Running Club</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://use.fontawesome.com/ef9fae15ba.js"></script>
</head>
<body>

<div class="hero">
    <div class="center">
        <h1>Deze tekst wordt een sterke en mooie motivatie slogan</h1>
        <!-- <a href="{{ route('auth.redirect') }}" class="btn btn-sm animated-button victoria-two">Login</a> -->
        <a href="{{ route('auth.redirect') }}">Login with strava</a>
    </div>
</div>
</body>
</html>