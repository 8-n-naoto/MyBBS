<x-layout>
    {{-- <?php dd($infos); ?> --}}

    <main>
        <h1 class="bigfont">デコレーションケーキ</h1>
        <div class="subinfo">
            @forelse ($infos as $info)
                <object>
                    <a href="{{ route('cake.cakeinfo', $info->id) }}">
                        <img src="{{ asset($info->mainphoto) }}" class="subphoto" alt="ケーキの写真">
                        <p class="smallfont">{{ e($info->cakename) }}</p>
                    </a>
                </object>
            @empty
                <p>ただいま準備中！</p>
            @endforelse

            {{-- @forelse ($infos as $info)
            <p class="textbackground">{{$info->subphotos}}</p>
            @empty
            @endforelse --}}

        </div>
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


        <div class="textbackground">
            <form class="h-adr">
                <span class="p-country-name" style="display:none;">Japan</span>
                <label class="flex-row">〒<input type="text" class="p-postal-code textbackground" size="3"
                        maxlength="3">-<input type="text" class="p-postal-code textbackground" size="4"
                        maxlength="4"></label><br>
                <label>
                    <span>都道府県</span>
                    <input type="text" class="p-region text background" readonly /><br>
                </label>
                <label>
                    <span>市町村区</span>
                    <input type="text" class="p-locality text background" readonly /><br>
                </label>
                <label>
                    <span>町域</span>
                    <input type="text" class="p-street-address textbackground" /><br>
                </label>
                <label>
                    <span>以降の住所</span>
                    <input type="text" class="p-extended-address textbackground" />
                </label>
            </form>
        </div>
    </main>

    {{-- @extends('components.google-map') --}}
</x-layout>
