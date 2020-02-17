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
                <th>Количество игр</th>
            </tr>
            @foreach($tournaments as $tournament)
                <tr>
                    <td>
                        <a href="{{ url('/')}}/Tournament/{{$tournament->id}}">
                            {{$tournament->name}}
                        </a>
                    </td>
                    <td>
                        {{$tournament->game_count}}
                    </td>
                </tr>
            @endforeach
        </table>
    </div>

@endsection
