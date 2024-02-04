{{-- <?php dd($tags); ?> --}}

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

@endsection
