@extends ('layout.app')

@section('content')
    <section class="users">
        <h2>User</h2>
        <div class="user">
            <h2>{{$clickedUser->name}}</h2>
            <img class="avatar" src="{{$clickedUser->avatar}}" alt="avatar">
            <p>{{$clickedUser->email}}</p>
        </div>
        <form action="/user/{{$clickedUser->id}}" method="post">
            {{ csrf_field() }}
            <input value="{{$clickedUser->id}}" type="hidden" name="friend_id">
            <button type="submit">Add as friend</button>
        </form>
    </section>
@endsection