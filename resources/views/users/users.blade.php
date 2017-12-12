@extends ('layout.app')

@section('content')
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

