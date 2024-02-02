<div class="conteiner">
    <main class="flex-row">
        <div>

    <aside>
        <div class="sidemenu">
            <a href="{{ route('management') }}">
                <h2 class="aside-font link">管理画面</h2>
            </a>
        </div>

        <div class="sidemenu">
            <p class="aside-font">商品別予約一覧</p>
            <ul name="ケーキの種類">
                @forelse ($cakeinfos as $info)
                    <li class="asidemanu-font link">
                        <a href="{{ route('reservations.count.store', $info) }}">
                            <p class="asidemenu-font link">{{ $info->cakename }}</p>
                        </a>
                    </li>
                @empty
                    <li class="aside-font">準備中だよ！</li>
                @endforelse
            </ul>
        </div>

        <div class="sidemenu">
            <a href="{{ route('reservations.date.store') }}">
                <p class="aside-font link">日付別予約商品</p>
            </a>
        </div>

        <div class="sidemenu">
            <a href="{{ route('reservations.information.store') }}">
                <p class="aside-font link">予約情報検索</p>
            </a>
        </div>

        <div class="sidemenu">
            <a href="{{ route('cakes.switch') }}">
                <p class="aside-font link">表示商品編集</p>
            </a>
            <ul name="ケーキの種類">
                @forelse ($cakeinfos as $info)
                    <li>
                        <a href="{{ route('cakes.upudate.store', $info) }}">
                            <p class="asidemenu-font link">{{ $info->cakename }}</p>
                        </a>
                    </li>
                @empty
                    <li class="aside-font">準備中だよ！</li>
                @endforelse
                <li>
                    <a href="{{ route('cakes.criate.store') }}">
                        <p class="asidemenu-font link">新規追加</p>
                    </a>
                </li>
            </ul>
        </div>
        <div class="sidemenu">
            <a href="{{ route('information.edits.store') }}">
                <p class="aside-font link">お知らせ一覧</p>
            </a>
            <a href="{{route('information.criate.store')}}">
                <p class="asidemenu-font link">新規追加</p>
            </a>
        </div>
        <div>
            <form method="POST" action="{{ route('admin.destroy') }}">
                @csrf
                <button class="aside-font link">管理者ログアウト</button>
            </form>
        </div>
    </aside>
        </div>
        @yield('main')
    </main>
</div>
{{-- 文字が折り返し表示されないにしたい --}}
