@extends('layouts.master')

@section('title')
    Новая игра
@endsection

@section('content')
    <div class="container alert alert-info alert-block"><a href="{{ url('/') }}/adminGames">Список игр</a></div>
    <div style="text-align: center">Новая игра</div>
    <div class="container" style="align-items: center; display: flex; justify-content: center;">

        <form action="{{ url('/') }}/adminGames" method="POST">
            @csrf

            <div>
                <p>Белые</p>
                <select style="width: 300px" name="player1Id">
                    @foreach($players as $player)
                        <option value="{{$player->id}}">{{$player->name}} ({{$player->group}}) - {{$player->rating}}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <p>Чёрные</p>
                <select style="width: 300px" name="player2Id">
                    @foreach($players as $player)
                        <option value="{{$player->id}}">{{$player->name}} ({{$player->group}}) - {{$player->rating}}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <p>Турнир</p>
                <select style="width: 300px" name="tournament_id">
                    @foreach($tournaments as $tournament)
                        <option value="{{$tournament->id}}">{{$tournament->name}}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <p>Результат</p>
                <select style="width: 300px" name="result">
                    <option value="1">1:0</option>
                    <option value="0">1/2:1/2</option>
                    <option value="-1">0:1</option>
                </select>
            </div>

            <div style="margin-top: 1em;">
                <button type="submit" class="button is-primary">Добавить</button>

                <span style="margin-left: 20px">
                <a href="/adminGames" class="button is-danger">Отмена</a>
                </span>
            </div>
        </form>
    </div>
@endsection
