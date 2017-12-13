@extends ('layout.app')

@section('content')
    <form action="{{ action('UserController@search') }}" method="post" class="search">
        {{ csrf_field() }}
        <div>
            <label for="keyword">Search your runner!</label>
            <section>
                <input type="search" id="keyword" name="keyword" placeholder="keyword" value="{{ old('keyword') }}">
                <button>Filter</button>
            </section>
        </div>
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
@endsection

