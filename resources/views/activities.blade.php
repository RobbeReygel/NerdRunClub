@extends ('layout.app')

@section('content')
    <h2>your activities</h2>
    @foreach ($apiResults as $apiResult)
        <h4 class="activityList-head">{{ $apiResult->name }}</h4>
        <ul class="activityList">

            <li class="activityList-item">{{ $apiResult->distance}} km</li>
            <li class="activityList-item">{{ $apiResult->moving_time}}</li>

        </ul>
    @endforeach
@endsection

