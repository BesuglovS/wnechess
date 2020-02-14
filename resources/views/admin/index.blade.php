@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card-deck mb-2">
                <div class="card tac">
                    <div class="card-body">
                        <div class="card-body">
                            <a href="{{ url('/') }}/adminPlayers">Игроки</a>
                        </div>
                    </div>
                </div>
                <div class="card tac">
                    <div class="card-body">
                        <div class="card-body">
                            <a href="{{ url('/') }}/adminGames">Игры</a>
                        </div>
                    </div>
                </div>
                <div class="card tac">
                    <div class="card-body">
                        <div class="card-body">
                            <a href="{{ url('/') }}/adminTournaments">Турниры</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-deck mb-2">
                <div class="card tac">
                    <div class="card-body">
                        <div class="card-body">
                            <a href="{{ url('/')}}/adminRecalculateRating">Пересчитать рейтинг</a>
                        </div>
                    </div>
                </div>
                <div class="card tac">
                    <div class="card-body">
                        <div class="card-body">
                            {{--                                <a href="/Games">Игры</a>--}}
                        </div>
                    </div>
                </div>
                <div class="card tac">
                    <div class="card-body">
                        <div class="card-body">
                            {{--                                <a href="/Tournaments">Турниры</a>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
