<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://unpkg.com/destyle.css@1.0.5/destyle.css">
    {{-- <link href="{{ url('css/bootstrap.css') }}" rel="stylesheet"> --}}
    @yield('css')

    {{-- jquery --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.js"></script>

</head>

<body>
    <header>
        <a href="{{ route('index') }}">
            <h1 class="Dark underline display sitefont">ケーキ予約サイト</h1>
        </a>
    </header>
