@extends('layouts.master')

@section('title')
    {{$tournament->name}}
@endsection

@section('content')
    <div class="container" style="align-items: center; display: flex; flex-direction:column; justify-content: center;">
        <div class="container alert alert-info alert-block"><a href="{{ url('/') }}/Tournaments">Список турниров</a></div>
        <div style="text-align: center">
            <div>Список игр турнира <br /><strong>"{{$tournament->name}}"</strong></div>
        </div>

        @if($tournament->type == "Олимпийская система")
        <table style="margin: 10px" class="table td-center is-bordered">
            <tr style="text-align: center;">
                <th>Название игры</th>
                <th>Следущий этап</th>
                <th>Белые</th>
                <th>Рейтинг белых</th>
                <th>Чёрные</th>
                <th>Рейтинг чёрных</th>
                <th>Результат</th>
                <th>Дата</th>
                <th>Опции</th>
            </tr>


            @foreach($tournamentNodes as $tournamentNode)
                <tr>
                    <td>{{$tournamentNode->name}}</td>
                    <td>{{$tournamentNode->nextNodeName}}</td>
                    <td>{{$tournamentNode->pl1Name}}</td>
                    <td>@if($tournamentNode->game_id !== null){{$tournamentNode->player1RatingBefore}} / {{$tournamentNode->player1RatingAfter}}@endif</td>
                    <td>{{$tournamentNode->pl2Name}}</td>
                    <td>@if($tournamentNode->game_id !== null){{$tournamentNode->player2RatingBefore}} / {{$tournamentNode->player2RatingAfter}}@endif</td>
                    <td>@if($tournamentNode->game_id !== null){{$tournamentNode->result == 1 ? "1:0" : (($tournamentNode->result == 0) ? "1/2:1/2" : "0:1")}}@endif</td>
                    <td>@if($tournamentNode->game_id !== null){{\Carbon\Carbon::parse($tournamentNode->date)->format('d.m.Y H:i:s')}}@endif</td>
                    <td>
                        @if($tournamentNode->pgn != "")
                            <a href="{{ url('/')}}/Game/{{$tournamentNode->game_id}}">Открыть PGN</a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </table>
        @endif

        @if($tournament->type !== "Олимпийская система")
            <table style="margin: 10px" class="table td-center is-bordered">
                <tr style="text-align: center;">
                    <th>Белые</th>
                    <th>Рейтинг белых</th>
                    <th>Чёрные</th>
                    <th>Рейтинг чёрных</th>
                    <th>Результат</th>
                    <th>Дата</th>
                    <th>Опции</th>
                </tr>


                @foreach($tournamentGames as $tournamentNode)
                    <tr>
                        <td>{{$tournamentNode->pl1Name}}</td>
                        <td>{{$tournamentNode->player1RatingBefore}} / {{$tournamentNode->player1RatingAfter}}</td>
                        <td>{{$tournamentNode->pl2Name}}</td>
                        <td>{{$tournamentNode->player2RatingBefore}} / {{$tournamentNode->player2RatingAfter}}</td>
                        <td>{{$tournamentNode->result == 1 ? "1:0" : (($tournamentNode->result == 0) ? "1/2:1/2" : "0:1")}}</td>
                        <td>{{\Carbon\Carbon::parse($tournamentNode->date)->format('d.m.Y H:i:s')}}</td>
                        <td>
                            @if($tournamentNode->pgn != "")
                                <a href="{{ url('/')}}/Game/{{$tournamentNode->game_id}}">Открыть PGN</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </table>
        @endif
    </div>
@endsection
