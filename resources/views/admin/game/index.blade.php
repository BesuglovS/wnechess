@extends('layouts.master')

@section('title')
    Игроки
@endsection

@section('content')
    <div class="container" style="align-items: center; display: flex; flex-direction:column; justify-content: center;">
        <div style="display: flex; flex-direction: row; justify-content: space-between; width:50%;">
            <div>Список игр</div>
            <div>
                <a href="{{ url('/') }}/adminGames/create" class="button is-primary">Добавить игру</a>
            </div>
        </div>

        <table style="margin: 10px" class="table td-center is-bordered">
            <tr style="text-align: center;">
                <th>Белые</th>
                <th>Рейтинг белых</th>
                <th>Чёрные</th>
                <th>Рейтинг чёрных</th>
                <th>Результат</th>
                <th>Дата</th>
                <th>Турнир</th>
                <th>Редактировать</th>
            </tr>
            @foreach($games as $game)
                <tr>
                    <td>{{$game->pl1Name}}</td>
                    <td>{{$game->player1RatingBefore}} / {{$game->player1RatingAfter}}</td>
                    <td>{{$game->pl2Name}}</td>
                    <td>{{$game->player2RatingBefore}} / {{$game->player2RatingAfter}}</td>
                    <td>{{$game->result == 1 ? "1:0" : (($game->result == 0) ? "1/2:1/2" : "0:1")}}</td>
                    <td>{{\Carbon\Carbon::parse($game->date)->format('d.m.Y H:i:s')}}</td>
                    <td>{{$game->tournamentName}}</td>
                    <td><a href="/adminGames/{{$game->id}}/edit">Редактировать</a></td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
