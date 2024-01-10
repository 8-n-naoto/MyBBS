<header>
    <a href="{{ route('index') }}" class="">
        <h1 class="bigfont">サイト名(マルチログイン機能が出来次第ログイン機能を変更します)編集テスト</h1>
    </a>
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