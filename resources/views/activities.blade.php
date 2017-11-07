@extends ('layout.app')

@section('content')
    <h2>your activities</h2>
    @foreach ($activities as $activity)
        <h4 class="activityList-head">{{ $activity->name }}</h4>
        <ul class="activityList">

            <li class="activityList-item">{{ $activity->distance / 1000}} km</li>
            <li class="activityList-item">{{ $activity->moving_time / 3600}}</li>

        </ul>
    @endforeach
@endsection

