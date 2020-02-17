@extends('layouts.master')

@section('title')
    Новая игра
@endsection

@section('content')
    <div class="container alert alert-info alert-block"><a href="{{ url('/') }}/adminGames">Список игр</a></div>
    <div style="text-align: center">Редактировать игру</div>
    <div class="container" style="align-items: center; display: flex; justify-content: center;">

        <form action="{{ url('/') }}/adminGames/{{$game->id}}" method="POST">
            @csrf
            @method('patch')

            <div>
                <p>Белые</p>
                <select style="width: 300px" name="player1Id">
                    @foreach($players as $player)
                        <option value="{{$player->id}}"
                                @if ($game->player1Id == $player->id)
                                selected="selected"
                                @endif
                        >{{$player->name}} ({{$player->group}}) - {{$player->rating}}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <p>Чёрные</p>
                <select style="width: 300px" name="player2Id">
                    @foreach($players as $player)
                        <option value="{{$player->id}}"
                                @if ($game->player2Id == $player->id)
                                selected="selected"
                                @endif
                        >{{$player->name}} ({{$player->group}}) - {{$player->rating}}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <p>Турнир</p>
                <select style="width: 300px" name="tournament_id">
                    @foreach($tournaments as $tournament)
                        <option value="{{$tournament->id}}"
                                @if ($game->tournament_id == $tournament->id)
                                selected="selected"
                                @endif
                        >{{$tournament->name}}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <p>Результат</p>
                <select style="width: 300px" name="result">
                    <option value="1" @if($game->result == "1")selected="selected"@endif>1:0</option>
                    <option value="0" @if($game->result == "0")selected="selected"@endif>1/2:1/2</option>
                    <option value="-1" @if($game->result == "-1")selected="selected"@endif>0:1</option>
                </select>
            </div>

            <div style="margin-top: 1em;">
                <p>PGN</p>
                <textarea name="pgn" rows="10" cols="80">{{$game->pgn}}</textarea>
            </div>

            <div style="margin-top: 1em;">
                <button type="submit" class="button is-primary">Сохранить</button>
            </div>
        </form>
    </div>
@endsection
