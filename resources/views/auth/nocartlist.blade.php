@extends('components.frontlayout')

@section('title','カート')

@section('css')
    <link rel="stylesheet" href="{{ url('css/front.css') }}">
@endsection

@section('aside')
    @include('include.front-aside')
@endsection

@section('main')
<section class="textbackground form-font">
    <h2 class="topic-font">カート一覧</h2>
    <p>カートに商品がありません</p>
</section>
@endsection
