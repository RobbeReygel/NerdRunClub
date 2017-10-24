@extends ('layout.app')

@section('content')
    <h2>Leaderboard</h2>
    <ul>
        @foreach($list as $item)
            <li>{{ $item }}</li><br>
        @endforeach
    </ul>
@endsection