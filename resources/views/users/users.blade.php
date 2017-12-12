@extends ('layout.app')

@section('content')
    <form action="{{ route('users') }}" method="get">
        <input type="text" name="keyword" placeholder="keyword" value="{{ isset($keyword) ? $keyword : '' }}">
        <button type="submit">Filter</button>
    </form>
    <section class="users">
        @foreach($users as $u)
            <div class="user">
                <a href="/user/{{$u->id}}">

                        <img class="avatar" src="{{$u->avatar}}" alt="{{$u->first_name}} {{$u->last_name}}">

                        <h4 class="imgName">{{$u->first_name}}</h4>

                </a>
            </div>

        @endforeach
    </section>
    {{ $users->appends(['keyword' => $keyword]) }}
@endsection

