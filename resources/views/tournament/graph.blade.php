@extends('layouts.master')

@section('title')
    Дерево турнира {{$tournament->name}}
@endsection

@section('head')
    <style>
        .head-item {
            margin-right: 20px;
        }

        .head-item:last-child {
            margin-right: 0px;
        }

        .card-body {
            background-color: rgba(233,150,122,0.5);
        }
        .wrapper {
            display: flex;
            /*height: 1800px;*/
            justify-content: center;
        }
        .item {
            display: flex;
            flex-direction: row-reverse;
        }

        .item-parent {
            position: relative;
            margin-left: 50px;
            display: flex;
            align-items: center;
        }

        .item-parent > div.nodeBox, .item-child > div.nodeBox {
            padding: 5px;
            margin: 0;
            background-color: beige;
        }

        .item-parent.parent-with-children:after {
            position: absolute;
            content: '';
            width: 25px;
            height: 2px;
            left: 0;
            top: 50%;
            background-color: #fff;
            transform: translateX(-100%);
        }
        .item-childrens {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .item-child {
            display: flex;
            align-items: flex-start;
            justify-content: flex-end;
            margin-top: 10px;
            margin-bottom: 10px;
            position: relative;
        }
        .item-child:before {
            content: '';
            position: absolute;
            background-color: #fff;
            right: 0;
            top: 50%;
            transform: translateX(100%);
            width: 25px;
            height: 2px;
        }
        .item-child:after {
            content: '';
            position: absolute;
            background-color: #fff;
            right: -25px;
            height: calc(50% + 22px);
            width: 2px;
            top: 50%;
        }
        .item-child:last-child:after {
            transform: translateY(-100%);
        }
        .item-child:only-child:after {
            display: none;
        }
    </style>

@endsection

@section('content')
    <tournament-tree
        prefix="{{ url('/')}}"
        :tournament="{{$tournament}}"
        :tournament-nodes="{{json_encode($tournamentNodes)}}"
    >
    </tournament-tree>
@endsection
