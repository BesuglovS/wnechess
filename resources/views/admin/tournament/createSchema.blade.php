@extends('layouts.master')

@section('title')
    Создать схему соревнования {{$tournament->name}}
@endsection

@section('content')
    <create-tournament-schema
        prefix="{{ url('/')}}"
        :tournament="{{$tournament}}"
        :players="{{json_encode($players)}}"
    >
    </create-tournament-schema>
@endsection
