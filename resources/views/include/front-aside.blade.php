<div class="conteiner">
    <aside>
        <div class="sidemenu">
            <a href="{{ route('index') }}">
                <h2 class="aside-font link">デコレーションケーキ</h2>
            </a>

            @forelse ($infos as $info)
                <a href="{{ route('front.cake', $info->id) }}">
                    <p class="asidemenu-font link items">{{ $info->cakename }}</p>
                </a>
            @empty
                <p class="asidemenu-font">ただいま準備中！</p>
            @endforelse
        </div>




        @if (Auth::user())
            <div class="sidemenu">
                <a href="{{ route('user.favorite.store') }}">
                    <h2 class="aside-font link">お気に入り一覧</h2>
                </a>
            </div>


            <div class="sidemenu">
                <a href="{{ route('user.reservations.store') }}">
                    <h2 class="aside-font link">予約情報確認</h2>
                </a>
            </div>


            <div class="sidemenu">
                <h2 class="aside-font">カート</h2>
                <a href="{{ route('user.cart.store') }}">
                    <p class="asidemenu-font link items">カートへ/relation</p>
                </a>
                <a href="{{ route('user.session.cart.store') }}">
                    <p class="asidemenu-font link items">カートへ/session</p>
                </a>
            </div>

            <div class="sidemenu">
                <h3 class="aside-font">タグ一覧</h3>
                <ul>
                    @forelse ($tags as $tag)
                        <li>
                            <a href="{{ route('front.tag', $tag) }}">
                                <p class="asidemenu-font link items">{{ $tag->tag }}</p>
                            </a>
                        </li>
                    @empty
                        <p class="asidemenu-font">ただいま準備中！</p>
                    @endforelse

                </ul>
            </div>

        @endif


        <div class="sidemenu">
            <h2 class="aside-font">最新情報</h2>
            <p>APIで取得した情報を表示する</p>
            {{-- API利用して表示する --}}
            <div class="sidemenu">
                <p class="aside-font">公式ＳＮＳ一覧</p>
                <a href="https://www.instagram.com/" class="flex-row">
                    <img src="{{ asset('img\S__9035785_0.jpg') }}" alt="instagram" width="18px" height="18px">
                    <p class="asidemenu-font link items">instagram</p>
                </a>
                <a href="https://www.twitter.com/" class="flex-row">
                    <img src="{{ asset('img\S__9035785_0.jpg') }}" alt="instagram" width="18px" height="18px">
                    <p class="asidemenu-font link items">X(旧twitter)</p>
                </a>
            </div>
        </div>


        @if (!Auth::user())
            <div class="sidemenu flex-row">
                <a href="{{ route('register') }}" class="form-font"> ログイン登録</a>
                <p> / </p>
                <a href="{{ route('login') }}" class="form-font"> ログイン</a>
            </div>
        @endif

        @if (Auth::user())
            <div class="sidemenu">
                <p class="asidemenu-font">ログインされています</p>
                <form method="POST" action="/logout">
                    @csrf
                    <button class="asidemenu-font link">ログアウト</button>
                </form>
            </div>
            <div class="flex-row">
                <a href="{{ route('admin.login') }}">管理者ログイン</a>
                <p>/</p>
                <a href="{{ route('management') }}">管理画面へ</a>
            </div>
        @endif

    </aside>
</div>
