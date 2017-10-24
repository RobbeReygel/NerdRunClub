@extends ('layout.app')

@section('content')
    <h2>Leaderboard</h2>
    <div id="leaderboard">
    <ul>
        @foreach($list as $item)
            <li><img src="{{ $item->avatar }}" alt="avatar"> {{ $item->first_name }} - {{ $item->totalDistance/1000 }} km</li>
        @endforeach
    </ul>
    </div>
@endsection