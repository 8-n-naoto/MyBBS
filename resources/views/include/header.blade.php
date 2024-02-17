<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta  name="csrf-token" content="{{ csrf_token() }}">
    <title>ケーキ受注システム</title>
    <link rel="stylesheet" href="https://unpkg.com/destyle.css@1.0.5/destyle.css">
    <link rel="stylesheet" href="{{ url('css/main.css') }}">
    @yield('css')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    @yield('head-js')

</head>

<body>
    <header>
        <a href="{{ route('index') }}" class="">
            <h1 class="sitefont">ケーキ予約サイト</h1>
        </a>

    </header>
