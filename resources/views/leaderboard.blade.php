@extends ('layout.app')

@section('content')
    <h2>Weekly Leaderboard</h2>
    <div id="leaderboard">
    <ul>
        @foreach($list as $item)
        @if ($i == 1)
            <li style="border-left: 6px solid gold">
                <h3><span class="fa fa-trophy" style="color:gold"></span> {{ $i++ }}</h3>
                <img src="{{ $item->avatar }}" alt="avatar">
                <span>{{ $item->first_name }} - {{ number_format($item->totalDistanceWeekly/1000) }} km</span>
            </li>
        @elseif ($i == 2)
            <li style="border-left: 6px solid silver">
                <h3><span class="fa fa-trophy" style="color:silver"></span> {{ $i++ }}</h3>
                <img src="{{ $item->avatar }}" alt="avatar">
                <span>{{ $item->first_name }} - {{ number_format($item->totalDistanceWeekly/1000) }} km</span>
            </li>
        @elseif ($i == 3)
            <li style="border-left: 6px solid #CD7F32; margin-bottom: 100px;">
                <h3><span class="fa fa-trophy" style="color:#CD7F32"></span> {{ $i++ }}</h3>
                <img src="{{ $item->avatar }}" alt="avatar">
                <span>{{ $item->first_name }} - {{ number_format($item->totalDistanceWeekly/1000) }} km</span>
            </li>
        @else
            <li>
                <h3>{{ $i++ }}</h3>
                <img src="{{ $item->avatar }}" alt="avatar">
                <span>{{ $item->first_name }} - {{ number_format($item->totalDistanceWeekly/1000) }} km</span>
            </li>
        @endif

        @endforeach
    </ul>
    </div>
@endsection