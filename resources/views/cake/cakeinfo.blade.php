    {{-- <?php dd($info); ?> --}}
    @extends('components.frontlayout')

    @section('main')
        <section class="">
            <!-- 画面上側 -->
            <section class="">
                <h2 class="middlefont">{{ $cakeinfos->cakename }}</h2>
                <div class="maininfo">
                    <div class="flex-row">
                        <img src="{{ asset($cakeinfos->mainphoto) }}" class="mainphoto">

                        <div class="textbackground">
                            <h3>サイズ一覧</h3>
                            @forelse ($cakeinfos->cake_info_subs as $info)
                                <a href="{{ route('cake.form', $cakeinfos) }}" class="flex-row">
                                    <p>サイズ：{{ $info->capacity }}</p>
                                    <p>￥{{ $info->price }}円</p>
                                    <p class="button">購入へ</p>
                                </a>
                            @empty
                                <p>ただいま準備中...</p>
                            @endforelse
                            <div>
                                <h3>{{ $cakeinfos->topic }}</h3>
                            </div>
                            <div>
                                <h3>商品説明</h3>
                                <p>{{ $cakeinfos->explain }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- 画面下側 -->
                <div class="gallery">
                    @forelse ($subphotos->cake_photos as $info)
                        <object>
                            <img src=" {{ asset($info->subphotos) }}" class="subphoto">
                            <p>{{ $info->photoname }}</p>
                            <input type="hidden" id="subphoto" value="{{ $info }}">
                        </object>
                    @empty
                        <p>現在準備中です...</p>
                    @endforelse

                </div>
            </section>



            <!-- ほかの写真たち -->
            <h3 class="middlefont">デコレーションケーキ一覧</h3>
            @include('include.cakes')
        </section>

        @include('include.google-map')
    @endsection
