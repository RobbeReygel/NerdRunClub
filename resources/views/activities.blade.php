@extends ('layout.app')

@section('content')
<!--
    <form name="select">
        <select name="menu" onChange="window.document.location.href=this.options[this.selectedIndex].value;" value="GO">
            <option selected="selected" value="/activities/all">All</option>
            <option value="/activities/run">Run</option>
        </select>
    </form>
-->
    @foreach ($activities as $activity)
        <div class="activity">
            <h4 class="activityList-head">{{ $activity->name }} ({{$activity->type}})</h4>
            <ul class="activityList">

                <li class="activityList-item">{{ $activity->distance / 1000}} km</li>
                <li class="activityList-item">{{ gmdate("H:i", $activity->moving_time) }}</li>
            </ul>
        </div>
    @endforeach
@endsection

