@extends('components.frontlayout')

@section('css')
    <link rel="stylesheet" href="{{ url('css/font.css') }}">
    <link rel="stylesheet" href="{{ url('css/form.css') }}">
    <link rel="stylesheet" href="{{ url('css/aside.css') }}">
    <link rel="stylesheet" href="{{ url('css/cakephotos.css') }}">
@endsection

@section('aside')
    @include('include.front-aside')
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
                    <h3 class="form-font">サイズ一覧</h3>
                    @forelse ($cakeinfos->cake_info_subs as $info)
                        <div class="flex-row">
                            <p class="form-font">サイズ：</p>
                            <p class="form-font">{{ $info->capacity }}</p>
                            <p class="form-font">￥{{ $info->price }}円</p>
                            {{-- カートに追加する --}}
                            <form method="POST" action="{{ route('user.cart.add') }}">
                                @csrf
                                <input type="hidden" name="cakeinfos_id" value="{{ $cakeinfos->id }}">
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                <input type="hidden" name="cake_info_subs_id" value="{{ $info->id }}">
                                <button>カートに追加する(リレーション用)</button>
                            </form>
                            <form method="POST" action="{{ route('user.session.cart.reservation') }}">
                                @csrf
                                <input type="hidden" name="cake_info_id" value="{{ $cakeinfos->id }}">
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                <input type="hidden" name="cake_info_sub_id" value="{{ $info->id }}">
                                <button>カートに追加する(セッション用)</button>
                            </form>


                        </div>
                    @empty
                        <p class="form-font">ただいま準備中...</p>
                    @endforelse
                    <div class="flex-row">
                        <p class="form-font">お気に入り数</p>
                        <p class="form-font">{{ $count }}件</p>
                        @include('include.favoritebutton')
                    </div>
                    @isset($cakeinfos->cake_info_subs)
                        <a href="{{ route('front.form', $cakeinfos) }}">
                            <p class="button">購入へ</p>
                        </a>
                    @endisset
                    <div>
                        @if ($cakeinfos->topic)
                        <div class="flex-row">
                            <h3 class="form-font">商品説明：</h3>
                            <h3 class="form-font">{{ $cakeinfos->topic }}</h3>
                        </div>
                        @endif
                        <p class="smallfont">{{ $cakeinfos->explain }}</p>
                        <div class="flex-row">
                            @forelse ($caketags as $tag)
                                <a href="{{ route('front.tag', $tag) }}">
                                    <p class="form-font">{{ $tag->tag }}</p>
                                </a>
                            @empty
                            @endforelse
                        </div>
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
