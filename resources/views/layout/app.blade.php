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
    <link rel="icon" href="/images/logo.svg">
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
                <a class="navbar-brand" href="/"><img src="/images/logo.svg" alt=""></a>
            @endguest
            @auth
            <a class="navbar-brand" href="/dashboard"><img src="/images/logo.svg" alt=""></a>
            @endauth
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                @auth
                <!--<li><a href="/activities">Activities</a></li>-->
                <li><a href="/leaderboard">Leaderboard</a></li>
                <li><a href="/medals">Medals</a></li>
                <li><a href="/users">Users</a></li>
                @endauth
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @guest
                    <li><a href="{{ route('auth.redirect') }}">Login</a></li>
                @endguest
                @auth

                        <li class="dropdown" id="markasread" onclick="markNotificationAsRead()">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                <span class="fa fa-bell"> </span> {{ count(auth()->user()->unreadNotifications) }}
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
                                <li><a href="/user/{{Auth::user()->id}}">Profile</a></li>
                                <li><a href="{{ route('auth.logout') }}">Logout</a></li>
                            </ul>
                        </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<div class="title">
    <h1>{{ \Request::route()->getName() }}</h1>
</div>
<div class="container">
    @yield('content')
</div>
<footer>
    <div class="footer-light">
        <div class="creators">
            <img src="https://scontent.fbru2-1.fna.fbcdn.net/v/t1.0-9/10392467_713002862142196_4646838072861789543_n.jpg?oh=bd565f52481b1218879db82a4a52f2b7&oe=5A623ED1" alt="Sören">
            <img src="https://scontent.fbru2-1.fna.fbcdn.net/v/t1.0-1/22007587_1738030626238466_5930106369545113792_n.jpg?oh=921f7e896db5bd280283e6d997c396ad&oe=5AA90BAC" alt="Robbe">
            <img src="https://lh3.googleusercontent.com/-THJg6ksDnxs/AAAAAAAAAAI/AAAAAAAAAo0/PYtJUwRjQjA/photo.jpg" alt="Pieterjan">
        </div>
    </div>
    <div class="footer-dark">
        &copy; {{ date('Y') }} nerdrunners #weareimd
    </div>
</footer>
</body>
</html>