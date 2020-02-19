@extends('layouts.master')

@section('title')
    Игрок
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <player
                    prefix="{{ url('/')}}"
                    :player="{{$player}}"
                    :player-games="{{json_encode($playerGames)}}"
                >
                </player>
            </div>
        </div>
    </div>
@endsection
