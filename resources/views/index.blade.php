{{-- <?php dd($info); ?> --}}

@extends('components.frontlayout')
@section('css')
    <link rel="stylesheet" href="{{ url('css/cakephotos.css') }}">
    <link rel="stylesheet" href="{{ url('css/font.css') }}">
    <link rel="stylesheet" href="{{ url('css/form.css') }}">
    <link rel="stylesheet" href="{{ url('css/aside.css') }}">
    <link rel="stylesheet" href="{{ url('css/instagram.css') }}">
@endsection

@section('head-js')
    {{-- <script src="{{ url('js/instagram.API.js') }}"></script> --}}
@endsection

@section('js')
    <script src="{{ url('js/slider.js') }}"></script>
@endsection

@section('aside')
    @include('include.front-aside')
@endsection

@section('main')
    <div>
        <h2 class="bigfont textbackground">イチオシ商品</h2>
    </div>
    @include('include.slider')
    <div>
        <h1 class="bigfont textbackground">デコレーションケーキ</h1>
        @include('include.cakes')
    </div>

    <div class="about-me section">
        <h2 class="about-me-main-font">お店の紹介</h2>
        <p class="about-me-font">当店は○○○○○○○○で</p>
        <p class="about-me-font">○○○○○○○○</p>
        <p class="about-me-font">○○○○なお店です</p>
    </div>
    {{-- instagramAPI --}}
    <div class="section">
        <h3 class="bigfont textbackground">最新情報一覧</h3>
        <ul class="insta_list"></ul>
    </div>

    @include('include.google-map')

    <script>
        $('.favorite').on('click', function(e) {
            var elm=$(this);
            e.preventDefault();
            $.ajax({
                url: "{{ route('user.favorite.add') }}",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content'),
                },
                method: "POST",
                data: {
                    "user_id": $('#favorite [name="user_id"]').val(),
                    "cake_id": $('#favorite [name="cake_id"]').val(),
                    "cakeinfos_id": $('#favorite [name="cakeinfos_id"]').val(),
                },
                // dataType: "",
            }).done(function(res) {
                console.log('通信成功');
            }).fail(function() {
                console.log('通信失敗');
                alert('通信失敗');
            }).always(function(data) {
                console.log('実行しました');
                console.log($('#favorite [name="user_id"]').val());
                console.log($('#favorite [name="cake_id"]').val());
                console.log(elm.nextUntil('#favorite [name="cake_id"]'));

            });
        });
    </script>
@endsection
