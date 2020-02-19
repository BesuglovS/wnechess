@extends('layouts.master')

@section('title')
    Турниры
@endsection

@section('content')
    <div style="text-align: center">Список турниров</div>
    <div class="container" style="align-items: center; display: flex; justify-content: center;">
        <table style="margin: 10px" class="table td-center is-bordered">
            <tr style="text-align: center;">
                <th>Название турнира</th>
                <th>Тип турнира</th>
                <th>Количество игр</th>
                <th>Редактировать</th>
            </tr>
            @foreach($tournaments as $tournament)
                <tr>
                    <td>{{$tournament->name}}</td>
                    <td>{{$tournament->type}}</td>
                    <td>
                        {{$tournament->game_count}}
                    </td>
                    <td><a href="{{ url('/') }}/adminTournaments/{{$tournament->id}}/edit">Редактировать</a></td>
                </tr>
            @endforeach
        </table>
    </div>
    <div style="text-align: center">
        <a href="{{ url('/') }}/adminTournaments/create" class="button is-primary">Добавить турнир</a>
    </div>
@endsection
