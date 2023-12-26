    {{-- <?php dd($info); ?> --}}
    <x-layout>

        <main class="">
            <!-- 画面上側 -->
            <section class="">
                <h2 class="middlefont">{{ $info->cakename }}</h2>
                <div class="maininfo">
                    <div class="flex-row">
                        <img src="{{ asset($info->mainphoto) }}" class="mainphoto">

                        <div class="textbackground">
                            <h3>サイズ一覧</h3>
                            @forelse ($info->cake_info_subs as $info)
                                <a href="{{ route('form', $info) }}" class="flex-row">
                                    <p>サイズ：{{ $info->capacity }}</p>
                                    <p>￥{{ $info->price }}円</p>
                                    <p class="button">購入へ</p>
                                </a>
                            @empty
                                <p>ただいま準備中...</p>
                            @endforelse
                            <div>
                                <h3>{{ $info->topic }}</h3>
                            </div>
                            <div>
                                <h3>商品説明</h3>
                                <p>{{ $info->explain }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- 画面下側 -->
                <div class="gallery">
                    {{-- @forelse ($info->cake_photos as $info)
                        <object>
                            <img src=" {{ asset($info->subphotos) }}" class="subphoto">
                            <p>{{ $info->photoname }}</p>
                            <input type="hidden" id="subphoto" value="{{ $info }}">
                        </object>
                    @empty
                        <p>現在準備中です...</p>
                    @endforelse --}}

                </div>
            </section>



            <!-- ほかの写真たち -->
            <h3 class="middlefont">デコレーションケーキ一覧</h3>
            <div class="subinfo">
                @forelse ($subinfo as $info)
                    <object>
                        <a href="{{ route('cake.cakeinfo', $info->id) }}">
                            <img src="{{ asset($info->mainphoto) }}" class="subphoto" alt="ケーキの写真">
                            <p class="smallfont">{{ e($info->cakename) }}</p>
                        </a>
                    </object>
                @empty
                    <p>ただいま準備中！</p>
                @endforelse


            </div>
            {{-- <a href="/form/form" class="button"><button class="button">購入画面へ進む</button></a> --}}
            <div class="flex-row textbackground">
                <div>
                    <p>住所：〒098-6758 北海道稚内市宗谷岬３</p>
                    <p>TEL：000-0000-0000</p>
                    <p>e-mail：xxxxxxxx@xxxxx.xx.xx.xx</p>
                </div>
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3380876.4535332923!2d140.02713179751572!3d44.254670670192354!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x5f1041412dc49731%3A0xfb573b8643d8fb31!2z5a6X6LC35bKs!5e0!3m2!1sja!2sjp!4v1702730271438!5m2!1sja!2sjp"
                    width="400px" height="400px" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </main>

    </x-layout>
