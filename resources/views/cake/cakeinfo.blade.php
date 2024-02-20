@extends('components.frontlayout')

@section('title', '商品詳細画面')

@section('css')
    <link rel="stylesheet" href="{{ url('css/front.css') }}">
@endsection

@section('aside')
    @include('include.front-aside')
@endsection

@section('js')
    <script src="{{ url('js/arrow-slider.js') }}"></script>
    <script src="{{ url('js/favoriteButton.js') }}"></script>
@endsection

@section('main')
    <!-- 画面上側 -->
    {{-- メイン情報 --}}
    <div class="maininfo flex-row">
        {{-- ケーキの写真 --}}
        <div>
            <div class="slider-container">
                <div class="arrow-slide">
                    <img src="{{ asset($cakeinfos->mainphoto) }}" class="mainphoto slider-photo">
                </div>
                @foreach ($subphotos->cake_photos as $info)
                    <div class="arrow-slide">
                        <img src="{{ asset($info->subphotos) }}" alt="商品画像" class="mainphoto slider-photo">
                    </div>
                @endforeach
                <button class="arrow prev" onclick="switchSlide(-1)">＜</button>
                <button class="arrow next" onclick="switchSlide(1)">＞</button>
            </div>
        </div>

        {{-- 説明など --}}
        <div class="textbackground">
            <h2 class="topic-font">{{ $cakeinfos->cakename }}</h2>
            @if ($cakeinfos->topic)
                <div class="flex-row">
                    <h3 class="form-font items">商品説明</h3>
                    <p class="form-ront">：</p>
                    <h3 class="form-font items">{{ $cakeinfos->topic }}</h3>
                </div>
            @endif
            <p class="smallfont">{{ $cakeinfos->explain }}</p>
            <div class="flex-row tag-area">
                @forelse ($caketags as $tag)
                    <a href="{{ route('front.tag', $tag) }}">
                        <p class="tag">{{ $tag->tag }}</p>
                    </a>
                @empty
                @endforelse
            </div>
            <p class="form-font items">取り扱い商品一覧</p>
            <div class="flex-column">
                @forelse ($cakeinfos->cake_info_subs as $info)
                    <div class="flex-row">
                        <p class="form-font items">大きさ：{{ $info->capacity }}</p>
                        <p class="form-font items">価格：￥{{ $info->price }}円</p>
                        {{-- カートに追加する --}}
                        <form method="POST" action="{{ route('user.cart.add') }}">
                            @csrf
                            <input type="hidden" name="cakeinfos_id" value="{{ $cakeinfos->id }}">
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            <input type="hidden" name="cake_info_subs_id" value="{{ $info->id }}">
                            <button class="cart">購入relation</button>
                        </form>
                        <form method="GET" action="{{ route('user.session.cart.reservation') }}">
                            @csrf
                            <input type="hidden" name="cake_info_id" value="{{ $cakeinfos->id }}">
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            <input type="hidden" name="cake_info_sub_id" value="{{ $info->id }}">
                            <button class="cart">購入session</button>
                        </form>
                    </div>
                @empty
                    <p class="form-font">ただいま準備中...</p>
                @endforelse
            </div>
            <div class="flex-row">
                <p class="form-font items">お気に入り数：{{ $count }}件</p>
                @include('include.favoritebutton')
                @isset($cakeinfos->cake_info_subs)
                    <a href="{{ route('front.form', $cakeinfos) }}">
                        <p class="cart">購入へ</p>
                    </a>
                @endisset
            </div>
        </div>
    </div>

    <!-- ギャラリー -->
    <h3 class="topic-font">gallery</h3>
    <div class="cakephotos">
        @forelse ($subphotos->cake_photos as $info)
            <object class="gallery">
                <img src=" {{ asset($info->subphotos) }}" class="menuphotos">
                <p class="cakenamefont">{{ $info->photoname }}</p>
            </object>
        @empty
            <p>現在準備中です...</p>
        @endforelse
    </div>

    <!-- ほかの写真たち -->
    <h3 class="topic-font ">デコレーションケーキ一覧</h3>
    @include('include.cakes')

    @include('include.google-map')

    <script>
        $('.favorite').on('click', function(e) {
            e.preventDefault();
            var user_id = $(this).siblings('#favorite [name="user_id"]').val();
            var cake_id = $(this).siblings('#favorite [name="cake_id"]').val();
            var cakeinfos_id = $(this).siblings('#favorite [name="cakeinfos_id"]').val();
            $.ajax({
                url: "{{ route('user.favorite.add') }}",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content'),
                },
                method: "POST",
                data: {
                    "user_id": user_id,
                    "cake_id": cake_id,
                },
                // dataType: "",
            }).done(function(res) {
                console.log('通信成功');
            }).fail(function() {
                console.log('通信失敗');
                alert('通信失敗');
            }).always(function(data) {
                console.log('実行しました');
                console.log(user_id);
                console.log(cake_id);

            });
        });
    </script>
@endsection
