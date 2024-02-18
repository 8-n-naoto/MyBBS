@extends('components.frontlayout')

@section('title','商品詳細画面')

@section('css')
    <link rel="stylesheet" href="{{ url('css/font.css') }}">
    <link rel="stylesheet" href="{{ url('css/form.css') }}">
    <link rel="stylesheet" href="{{ url('css/aside.css') }}">
    <link rel="stylesheet" href="{{ url('css/cakephotos.css') }}">
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
                    {{-- <img src="image1.jpg" alt="画像1"> --}}
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
            <h2 class="bigfont">{{ $cakeinfos->cakename }}</h2>
            @if ($cakeinfos->topic)
                <div class="flex-row">
                    <h3 class="form-font">商品説明：</h3>
                    <h3 class="form-font">{{ $cakeinfos->topic }}</h3>
                </div>
            @endif
            <p class="smallfont" style="white-space:pre-wrap;">{{ $cakeinfos->explain }}</p>
            <div class="flex-row">
                @forelse ($caketags as $tag)
                    <a href="{{ route('front.tag', $tag) }}">
                        <p class="tag">{{ $tag->tag }}</p>
                    </a>
                @empty
                @endforelse
            </div>
            <p class="form-font">大きさ一覧</p>
            @forelse ($cakeinfos->cake_info_subs as $info)
                <div class="flex-row">
                    <p class="form-font">{{ $info->capacity }}</p>
                    <p class="form-font">￥{{ $info->price }}円</p>
                    {{-- カートに追加する --}}
                    <form method="POST" action="{{ route('user.cart.add') }}">
                        @csrf
                        <input type="hidden" name="cakeinfos_id" value="{{ $cakeinfos->id }}">
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        <input type="hidden" name="cake_info_subs_id" value="{{ $info->id }}">
                        <button class="cart">カートに追加する(リレーション用)</button>
                    </form>
                    <form method="GET" action="{{ route('user.session.cart.reservation') }}">
                        @csrf
                        <input type="hidden" name="cake_info_id" value="{{ $cakeinfos->id }}">
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        <input type="hidden" name="cake_info_sub_id" value="{{ $info->id }}">
                        <button class="cart">カートに追加する(セッション用)</button>
                    </form>


                </div>
            @empty
                <p class="form-font">ただいま準備中...</p>
            @endforelse
            <div class="flex-row">
                <p class="form-font">お気に入り数</p>
                <p class="form-font">{{ $count }}件</p>
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
    <h3 class="form-font textbackground">gallery</h3>
    <div class="gallery">
        @forelse ($subphotos->cake_photos as $info)
            <object>
                <img src=" {{ asset($info->subphotos) }}" class="subphoto">
                <p class="form-font textbackground">{{ $info->photoname }}</p>
            </object>
        @empty
            <p>現在準備中です...</p>
        @endforelse

    </div>

    <!-- ほかの写真たち -->
    <h3 class="bigfont textbackground">デコレーションケーキ一覧</h3>
    @include('include.cakes')

    @include('include.google-map')

    <script>
        $('.favorite').on('click', function(e) {
            e.preventDefault();
            var user_id=$(this).siblings('#favorite [name="user_id"]').val();
            var cake_id=$(this).siblings('#favorite [name="cake_id"]').val();
            var cakeinfos_id=$(this).siblings('#favorite [name="cakeinfos_id"]').val();
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
