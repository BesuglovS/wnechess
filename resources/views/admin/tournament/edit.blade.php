@extends('layouts.master')

@section('title')
    Редактирование турнира
@endsection

@section('content')
    <div class="container alert alert-info alert-block"><a href="{{ url('/') }}/adminTournaments">Список турниров</a></div>
    <div style="text-align: center">Редактирование турнира</div>
    <div class="container" style="align-items: center; display: flex; flex-direction: column; justify-content: center;">

        <div style="display: flex; flex-direction: row;">
            <form action="{{ url('/') }}/adminTournaments/{{$tournament->id}}" method="POST">
                @csrf
                @method('patch')

                <div>
                    <p>Название турнира</p>
                    <input style="margin-top: 5px; width: 300px" name="name" type="text" value="{{$tournament->name}}">
                </div>

                <div>
                    <p>Тип турнира</p>
                    <select style="width: 300px" name="type">
                            <option value="Свободный"
                                    @if ($tournament->type == "Свободный")
                                    selected="selected"
                                @endif
                            >Свободный</option>

                            <option value="Круговой"
                                    @if ($tournament->type == "Круговой")
                                    selected="selected"
                                @endif
                            >Круговой</option>

                            <option value="Швейцарская система"
                                    @if ($tournament->type == "Швейцарская система")
                                    selected="selected"
                                @endif
                            >Швейцарская система</option>

                            <option value="Олимпийская система"
                                    @if ($tournament->type == "Олимпийская система")
                                    selected="selected"
                                @endif
                            >Олимпийская система</option>
                    </select>
                </div>

                <div style="margin-top: 1em;">
                    <button type="submit" class="button is-primary">Сохранить</button>
                </div>
            </form>

            <div style="margin-left: 3em;">
                <a href="{{ url('/') }}/adminGames/create">Добавить игру</a> <br />

                <a href="{{ url('/') }}/adminTournament/{{$tournament->id}}/editSchema">Редактировать схему</a>
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
                <th>Опции</th>
            </tr>
            @foreach($games as $game)
                <tr>
                    <td>{{$game->pl1Name}}</td>
                    <td>{{$game->player1RatingBefore}} / {{$game->player1RatingAfter}}</td>
                    <td>{{$game->pl2Name}}</td>
                    <td>{{$game->player2RatingBefore}} / {{$game->player2RatingAfter}}</td>
                    <td>{{$game->result == 1 ? "1:0" : (($game->result == 0) ? "1/2:1/2" : "0:1")}}</td>
                    <td>{{\Carbon\Carbon::parse($game->date)->format('d.m.Y H:i:s')}}</td>
                    <td>
                        <a href="{{ url('/') }}/adminGames/{{$game->id}}/edit">
                            Редактировать
                        </a>

                        @if($game->pgn != "")
                            <br />
                            <a href="{{ url('/') }}/Game/{{$game->id}}">Открыть PGN</a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
