<div class="informations flex-row">
    <div class="textbackground section information">
        <h3 class="topic-font ">お知らせ</h3>
        @forelse ($informations as $information)
            <p class="form-font">
                投稿日：{{ $information->updated_at->format('Y年m月d日') }}
            </p>
            <a href="{{ route('front.information.store', $information) }}">
                <p class="form-font link">{{ $information->topic }}</p>
            </a>
        @empty
            <p>お知らせはまだありません</p>
        @endforelse
    </div>
    <div class="map">
        <h3 class="topic-font">アクセス</h3>
        <div>
            <div class="flex-row">
                <div>
                    <p class="map-font">住所</p>
                    <p>〒000-00000 ××xxxxx洲xxxxxx市xxxxx</p>
                    <p class="map-font">最寄り駅</p>
                    <p>○○駅徒歩〇分～</p>
                    <p class="map-font">TEL</p>
                    <p>000-0000-0000</p>
                    <p class="map-font">e-mail</p>
                    <p>xxxxxxxx@xxxxx.xx.xx.xx</p>
                </div>
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3380876.4535332923!2d140.02713179751572!3d44.254670670192354!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x5f1041412dc49731%3A0xfb573b8643d8fb31!2z5a6X6LC35bKs!5e0!3m2!1sja!2sjp!4v1702730271438!5m2!1sja!2sjp"
                    style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                    class="google-map">
                </iframe>

            </div>
        </div>
    </div>
</div>
