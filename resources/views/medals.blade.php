@extends ('layout.app')

@section('content')
    @if (Auth::user()->medals->isEmpty())
        <div class="no-content">
            <h3>U have no medals</h3>
            <h4>How can I earn medals?</h4>
            <p>By running your weekly goals, u can earn following medals:</p>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="trophy-case">
                    <img class="medal medal-full" src="images/medals/gold.png" alt="">
                    <h3>#</h3>
                    <p>Gold medals</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="trophy-case">
                    <img class="medal medal-full" src="images/medals/silver.png" alt="">
                    <h3>#</h3>
                    <p>Silver medals</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="trophy-case">
                    <img class="medal medal-full" src="images/medals/bronze.png" alt="">
                    <h3>#</h3>
                    <p>Bronze medals</p>
                </div>
            </div>
        </div>
    @else
        <div class="row">
            @foreach(Auth::user()->medals as $medal)
                <div class="col-md-3">
                    <div class="medal-showcase">
                        <img class="medal medal-full" src="images/medals/{{ $medal->type }}.png" alt="">
                        <h4>{{ $medal->long_name }}</h4>
                        <p>{{date("d F Y", strtotime($medal->updated_at)) }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection

