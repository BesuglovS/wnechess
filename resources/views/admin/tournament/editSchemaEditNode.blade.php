@extends('layouts.master')

@section('title')
    Редактирование схемы турнира {{$tournament->name}}
@endsection

@section('content')
    <div class="container alert alert-info alert-block"><a href="{{ url('/') }}/adminTournaments">Список турниров</a></div>
    <div style="text-align: center">Редактирование узла схемы турнира</div>
    <div class="container" style="align-items: center; display: flex; flex-direction: column; justify-content: center;">

        <div style="align-items: center; display: flex; flex-direction: row; justify-content: center;">
            <a href="{{ url('/') }}/adminTournament/{{$tournament->id}}/editSchema">Редактировать схему</a>
        </div>

        <form action="{{ url('/') }}/adminTournamentNodes/{{$tournamentNode->id}}" method="POST">
            @csrf
            @method('patch')

            <div>
                <p>Название игры</p>
                <input style="width: 300px" name="name" value="{{$tournamentNode->name}}">
            </div>

            <div>
                <p>Игра</p>
                <select style="width: 450px" name="game_id">
                    <option value="-1"
                    @if($tournamentNode->game_id == NULL)
                        selected="selected"
                    @endif
                    >Нет</option>
                    @foreach($games as $game)
                        <option value="{{$game->id}}"
                        @if($tournamentNode->game_id == $game->id)
                            selected="selected"
                        @endif
                        >{{$game->pl1Name}} vs {{$game->pl2Name}} - {{\Carbon\Carbon::parse($game->date)->format('d.m.Y H:i:s')}}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <p>Следующий этап</p>
                <select style="width: 450px" name="parent_id">
                    <option value="-1"
                        @if($tournamentNode->node_id == NULL)
                            selected="selected"
                        @endif
                    >Нет</option>
                    @foreach($tournamentNodes as $tNode)
                        <option value="{{$tNode->node_id}}"
                            @if($tournamentNode->parent_id == $tNode->node_id)
                                selected="selected"
                            @endif
                        >{{$tNode->name}}: {{$tNode->pl1Name}} vs {{$tNode->pl2Name}} - {{\Carbon\Carbon::parse($tNode->date)->format('d.m.Y H:i:s')}}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <p>Игрок 1</p>
                <select style="width: 300px" name="player1_id">
                    <option value="-1"
                        @if($tournamentNode->player1_id == NULL)
                            selected="selected"
                        @endif
                    >Нет</option>
                    @foreach($players as $player)
                        <option value="{{$player->id}}"
                            @if($tournamentNode->player1_id == $player->id)
                                selected="selected"
                            @endif
                        >{{$player->name}} ({{$player->group}}) - {{$player->rating}}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <p>Игрок 2</p>
                <select style="width: 300px" name="player2_id">
                    <option value="-1"
                        @if($tournamentNode->player2_id == NULL)
                            selected="selected"
                        @endif>Нет</option>
                    @foreach($players as $player)
                        <option value="{{$player->id}}"
                            @if($tournamentNode->player2_id == $player->id)
                                selected="selected"
                            @endif
                        >{{$player->name}} ({{$player->group}}) - {{$player->rating}}</option>
                    @endforeach
                </select>
            </div>

            <input type="hidden" name="tournament_id" value="{{$tournament->id}}">

            <div style="margin-top: 1em;">
                <button type="submit" class="button is-primary">Сохранить</button>
            </div>
        </form>


    </div>
@endsection
