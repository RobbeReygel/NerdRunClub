@extends ('layout.app')

@section('content')
    <h2>Your medals</h2>
    <ul>
        @foreach(Auth::user()->medals as $medal)
            <li>{{ $medal->type }} - {{ $medal->short_name }}</li>
        @endforeach
    </ul>
@endsection

