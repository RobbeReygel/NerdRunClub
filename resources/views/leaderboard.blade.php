@extends ('layout.app')
<?php $i = 1 ?>
@section('content')
    <h2>Leaderboard</h2>
    <div id="leaderboard">
    <ul>
        @foreach($list as $item)

            <li>
                <h3>{{ $i++ }}</h3>
                <img src="{{ $item->avatar }}" alt="avatar">
                <span>{{ $item->first_name }} - {{ $item->totalDistance/1000 }} km</span>
            </li>
        @endforeach
    </ul>
    </div>
@endsection