@extends('layouts.master')

@section('title')
    Пересчитать рейтинг
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <recalculate-rating></recalculate-rating>
            </div>
        </div>
    </div>
@endsection
