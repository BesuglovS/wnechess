@extends('layouts.master')

@section('title')
    Новый турнир
@endsection

@section('content')
    <div class="container alert alert-info alert-block"><a href="{{ url('/') }}/adminTournaments">Список турниров</a></div>
    <div style="text-align: center">Новый турнир</div>
    <div class="container" style="align-items: center; display: flex; justify-content: center;">

        <form action="{{ url('/') }}/adminTournaments" method="POST">
            @csrf

            <input style="margin-top: 5px; width: 300px" name="name" placeholder="Название турнира" type="text" >

            <button type="submit" class="button is-primary">Создать</button>
        </form>
    </div>
@endsection
