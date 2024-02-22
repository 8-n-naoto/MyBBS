{{-- <?php dd($infos); ?> --}}
@extends('components.frontlayout')

@section('title', 'タグを含む商品')

@section('css')
    <link rel="stylesheet" href="{{ url('css/front.css') }}">
@endsection

@section('js')
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
    {{-- <script src="{{ url('js/favoritebutton.js') }}"></script> --}}
@endsection

@section('aside')
    @include('include.front-aside')
@endsection

@section('main')
    <section>
        <h1 class="bigfont textbackground">タグ：{{ $tag->tag }}一覧</h1>

        <div class="cakephotos">
            @forelse ($cakeinfo as $info)
                <object class="gallery">
                    <a href="{{ route('front.cake', $info->cake_info->id) }}">
                        <p class="cakenamefont">
                            <img src="{{ asset($info->cake_info->mainphoto) }}" class="menuphotos" alt="ケーキの写真">
                            {{ e($info->cake_info->cakename) }}
                        </p>
                        {{-- お気に入りボタン --}}
                        @include('include.favoritebutton')
                    </a>
                </object>
            @empty
                <p>ただいま準備中！</p>
            @endforelse
        </div>

    </section>

    {{-- instagramAPI --}}
    <h3 class="middlefont textbackground">最新情報一覧</h3>
    <ul class="insta_list"></ul>

    @include('include.google-map')

@endsection
