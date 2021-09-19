<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ミニロト当選一覧</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('css/semantic.min.css') }}">
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
</head>
<body>
<div class="ui fixed inverted menu">
    <div class="ui container">
        <a href="{{route('miniloto.index')}}" class="header item title">
            <span class="menu-main-title">ミニロト当選一覧</span>
        </a>
    </div>
</div>
<div class="content ui container main-content">
    @yield('content')
</div>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
