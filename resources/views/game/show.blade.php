@extends('layouts.master')

@section('title')
    Игроки
@endsection

@section('head')
    <link rel="stylesheet" type="text/css" href="https://pgn.chessbase.com/CBReplay.css"/>
    <script src="https://pgn.chessbase.com/jquery-3.0.0.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/jqx.base.css') }}">
    <script src="{{ asset('js/jqxcore.js') }}"></script>
    <script src="{{ asset('js/jqxsplitter.js') }}"></script>
    <script src="https://pgn.chessbase.com/cbreplay.js" defer type="text/javascript"></script>
@endsection

@section('content')
    <div class="container" style="align-items: center; display: flex; flex-direction:column; justify-content: center;">
        <table style="margin: 10px" class="table td-center is-bordered">
            <tr style="text-align: center;">
                <th>Белые</th>
                <th>Рейтинг белых</th>
                <th>Чёрные</th>
                <th>Рейтинг чёрных</th>
                <th>Результат</th>
                <th>Дата</th>
                <th>Турнир</th>
            </tr>

            <tr>
                <td>{{$game->pl1Name}}</td>
                <td>{{$game->player1RatingBefore}} / {{$game->player1RatingAfter}}</td>
                <td>{{$game->pl2Name}}</td>
                <td>{{$game->player2RatingBefore}} / {{$game->player2RatingAfter}}</td>
                <td>{{$game->result == 1 ? "1:0" : (($game->result == 0) ? "1/2:1/2" : "0:1")}}</td>
                <td>{{\Carbon\Carbon::parse($game->date)->format('d.m.Y H:i:s')}}</td>
                <td>{{$game->tournamentName}}</td>
            </tr>
        </table>

        @if($game->pgn != "")
        <div class="cbreplay">
            {{$game->pgn}}
        </div>
        @endif
    </div>
@endsection
