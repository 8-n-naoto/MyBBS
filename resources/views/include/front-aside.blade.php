<div class="conteiner">
    <aside>
        <div class="sidemenu">
            <a href="{{ route('index') }}">
                <h2 class="form-font">デコレーションケーキ</h2>
            </a>

            @forelse ($infos as $info)
                <a href="{{ route('front.cake', $info->id) }}">
                    <p class="form-font">{{ $info->cakename }}</p>
                </a>
            @empty
                <p class="form-font">ただいま準備中！</p>
            @endforelse
        </div>
        <div class="sidemenu">
            <a href="{{ route('user.favorite.store') }}">
                <p class="form-font">お気に入り一覧</p>
            </a>
        </div>
        <div class="sidemenu">
                <h2 class="form-font">タグ一覧</h2>
            @forelse ($tags as $tag)
                <a href="{{ route('front.tag', $tag) }}">
                    <p class="form-font">{{ $tag->tag }}</p>
                </a>
            @empty
                <p class="form-font">ただいま準備中！</p>
            @endforelse
        </div>
        <div class="sidemenu">
            <a href="{{ route('user.reservations.store') }}">
                <p class="form-font">予約情報確認</p>
            </a>
        </div>
        <div class="sidemenu">
            <a href="">
                <h2 class="form-font">最新情報</h2>
            </a>
            {{-- API利用して表示する --}}
        </div>
    </aside>
</div>
