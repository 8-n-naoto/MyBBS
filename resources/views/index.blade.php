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
    <section>
        <h1 class="bigfont textbackground">デコレーションケーキ</h1>

        @include('include.cakes')
    </section>

    {{-- instagramAPI --}}
    <h3 class="middlefont textbackground">最新情報一覧</h3>
    <ul class="insta_list"></ul>

    @include('include.google-map')
@endsection
