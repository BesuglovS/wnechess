@extends('layouts.master')

@section('title')
    Редактирование схемы турнира {{$tournament->name}}
@endsection

@section('content')
    <div class="container alert alert-info alert-block"><a href="{{ url('/') }}/adminTournaments">Список турниров</a></div>
    <div style="text-align: center">Редактирование схемы турнира</div>
    <div class="container" style="align-items: center; display: flex; flex-direction: column; justify-content: center;">

        <div style="align-items: center; display: flex; flex-direction: row; justify-content: center;">
            <a href="{{ url('/') }}/adminTournament/{{$tournament->id}}/editSchema">Редактировать схему</a>
        </div>

        <form action="{{ url('/') }}/adminTournamentNodes" method="POST">
            @csrf

            <div>
                <p>Название игры</p>
                <input style="width: 300px" name="name" value="">
            </div>

            <div>
                <p>Игра</p>
                <select style="width: 450px" name="game_id">
                    <option value="-1">Нет</option>
                    @foreach($games as $game)
                        <option value="{{$game->id}}">{{$game->pl1Name}} vs {{$game->pl2Name}} - {{\Carbon\Carbon::parse($game->date)->format('d.m.Y H:i:s')}}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <p>Следующий этап</p>
                <select style="width: 450px" name="parent_id">
                    <option value="-1">Нет</option>
                    @foreach($tournamentNodes as $tournamentNode)
                        <option value="{{$tournamentNode->id}}">{{$tournamentNode->name}}: {{$tournamentNode->pl1Name}} vs {{$tournamentNode->pl2Name}} - {{\Carbon\Carbon::parse($tournamentNode->date)->format('d.m.Y H:i:s')}}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <p>Игрок 1</p>
                <select style="width: 300px" name="player1_id">
                    <option value="-1">Нет</option>
                    @foreach($players as $player)
                        <option value="{{$player->id}}">{{$player->name}} ({{$player->group}}) - {{$player->rating}}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <p>Игрок 2</p>
                <select style="width: 300px" name="player2_id">
                    <option value="-1">Нет</option>
                    @foreach($players as $player)
                        <option value="{{$player->id}}">{{$player->name}} ({{$player->group}}) - {{$player->rating}}</option>
                    @endforeach
                </select>
            </div>

            <input type="hidden" name="tournament_id" value="{{$tournament->id}}">

            <div style="margin-top: 1em;">
                <button type="submit" class="button is-primary">Добавить</button>
            </div>
        </form>


    </div>
@endsection
