@extends('layouts.master')

@section('title')
    Игроки
@endsection

@section('content')
    <div style="text-align: center">Список игроков</div>
    <div class="container" style="align-items: center; display: flex; justify-content: center;">
        <table style="margin: 10px" class="table td-center is-bordered">
            <tr>
                <th>Имя</th>
                <th>Группа</th>
                <th>Рейтинг</th>
                <th># игр</th>
                <th>Результаты</th>
                <th>Средний рейтинг оппонента</th>
            </tr>
            @foreach($players as $player)
                <tr>
                    <td><a href="{{ url('/') }}/Player/{{$player->id}}">{{$player->name}}</a></td>
                    <td>{{$player->group}}</td>
                    <td>{{$player->rating}}</td>
                    <td>{{$player->gamesPlayed}}</td>
                    <td>{{$player->wins}}/{{$player->draws}}/{{$player->losses}}</td>
                    <td>{{$player->averageOpponentRating}}</td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
