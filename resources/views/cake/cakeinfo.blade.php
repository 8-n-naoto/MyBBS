@extends('components.frontlayout')

@section('css')
    <link rel="stylesheet" href="{{ url('css/font.css') }}">
    <link rel="stylesheet" href="{{ url('css/form.css') }}">
    <link rel="stylesheet" href="{{ url('css/cakephotos.css') }}">
@endsection

@section('main')
    <section class="">
        <!-- 画面上側 -->
        <section>
            {{-- メイン情報 --}}
            <h2 class="bigfont textbackground">{{ $cakeinfos->cakename }}</h2>
            <div class="maininfo flex-row">
                {{-- ケーキの写真 --}}
                <div>
                    <img src="{{ asset($cakeinfos->mainphoto) }}" class="mainphoto">
                </div>

                {{-- 説明など --}}
                <div class="textbackground">
                    <h3 class="middlefont">サイズ一覧</h3>
                    @forelse ($cakeinfos->cake_info_subs as $info)
                        <div class="flex-row">
                            <p class="smallfont">サイズ：</p>
                            <p class="smallfont">{{ $info->capacity }}</p>
                            <p class="smallfont">￥{{ $info->price }}円</p>
                        </div>
                    @empty
                        <p class="smallfont">ただいま準備中...</p>
                    @endforelse
                    <div class="flex-row">
                        <p>お気に入り数</p>
                        <p>{{ $count }}件</p>
                        @include('include.favoritebutton')
                    </div>
                    @isset($cakeinfos->cake_info_subs)
                        <a href="{{ route('front.form', $cakeinfos) }}">
                            <p class="smallfont button">購入へ</p>
                        </a>
                    @endisset
                    <div>
                        <div class="flex-row">
                            <h3 class="middlefont">商品説明</h3>
                            <h3 class="middlefont">{{ $cakeinfos->topic }}</h3>
                        </div>
                        <p class="smallfont">{{ $cakeinfos->explain }}</p>
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
        </section>

        <!-- ほかの写真たち -->
        <h3 class="bigfont textbackground">デコレーションケーキ一覧</h3>
        @include('include.cakes')
    </section>

    @include('include.google-map')
@endsection
