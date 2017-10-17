@extends ('../layout/app')

@section('content')
    <img src="#" alt="">

    <div id=total>
        <h2>Totaal reeds gelopen</h2>
        <p id="totalrun">35km</p>
        <p id="totaltime">3u 40m</p>
    </div>

    <div id="week">
        <h2>Deze week</h2>

        <h3>Totaal</h3>
        <p id="totalrun">4km</p>
        <p id="totaltime">29m</p>

        <h3>Doelstelling</h3>
        <p id="goal">10km</p>
    </div>

    <div id="leaderboard">
        <img src="#" alt="">
        <p id="name">Pieterjan Van Saet</p>
        <p id="km">15km</p>

        <h4>2</h4>
        <p id="name">Soren Wagemans</p>
        <p id="km">15km</p>

        <h4>3</h4>
        <p id="name">Robbe Reygel</p>
        <p id="km">15km</p>

        <h4>21</h4>
        <p id="name">Simon Van Herzele</p>
        <p id="km">4km</p>

    </div>

@endsection