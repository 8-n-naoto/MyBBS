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