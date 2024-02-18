{{-- <?php dd($infos); ?> --}}
@extends('components.frontlayout')

@section('title','お気に入り商品')

@section('css')
    <link rel="stylesheet" href="{{ url('css/cakephotos.css') }}">
    <link rel="stylesheet" href="{{ url('css/font.css') }}">
    <link rel="stylesheet" href="{{ url('css/form.css') }}">
    <link rel="stylesheet" href="{{ url('css/aside.css') }}">
    <link rel="stylesheet" href="{{ url('css/instagram.css') }}">
@endsection

@section('aside')
    @include('include.front-aside')
@endsection

@section('main')
    <section>
        <h1 class="bigfont textbackground">お気に入り一覧</h1>
        <div class="cakephotos">
            @forelse ($favorites as $info)
                <object>
                    <a href="{{ route('front.cake', $info->cake_id) }}">
                        <p class="cakenamefont">
                            <img src="{{ asset($info->cake_info->mainphoto) }}" class="menuphotos" alt="ケーキの写真">
                            {{ e($info->cake_info->cakename) }}
                        </p>
                    </a>
                    <form method="POST" action="{{ route('user.favorite.destroy', $info) }}" class="delete">
                        @method('DELETE')
                        @csrf
                        <button>削除する</button>
                    </form>
                </object>
            @empty
                <p>中身がありません</p>
            @endforelse
        </div>
    </section>
@endsection

@section('js')
    <script src="{{ url('js/button.js') }}"></script>
@endsection
