@extends ('layout.app')

@section('content')
    @if (Auth::user()->medals->isEmpty())
        <div class="no-content">
            <h3>(╬ ಠ益ಠ)</h3>
            <p>Seems empty here</p>
        </div>
    @else
        <div class="row">
            @foreach(Auth::user()->medals as $medal)
                <div class="col-md-3">
                    <div class="medal">
                        <img class="medal medal-full" src="images/medals/{{ $medal->type }}.png" alt="">
                        <h4>{{ $medal->long_name }}</h4>
                        <p>{{ \Carbon\Carbon::createFromFormat("D F Y", $medal->create_on) }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection

