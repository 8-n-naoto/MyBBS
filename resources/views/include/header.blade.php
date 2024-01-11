<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <title>ケーキ受注システム</title>
    <link rel="stylesheet" href="https://unpkg.com/destyle.css@1.0.5/destyle.css">
    <link rel="stylesheet" href="{{ url('css/style.css') }}">
    @yield('css')
    <script src="https://yubinbango.github.io/yubinbango/yubinbango.js" charset="UTF-8"></script>
</head>

<body>
    <header>
        <a href="{{ route('index') }}" class="">
            <h1 class="bigfont">サイト名</h1><a>
                <ul class=”menus”>
                    @if (Auth::user())
                        <li>ログインされています</li>
                        <li class="">
                            <a href="{{ route('admin.login') }}">管理者としてログイン</a>
                        </li>
                        <li class="">
                            <a href="{{ route('management') }}">管理画面へ</a>
                        </li>
                        <li>
                            <form method="POST" action="/logout">
                                @csrf
                                <button>ログアウト</button>
                            </form>
                        </li>
                    @else
                        <li class="">
                            <a href="{{ route('register') }}"> ログイン登録</a>
                        </li>
                        <li class="">
                            <a href="{{ route('login') }}"> ログイン</a>
                        </li>
                    @endif
                </ul>
    </header>
