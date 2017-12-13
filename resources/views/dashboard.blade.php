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
                <span class="weekly">Weekly Goal:</span>
                <p>0 / {{ $goal['goalThisWeek'] }}KM</p>
                <span>Volgende week: {{ $goal['goalNextWeek'] }}KM lopen</span>
            </div>
        @else
            <div class="inner
                @if (round((($goal['totalRanThisWeek'] / 1000) / $goal['goalThisWeek']) * 100) > 100)
                    completed
                @endif"
                 style="width: {{ round((($goal['totalRanThisWeek'] / 1000) / $goal['goalThisWeek']) * 100) }}%"

            >

            </div>
            <div class="progress-info">
                <span class="weekly">Weekly Goal <span style="color: #e77e21;">(WEEK 1)</span>:</span>
                <p>{{ round(($goal['totalRanThisWeek'] / 1000), 2) }} / {{ $goal['goalThisWeek'] }}KM</p>
                <span>Volgende week: {{ $goal['goalNextWeek'] }}KM lopen</span>
            </div>
        @endif
    </div>

    <ul style="list-style: none; display: flex; align-items: stretch; justify-content: space-between; padding: 0; margin-top: 30px;">

            @foreach($weeks as $week)
                @if(in_array($week, $test))
                <li style="display: block; text-align: center; margin-right: 0px; flex: 0 1 auto; width: 50px; height: 50px; background: linear-gradient(135deg, #e77e21 0%, #e75722 100%); border-radius: 5px; border: 3px solid orange;"><span class="fa fa-check fa-3x" style="color:#2ab27b;"></span></li>
                @else
                <li style="display: block; text-align: center; margin-right: 0px; flex: 0 1 auto; width: 50px; height: 50px; background-color: #2a2a2a; border-radius: 5px; border: 3px solid orange;"><span class="fa fa-times fa-3x" style="color:#e74c3c;"></span></li>
                @endif
            @endforeach

    </ul>

    <ul style="list-style: none; display: flex; align-items: stretch; justify-content: space-between; padding: 0;">
        @for ($i = 1; $i < 10; $i++)
            <li style="color: white; font-size:0.9em;">Week {{$i}}</li>
        @endfor
    </ul>

    <div class="row">
        <div class="col-md-4">
            <div class="trophy-case">
                <img class="medal medal-full" src="images/medals/gold.png" alt="">
                <h3>{{ count($user->medals->where('type', 'gold')) }}</h3>
                <p>Gold medals</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="trophy-case">
                <img class="medal medal-full" src="images/medals/silver.png" alt="">
                <h3>{{ count($user->medals->where('type', 'silver')) }}</h3>
                <p>Silver medals</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="trophy-case">
                <img class="medal medal-full" src="images/medals/bronze.png" alt="">
                <h3>{{ count($user->medals->where('type', 'bronze')) }}</h3>
                <p>Bronze medals</p>
            </div>
        </div>
    </div>
    @if (isset($user->totalDistanceWeekly[0]->sum_distance))
        <div class="row">
            <div class="col-md-6">
                <div class="total-distance">
                    <p class="value">
                        {{ $user->totalDistanceWeekly[0]->sum_distance / 1000 }}KM
                    </p>
                    <p class="evolution">
                        @if ($goal['totalRanThisWeek'] > $goal['totalRanPreviousWeek'])
                            @if ($goal['totalRanPreviousWeek'] == 0)
                                <i class="fa fa-arrow-up evolution-positive"></i> +{{ $goal['totalRanThisWeek'] }}%
                            @else
                                <i class="fa fa-arrow-up evolution-positive"></i>
                                +{{ abs(round(($goal['totalRanPreviousWeek'] - $goal['totalRanThisWeek']) / $goal['totalRanPreviousWeek'] * 100)) }}
                                %
                            @endif
                        @else
                            <i class="fa fa-arrow-down evolution-negative"></i>
                            -{{ abs(round(($goal['totalRanPreviousWeek'] - $goal['totalRanThisWeek']) / $goal['totalRanPreviousWeek'] * 100)) }}
                            %
                        @endif
                    </p>
                    <span>Total ran this week</span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="total-time">
                    <p class="value">{{ gmdate("H:i", $user->totalTimeWeekly[0]->sum_time) }}</p>
                    <p class="evolution">
                        @if ($goal['totalTimeThisWeek'] > $goal['totalTimePreviousWeek'])
                            @if ($goal['totalRanPreviousWeek'] == 0)
                                <i class="fa fa-arrow-up evolution-positive"></i> +{{ $goal['totalRanThisWeek'] }}%
                            @else
                                <i class="fa fa-arrow-up evolution-positive"></i>
                                +{{ abs(round(($goal['totalTimePreviousWeek'] - $goal['totalTimeThisWeek']) / $goal['totalTimePreviousWeek'] * 100)) }}
                                %
                            @endif
                        @else
                            <i class="fa fa-arrow-down evolution-negative"></i>
                            -{{ abs(round(($goal['totalTimePreviousWeek'] - $goal['totalTimeThisWeek']) / $goal['totalTimePreviousWeek'] * 100)) }}
                            %
                        @endif
                    </p>
                    <span>Total time this week</span>
                </div>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-md-6">
                <div class="total-distance">
                    <p class="value">
                        0KM
                    </p>
                    <span>Total ran this week</span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="total-time">
                    <p class="value">00:00</p>
                    <span>Total time this week</span>
                </div>
            </div>
        </div>
    @endif

    @if (isset($user->totalDistance[0]->sum_distance))
        <div class="row">
            <div class="col-md-6">
                <div class="total-distance">
                    <p class="value">
                        {{ $user->totalDistance[0]->sum_distance/1000 }}KM
                    </p>
                    <span>Total ran all time</span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="total-time">
                    <p class="value">{{ gmdate("H:i", $user->totalTime[0]->sum_time) }}</p>
                    <span>Total time all time</span>
                </div>
            </div>
        </div>
    @else

        <div class="row">
            <div class="col-md-6">
                <div class="total-distance">
                    <p class="value">
                        0KM
                    </p>
                    <span>Total ran all time</span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="total-time">
                    <p class="value">00:00</p>
                    <span>Total time all time</span>
                </div>
            </div>
        </div>
    @endif
@endsection