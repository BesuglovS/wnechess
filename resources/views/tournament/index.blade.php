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
            </tr>
            @foreach($tournaments as $tournament)
                <tr>
                    <td>{{$tournament->name}}</td>
                </tr>
            @endforeach
        </table>
    </div>

@endsection
