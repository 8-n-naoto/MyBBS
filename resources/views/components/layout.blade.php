<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <title>ケーキ受注システム</title>
    <link rel="stylesheet" href="https://unpkg.com/destyle.css@1.0.5/destyle.css">
    <link rel="stylesheet" href="{{ url('css/style.css') }}">
</head>

<body>

    <header>
        <a href="{{ route('index') }}" class="">
            <h1 class="bigfont">サイト名</h1><a>
                <ul class=”menus”>
                    @if (Auth::user())
                        <li>管理者権限でログインされています</li>
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
    {{ $slot }}
    <footer>
        <ul class=”menus”>
            @if (Auth::user())
                <li>管理者権限でログインされています</li>
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
        <small>©このひとがつくりました？</small>
    </footer>

</body>

</html>
