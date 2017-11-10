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
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="https://use.fontawesome.com/ef9fae15ba.js"></script>
</head>
<body>
<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            @guest
                <a class="navbar-brand" href="/">NerdRunClub</a>
            @endguest
            @auth
            <a class="navbar-brand" href="/dashboard">NerdRunClub</a>
            @endauth
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                @auth
                <li><a href="/activities">Activities</a></li>
                <li><a href="/leaderboard">Leaderboard</a></li>
                @endauth
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @guest
                    <li><a href="{{ route('auth.redirect') }}">Login</a></li>
                @endguest
                @auth

                        <li class="dropdown" id="markasread" onclick="markNotificationAsRead()">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                <span class="fa fa-bell"> {{ count(auth()->user()->unreadNotifications) }}</span>
                            </a>

                            <ul class="dropdown-menu">
                                <li>
                                    @foreach(auth()->user()->unreadNotifications as $notification)
                                        @include('notification.'.snake_case(class_basename($notification->type)))
                                    @endforeach
                                </li>
                            </ul>
                        </li>

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->first_name }} <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ route('profile.index') }}">Profile</a></li>
                                <li><a href="{{ route('auth.logout') }}">Logout</a></li>
                            </ul>
                        </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
<div class="container">
    @yield('content')
</div>

</body>
</html>