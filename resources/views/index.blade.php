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
        <ul class="insta_list"></ul>
    </div>

    @include('include.google-map')


@endsection
