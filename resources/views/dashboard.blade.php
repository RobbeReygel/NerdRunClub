@extends ('../layout/app')

@section('content')
    <!--- div class="row">
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

        </div>
    </div> --->
    <div class="row">
        <div class="col-md-3">
            <div class="trophy-case">
                <img class="medal medal-full" src="images/medals/platinum.png" alt="">
                <h3>{{ count($user->medals->where('type', 'platinum')) }}</h3>
                <p>Trophies</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="trophy-case">
                <img class="medal medal-full" src="images/medals/gold.png" alt="">
                <h3>{{ count($user->medals->where('type', 'gold')) }}</h3>
                <p>Gold medals</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="trophy-case">
                <img class="medal medal-full" src="images/medals/silver.png" alt="">
                <h3>{{ count($user->medals->where('type', 'silver')) }}</h3>
                <p>Silver medals</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="trophy-case">
                <img class="medal medal-full" src="images/medals/bronze.png" alt="">
                <h3>{{ count($user->medals->where('type', 'bronze')) }}</h3>
                <p>Bronze medals</p>
            </div>
        </div>
    </div>
    <div class="user-progress">
        <div class="line" style="left: 25%">
            <p>25%</p>
            <p class="bottom"><img class="medal medal-icon" src="images/medals/bronze.png" alt=""></p>
        </div>
        <div class="line" style="left: 50%">
            <p>50%</p>
            <p class="bottom"><img class="medal medal-icon" src="images/medals/silver.png" alt=""></p>
        </div>
        <div class="line" style="left: 95%">
            <p>100%</p>
            <p class="bottom"><img class="medal medal-icon" src="images/medals/gold.png" alt=""></p>
        </div>
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
                <span class="weekly">Weekly Goal:</span>
                <p>{{ round(($goal['totalRanThisWeek'] / 1000), 2) }} / {{ $goal['goalThisWeek'] }}KM</p>
                <span>Volgende week: {{ $goal['goalNextWeek'] }}KM lopen</span>
            </div>
        @endif
    </div>

    @if (isset($user->totalDistance[0]->sum_distance))
            @if ($days < 7)
                @if (isset($user->totalDistanceWeekly[0]->sum_distance))
                    <div class="row">
                        <div class="col-md-6">
                            <div class="total-distance">
                                <p>
                                    {{ $user->totalDistanceWeekly[0]->sum_distance / 1000 }}KM
                                </p>
                                <span>Total ran this week</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="total-time">
                                <p>{{ gmdate("H:i", $user->totalTimeWeekly[0]->sum_time) }}</p>
                                <span>Total time this week</span>
                            </div>
                        </div>
                    </div>
                @else
                    <p class="total-distance">0KM</p>
                    <p class="total-distance">0:00</p>
                @endif
            @else
                <p id="totalrun">0km</p>
                <p id="totaltime">0 uur</p>
            @endif
    @else
        <!-- If not run -->
    @endif
    <div class="row">
        <div class="col-md-6">
            <div class="total-distance">
                <p>
                    {{ $user->totalDistance[0]->sum_distance/1000 }}KM
                </p>
                <span>Total ran all time</span>
            </div>
        </div>
        <div class="col-md-6">
            <div class="total-time">
                <p>{{ gmdate("H:i", $user->totalTime[0]->sum_time) }}</p>
                <span>Total time all time</span>
            </div>
        </div>
    </div>

    <!--<h2>Top 3</h2>

    <div class="top3" id="leaderboard">

        @foreach($list as $item)
            <section>
                <img id="top3Avatar" src="{{ $item->avatar }}" alt="avatar">
                <p id="name">{{ $item->first_name }}</p>
                <p id="km">{{ number_format($item->totalDistanceWeekly/1000) }} km</p>
            </section>
        @endforeach

    </div> -->

@endsection