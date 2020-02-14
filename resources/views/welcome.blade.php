@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card-deck mb-2">
                    <div class="card tac">
                        <div class="card-body">
                            <div class="card-body">
                                <a href="{{ url('/')}}/Players">Игроки</a>
                            </div>
                        </div>
                    </div>
                    <div class="card tac">
                        <div class="card-body">
                            <div class="card-body">
                                <a href="{{ url('/')}}/Games">Игры</a>
                            </div>
                        </div>
                    </div>
                    <div class="card tac">
                        <div class="card-body">
                            <div class="card-body">
                                <a href="{{ url('/')}}/Tournaments">Турниры</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-deck mb-2">
                    <div class="card tac">
                        <div class="card-body">
                            <div class="card-body">
                                <a href="{{ url('/')}}/admin">Административная панель</a>
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
