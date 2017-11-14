@extends ('../layout/app')

@section('content')
        <div id="week">
            <h4 class="inbox">Weekelijkse vooruitgang</h4>
            <p class="this-week">Deze week: {{ $goal['totalRanThisWeek'] / 1000 }}km / {{ $goal['goalThisWeek'] }}km</p>
            <div class="weekly-goal">
                @if ($goal['totalRanThisWeek'] == 0)
                    <div class="inner" style="width: 0%">

                    </div>
                    <p>0%</p>
                @else
                    <div class="inner" style="width: {{ round(($goal['totalRanThisWeek'] / 1000) / $goal['goalThisWeek'] * 100) }}%">

                    </div>
                    <p>{{ round(($goal['totalRanThisWeek'] / 1000) / $goal['goalThisWeek'] * 100) }}%</p>
                @endif
            </div>
            <p class="next-week">Volgende week: {{ $goal['goalNextWeek'] }}km lopen</p>
        </div>

    @if (isset($user->totalDistance[0]->sum_distance))

        <div id="week">
            <h4 class="inbox">Deze week</h4>
            @if ($days < 7)
                @if (array_key_exists(0, $user->totalDistanceWeekly))
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