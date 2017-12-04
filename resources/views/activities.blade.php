@extends ('layout.app')

@section('content')
    @foreach ($activities as $activity)
        <div class="activity">
            <h4 class="activityList-head">{{ $activity->name }}</h4>
            <ul class="activityList">

                <li class="activityList-item">{{ $activity->distance / 1000}} km</li>
                <li class="activityList-item">{{ gmdate("H:i", $activity->moving_time) }}</li>
            </ul>
        </div>
    @endforeach
@endsection

