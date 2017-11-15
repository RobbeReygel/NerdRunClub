@extends ('../layout/app')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="user-overview">
                <img src="{{ $user->avatar }}" alt="">
                <div class="user-info">
                    <h3>{{ $user->first_name }} {{ $user->last_name }}</h3>
                    <p>🥇 <span>{{ count($user->medals->where('type', 'gold')) }}</span></p>
                    <p>🥈 <span>{{ count($user->medals->where('type', 'silver')) }}</span></p>
                    <p>🥉 <span>{{ count($user->medals->where('type', 'bronze')) }}</span></p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="user-progress">
                @if ($goal['totalRanThisWeek'] == 0)
                    <div class="inner" style="width: 0%">

                    </div>
                    <div class="progress-info">
                        <p>0 / {{ $goal['goalThisWeek'] }}KM</p>
                        span>Volgende week: {{ $goal['goalNextWeek'] }}KM lopen</span>
                    </div>
                @else
                    <div class="inner" style="width: {{ round((($goal['totalRanThisWeek'] / 1000) / $goal['goalThisWeek']) * 100) }}%">

                    </div>
                    <div class="progress-info">
                        <p>{{ round(($goal['totalRanThisWeek'] / 1000), 2) }} / {{ $goal['goalThisWeek'] }}KM</p>
                        <span>Volgende week: {{ $goal['goalNextWeek'] }}KM lopen</span>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="ran-this-week">
        @foreach($user->getRanThisWeek() as $run)
            <p>
                {{ $run->name }}
                {{ $run->distance }}
                {{ $run->start_date }}
            </p>
        @endforeach
    </div>

    @if (isset($user->totalDistance[0]->sum_distance))
        <div id="week">
            <h4 class="inbox">Deze week</h4>
            @if ($days < 7)
                @if (isset($user->totalDistanceWeekly[0]->sum_distance))
                    <p id="totalrun">{{ $user->totalDistanceWeekly[0]->sum_distance / 1000 }}km</p>
                    <p id="totaltime">{{ gmdate("H:i", $user->totalTimeWeekly[0]->sum_time) }} uur</p>
                @else
                    <p id="totalrun">0km</p>
                    <p id="totaltime">00:00 uur</p>
                @endif
            @else
                <p id="totalrun">0km</p>
                <p id="totaltime">0 uur</p>
            @endif
        </div>

        <div id=total>
            <h4 class="inbox">Totaal reeds gelopen</h4>
            <p id="totalrun">{{ $user->totalDistance[0]->sum_distance/1000 }}km</p>
            <p id="totaltime">{{ gmdate("H:i", $user->totalTime[0]->sum_time) }} uur</p>
        </div>
    @else

        <div id="week">
            <h4 class="inbox">Deze week</h4>

            <!--<h3>Jij</h3>-->
            <p id="totalrun">0km</p>
            <p id="totaltime">0 uur</p>
        </div>

        <div id=total>
            <h4 class="inbox">Totaal reeds gelopen</h4>
            <p id="totalrun">0km</p>
            <p id="totaltime">0 uur</p>
        </div>

    @endif

    <h2>Top 3</h2>

    <div class="top3" id="leaderboard">

        @foreach($list as $item)
            <section>
                <img id="top3Avatar" src="{{ $item->avatar }}" alt="avatar">
                <p id="name">{{ $item->first_name }}</p>
                <p id="km">{{ number_format($item->totalDistanceWeekly/1000) }} km</p>
            </section>
        @endforeach

    </div>

@endsection