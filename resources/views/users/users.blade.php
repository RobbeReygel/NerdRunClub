@extends ('layout.app')

@section('content')
    <section class="users">
        <h2>Users</h2>
        @foreach($users as $u)
            <div class="user">
                <h2>{{$u->name}}</h2>

                <a href="/user/{{$u->id}}">
                    <img class="avatar" src="{{$u->avatar}}" alt="avatar">
                </a>
            </div>
        @endforeach
    </section>
@endsection

