@extends ('layout.app')

@section('content')
    <h2>your activities</h2>
    @foreach ($apiResults as $apiResult)
        <ul class="list-group">

            <h4 class="list-group-item">{{ $apiResult->name }}</h4>
            <li class="list-group-item">{{ $apiResult->distance}}</li>
            <li class="list-group-item">{{ $apiResult->moving_time}}</li>

        </ul>
    @endforeach
@endsection

