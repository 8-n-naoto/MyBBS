<div class="conteiner">
    <aside>
        <div class="sidemenu">
            <a href="{{ route('index') }}">
                <h2 class="aside-font">デコレーションケーキ</h2>
            </a>

            @forelse ($infos as $info)
                <a href="{{ route('front.cake', $info->id) }}">
                    <p class="asidemenu-font">{{ $info->cakename }}</p>
                </a>
            @empty
                <p class="aside-font">ただいま準備中！</p>
            @endforelse
        </div>
        <div class="sidemenu">
            <a href="{{ route('user.favorite.store') }}">
                <h2 class="aside-font">お気に入り一覧</h2>
            </a>
        </div>
        <div class="sidemenu">
                <h2 class="aside-font">タグ一覧</h2>
            @forelse ($tags as $tag)
                <a href="{{ route('front.tag', $tag) }}">
                    <p class="asidemenu-font">{{ $tag->tag }}</p>
                </a>
            @empty
                <p class="aside-font">ただいま準備中！</p>
            @endforelse
        </div>
        <div class="sidemenu">
            <a href="{{ route('user.reservations.store') }}">
                <h2 class="aside-font">予約情報確認</h2>
            </a>
        </div>
        <div class="sidemenu">
            <a href="">
                <h2 class="aside-font">最新情報</h2>
            </a>
            {{-- API利用して表示する --}}
        </div>
    </aside>
</div>
