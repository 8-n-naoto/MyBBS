@extends('components.frontlayout')
@section('css')
<link rel="stylesheet" href="{{ url('css/cakephotos.css') }}">
<link rel="stylesheet" href="{{ url('css/font.css') }}">
@endsection

@section('main')
    <section>
        <h1 class="bigfont textbackground">デコレーションケーキ</h1>
        @include('include.cakes')
    </section>

    {{-- instagramAPI --}}
    <h3>最新情報一覧</h3>
    <ul class="insta_list"></ul>

    @include('include.google-map')
@endsection
