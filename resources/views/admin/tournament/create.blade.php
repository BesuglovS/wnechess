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

            <div>
                <p>Тип турнира</p>
                <select style="width: 300px" name="type">
                    <option value="Свободный">Свободный</option>
                    <option value="Круговой">Круговой</option>
                    <option value="Швейцарская система">Швейцарская система</option>
                    <option value="Олимпийская система">Олимпийская система</option>
                </select>
            </div>

            <button type="submit" style="margin-top: 1em;" class="button is-primary">Создать</button>
        </form>
    </div>
@endsection
