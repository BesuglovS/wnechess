@extends('layouts.master')

@section('title')
    Редактирование турнира
@endsection

@section('content')
    <div class="container alert alert-info alert-block"><a href="{{ url('/') }}/adminTournaments">Список турниров</a></div>
    <div style="text-align: center">Редактирование турнира</div>
    <div class="container" style="align-items: center; display: flex; justify-content: center;">

        <form action="{{ url('/') }}/adminTournaments/{{$tournament->id}}" method="POST">
            @csrf

            <input style="margin-top: 5px; width: 300px" name="name" type="text" value="{{$tournament->name}}">

            <button type="submit" class="button is-primary">Сохранить</button>
        </form>
    </div>
@endsection
