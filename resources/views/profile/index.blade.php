@extends ('layout.app')

@section('content')
    <div class="profile">
        <div class="profile__info">
            <img src="{{ $user->avatar }}" alt="">
            <div class="profile__name">
                <h3>{{ $user->first_name }}</h3>
                <p>{{ $user->last_name }}</p>
            </div>
        </div>
    </div>
@endsection