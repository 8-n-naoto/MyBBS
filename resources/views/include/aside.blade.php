<div class="conteiner">
    <aside>
        <h2 class="textbackground"><a href="{{ route('management') }}">管理画面</a></h2>
        <div class="sidemenu">
            <p class="middlefont">商品別予約一覧</p>
            <ul name="ケーキの種類">
                @forelse ($cakeinfos as $info)
                    <li class="smallfont"><a href="{{ route('reservations.count.store', $info) }}">{{ $info->cakename }}</a></li>
                @empty
                    <li class="smallfont">準備中だよ！</li>
                @endforelse
            </ul>
        </div>
        <div class="sidemenu">
            <a href="{{ route('reservations.date.store') }}" class="middlefont">日付別予約商品</a>
        </div>
        <div class="sidemenu">
            <a href="{{ route('reservations.information.store') }}" class="middlefont">予約情報検索</a>
        </div>
        <div class="sidemenu">
            <a href="{{ route('cakes.switch') }}" class="middlefont">表示商品編集</a>
            <ul name="ケーキの種類">
                @forelse ($cakeinfos as $info)
                    <li class="smallfont"><a href="{{ route('cakes.store.update', $info) }}">{{ $info->cakename }}</a></li>
                @empty
                    <li class="smallfont">準備中だよ！</li>
                @endforelse
                <li class="smallfont"><a href="{{ route('cakes.store.criate') }}">新規追加</a></li>
            </ul>
        </div>
        <div>
            <form method="POST" action="{{route('admin.destroy')}}">
                @csrf
                <button>管理者ログアウト</button>
            </form>
        </div>
        <!-- 種類ごとに合計の予約数を出す。考え中 -->
    </aside>
    <main class="flex-row">
        @yield('main')
    </main>
</div>
{{-- 文字が折り返し表示されないにしたい --}}