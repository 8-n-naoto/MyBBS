<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <title>ケーキ受注システム</title>
    <link rel="stylesheet" href="https://unpkg.com/destyle.css@1.0.5/destyle.css">
    <link rel="stylesheet" href="{{ url('css/style.css') }}">
    <script src="https://yubinbango.github.io/yubinbango/yubinbango.js" charset="UTF-8"></script>

    <style>
        body{
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        body>main{
            flex: 1;
            background-color: rgba(255,255,255,0.7);
            background-blend-mode: lighten;
        }
    </style>

    @yield('css')
</head>

<body>
    @include('components.header')
    <main>
        @yield('main-content')
    </main>
    @include('components.footer')
</body>
</html>