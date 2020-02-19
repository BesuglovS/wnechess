@extends('layouts.master')

@section('title')
    Редактирование схемы турнира {{$tournament->name}}
@endsection

@section('content')
    <div class="container alert alert-info alert-block"><a href="{{ url('/') }}/adminTournaments">Список турниров</a></div>
    <div style="text-align: center">Редактирование схемы турнира <strong>"{{$tournament->name}}"</strong></div>
    <div class="container" style="align-items: center; display: flex; flex-direction: column; justify-content: center;">

        <div style="align-items: center; display: flex; flex-direction: row; justify-content: center;">
            <a href="{{ url('/') }}/adminTournaments/{{$tournament->id}}/edit">Редактировать турнир</a>

            <a style="margin-left: 2em;" href="{{ url('/') }}/adminTournament/{{$tournament->id}}/editSchema/addNode">Добавить узел</a>
        </div>

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
                        <a href="{{ url('/')}}/adminTournamentNodes/{{$tournamentNode->id}}/edit">Редактировать</a>
                        <a href="{{ url('/')}}/adminTournamentNodes/{{$tournamentNode->id}}/delete">Удалить</a>
                        @if($tournamentNode->pgn != "")
                            <a href="{{ url('/')}}/Game/{{$tournamentNode->game_id}}">Открыть PGN</a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
