<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>ロト予想</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('css/semantic.min.css') }}">
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
</head>
<body>
<div class="ui fixed inverted menu">
    <div class="ui container">
        <a href="{{route('welcome')}}" class="header item title">
            <span class="menu-main-title">ロト予想</span>
        </a>
        <div class="ui simple dropdown item">
            ミニロト
            <i class="dropdown icon"></i>
            <div class="menu">
                <a class="item" href="{{route('miniloto.index')}}">結果</a>
                <a class="item" href="{{route('miniloto.collation')}}">最新の結果と予想の照合</a>
            </div>
        </div>
        <div class="ui simple dropdown item">
            ロト6
            <i class="dropdown icon"></i>
            <div class="menu">
                <a class="item" href="">結果</a>
                <a class="item" href="">最新の結果と予想の照合</a>
            </div>
        </div>
        <div class="ui simple dropdown item">
            ロト7
            <i class="dropdown icon"></i>
            <div class="menu">
                <a class="item" href="">結果</a>
                <a class="item" href="">最新の結果と予想の照合</a>
            </div>
        </div>
    </div>
</div>
<div class="content ui container main-content">
    @yield('content')
</div>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
