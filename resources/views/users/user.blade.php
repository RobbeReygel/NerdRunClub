@extends ('layout.app')
@section('content')

    <div class="profile">
        <div class="profile__info">
            <img src="{{ $clickedUser->avatar }}" alt="">
            <div class="profile__name">
                <h3>{{ $clickedUser->first_name }} {{ $clickedUser->last_name }}</h3>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="trophy-case">
                <img class="medal medal-full" src="/images/medals/platinum.png" alt="">
                <h3>{{ count($clickedUser->medals->where('type', 'platinum')) }}</h3>
                <p>Trophies</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="trophy-case">
                <img class="medal medal-full" src="/images/medals/gold.png" alt="">
                <h3>{{ count($clickedUser->medals->where('type', 'gold')) }}</h3>
                <p>Gold medals</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="trophy-case">
                <img class="medal medal-full" src="/images/medals/silver.png" alt="">
                <h3>{{ count($clickedUser->medals->where('type', 'silver')) }}</h3>
                <p>Silver medals</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="trophy-case">
                <img class="medal medal-full" src="/images/medals/bronze.png" alt="">
                <h3>{{ count($clickedUser->medals->where('type', 'bronze')) }}</h3>
                <p>Bronze medals</p>
            </div>
        </div>
    </div>
    <div class="user-progress">
        <div class="line" style="left: 25%">
            <p>25%</p>
            <p class="bottom"><img class="medal medal-icon" src="/images/medals/bronze.png" alt=""></p>
        </div>
        <div class="line" style="left: 50%">
            <p>50%</p>
            <p class="bottom"><img class="medal medal-icon" src="/images/medals/silver.png" alt=""></p>
        </div>
        <div class="line" style="left: 95%">
            <p>100%</p>
            <p class="bottom"><img class="medal medal-icon" src="/images/medals/gold.png" alt=""></p>
        </div>
        @if ($goal['totalRanThisWeek'] == 0)
            <div class="inner" style="width: 0%">

            </div>
            <div class="progress-info">
                <p>0 / {{ $goal['goalThisWeek'] }}KM</p>
                <span>Volgende week: {{ $goal['goalNextWeek'] }}KM lopen</span>
            </div>
        @else
            <div class="inner"
                 style="width: {{ round((($goal['totalRanThisWeek'] / 1000) / $goal['goalThisWeek']) * 100) }}%">

            </div>
            <div class="progress-info">
                <span class="weekly">Weekly Goal:</span>
                <p>{{ round(($goal['totalRanThisWeek'] / 1000), 2) }} / {{ $goal['goalThisWeek'] }}KM</p>
                <span>Volgende week: {{ $goal['goalNextWeek'] }}KM lopen</span>
            </div>
        @endif
    </div>
@endsection