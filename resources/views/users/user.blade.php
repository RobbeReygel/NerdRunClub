@extends ('layout.app')
@section('content')
    <section class="users">
        <div class="user">
            <h2>{{$clickedUser->first_name}} {{$clickedUser->last_name}}</h2>
            <img class="avatar" src="{{$clickedUser->avatar}}" alt="avatar">
        </div>
        <form class="form-add" action="/user/{{$clickedUser->id}}" method="post">
            {{ csrf_field() }}
            <input value="{{$clickedUser->id}}" type="hidden" name="friend_id">
            <button class="add-friend" type="submit">Add as friend</button>
        </form>
    </section>
@endsection