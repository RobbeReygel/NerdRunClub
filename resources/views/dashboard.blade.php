@extends ('../layout/app')

@section('content')
    <img src="#" alt="">

    @if (isset($user->totalDistance[0]->sum_distance))

    <div id=total>
        <h4 class="inbox">Totaal reeds gelopen</h4>
        <p id="totalrun">{{ $user->totalDistance[0]->sum_distance/1000 }}km</p>
        <p id="totaltime">{{ gmdate("H:i", $user->totalTime[0]->sum_time) }} uur</p>
    </div>


    <div id="week">
        <h4 class="inbox">Deze week</h4>
        @if (isset($user->totalDistanceWeekly[0]->sum_distance) && isset($user->totalTimeWeekly[0]->sum_time))
            <p id="totalrun">{{ $user->totalDistanceWeekly[0]->sum_distance/1000 }}km</p>
            <p id="totaltime">{{ gmdate("H:i", $user->totalTimeWeekly[0]->sum_time) }} uur</p>
        @else
            <p id="totalrun">0km</p>
            <p id="totaltime">0 uur</p>
        @endif
    </div>

    @else

        <div id=total>
            <h2>Totaal reeds gelopen</h2>
            <p id="totalrun">0km</p>
            <p id="totaltime">0 uur</p>
        </div>

        <div id="week">
            <h2>Deze week</h2>

            <!--<h3>Jij</h3>-->
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
                <p id="km">{{ $item->totalDistanceWeekly/1000 }} km</p>
            </section>
        @endforeach

    </div>

@endsection