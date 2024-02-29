{{-- <?php dd($sliders); ?> --}}
@extends('components.frontlayout')

@section('title', 'ホーム')

@section('css')
    <link rel="stylesheet" href="{{ url('css/front.css') }}">
@endsection

@section('js')
    <script src="{{ url('js/slider.js') }}"></script>
    {{-- <script src="{{ url('js/instagram.API.js') }}"></script> --}}
    <script>
        (function($) {
            $.ajax({ // jQueryのajaxでjsonデータを取得しますね
                type: 'GET',
                // url: 'https://graph.facebook.com/v13.0/「InstagramビジネスID」?access_token=「アクセスTOKEN」&fields=name,media{caption,like_count,media_url,permalink,timestamp,username}', //本家用
                url: "{{route('API')}}", //開発環境用
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    var insta = response.media;
                    for (var i = 0; i < 8; i++) {
                        let url = insta[i].media_url; // 動画ソースのURLを取得
                        let href = insta[i].permalink; // リンク先URLを取得
                        let caption = insta[i].caption; //投稿のキャプションを取得(使わないので消すかもしれない)
                        let like = insta[i].like_count; //いいね！数の取得
                        // if (url.indexOf('.mp4') <= 0) { // 動画は除外 .mp4以外を<li>タグで描画します
                        $('.insta_list').append(`
                        <object class="gallery">
                            <a href="${href}" target="qoo_insta">
                                <img src="${url}" alt="${caption}" class="APIphoto">
                                <p>${caption}</p>
                                <p><span>${like}</span> Likes!!</p>
                            </a>
                        </object>
              `);
                    }
                }
            });
        })(jQuery);
        (function($) {
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
                        "cakeinfos_id": cakeinfos_id,
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
                    console.log(cakeinfos_id);

                });
            });
        })(jQuery);
    </script>

@endsection

@section('aside')
    @include('include.front-aside')
@endsection

@section('main')
    @if ($sliderscount !== 0)
        <div class="main-content">
            <h2 class="topic-font">イチオシ商品</h2>
        </div>
        @include('include.slider')
    @endif

    <div class="main-content">
        <h1 class="topic-font">デコレーションケーキ</h1>
        @include('include.cakes')
    </div>

    <div class="about-me section main-content">
        <h2 class="about-me-main-font">お店の紹介</h2>
        <p class="about-me-font">当店は○○○○○○○○で</p>
        <p class="about-me-font">○○○○○○○○</p>
        <p class="about-me-font">○○○○なお店です</p>
    </div>
    {{-- instagramAPI --}}
    <div class="section main-content">
        <h3 class="topic-font">最新情報一覧</h3>
        <div class="cakephotos insta_list"></div>
    </div>

    @include('include.google-map')


@endsection
