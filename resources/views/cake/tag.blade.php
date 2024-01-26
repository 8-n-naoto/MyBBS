{{-- <?php dd($infos); ?> --}}

@extends('components.frontlayout')
@section('css')
    <link rel="stylesheet" href="{{ url('css/cakephotos.css') }}">
    <link rel="stylesheet" href="{{ url('css/font.css') }}">
    <link rel="stylesheet" href="{{ url('css/form.css') }}">
    <link rel="stylesheet" href="{{ url('css/aside.css') }}">
    <link rel="stylesheet" href="{{ url('css/instagram.css') }}">
@endsection

@section('js')
    <script src="{{ url('js/instagram.API.js') }}"></script>
@endsection

@section('aside')
    @include('include.front-aside')
@endsection

@section('main')
    <section>
        <h1 class="bigfont textbackground">タグ：{{$tag->tag}}一覧</h1>

        <div class="cakephotos">
            @forelse ($cakeinfo as $info)
                <object>
                    <a href="{{ route('front.cake', $info->cake_info->id) }}">
                        <p class="cakenamefont">
                            <img src="{{ asset($info->cake_info->mainphoto) }}" class="menuphotos" alt="ケーキの写真">
                            {{ e($info->cake_info->cakename) }}
                        </p>
                        {{-- お気に入りボタン --}}
                        @if (Auth::user())
                            <form method="POST" action="{{ route('user.favorite.add') }}">
                                @csrf
                                @isset($cakeinfos)
                                    <input type="hidden" name="cakeinfos_id" value="{{ $cakeinfos->id }}">
                                @endisset
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                <input type="hidden" name="cake_id" value="{{ $info->cake_info->id }}">
                                <button>お気に入り登録</button>
                            </form>
                        @endif
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
