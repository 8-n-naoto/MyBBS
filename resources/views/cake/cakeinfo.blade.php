    {{-- <?php dd($info); ?> --}}
    <x-layout>

        <main class="">
            <!-- 画面上側 -->
            <section class="">
                <h2 class="middlefont">{{ $info->cakename }}</h2>
                <div class="maininfo">
                    <div class="flex-row">
                        <img src="{{ asset($info->mainphoto) }}" class="mainphoto" alt="" width="240px">

                        <div class="textbackground">
                            @forelse ($prices as $price)
                                <a href="{{route('form',$info)}}" class="flex-row">
                                    <p>サイズ：{{ $price->capasity }}</p>
                                    <p>￥{{ $price->price }}円</p>
                                    <p class="button">購入へ</p>
                                </a>
                            @empty
                                <p>ただいま準備中...</p>
                            @endforelse

                        </div>
                    </div>
                </div>
                <!-- 画面下側 -->

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

            <div class="textbackground">
                <p>住所</p>
                <p>最寄り駅</p>
                <p>電話番号</p>
                <p>API連携でgoogleマップ出す。出す必要はあるのか、どうせなら住所が出てほしいところである。。</p>
            </div>
        </main>

    </x-layout>
