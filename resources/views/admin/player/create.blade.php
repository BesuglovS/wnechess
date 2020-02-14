@extends('layouts.master')

@section('title')
    Новый игрок
@endsection

@section('content')
    <div class="container alert alert-info alert-block"><a href="{{ url('/') }}/adminPlayers">Список игроков</a></div>
    <div style="text-align: center">Новый игрок</div>
    <div class="container" style="align-items: center; display: flex; justify-content: center;">

        <form action="{{ url('/') }}/adminPlayers" method="POST">
            @csrf

            <input style="margin-top: 5px; width: 300px" name="name" placeholder="ФИО" type="text" >

            <input style="margin-top: 5px; width: 300px" name="group" placeholder="Группа" type="text" >

            <button type="submit" class="button is-primary">Создать</button>
        </form>

        <span style="margin-left: 20px">
            <a href="{{ url('/') }}/adminPlayers" class="button is-danger">Отмена</a>
        </span>
    </div>
@endsection
