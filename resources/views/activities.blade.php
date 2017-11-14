@extends ('layout.app')

@section('content')
    <h2>your activities</h2>
    @foreach ($activities as $activity)
        <div id="activity">
            <h4 class="activityList-head">{{ $activity->name }}</h4>
            <ul class="activityList">

                <li class="activityList-item">{{ $activity->distance / 1000}} km</li>
                <li class="activityList-item">{{ gmdate("H:i", $activity->moving_time) }} uur</li>

            </ul>
        </div>
    @endforeach
@endsection

