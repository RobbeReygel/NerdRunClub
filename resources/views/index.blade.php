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
        <h1>We challenge ourselves! #nerdrunners #weareimd</h1>
        <h2>Let us help you motivate yourself to run and prepare for the 10 miles!</h2>
        <a href="{{ route('auth.redirect') }}">Login with strava</a>
    </div>
</div>
</body>
</html>