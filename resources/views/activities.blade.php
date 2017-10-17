@extends ('../layout/app')

@section('content')
    <ul>
        @foreach ($apiResults as $apiResult)
            <li>{{ $apiResult->name }}</li>
        @endforeach
    </ul>
@endsection

