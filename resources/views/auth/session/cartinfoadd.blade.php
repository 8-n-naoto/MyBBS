@extends('components.frontlayout')

@section('css')
    <link rel="stylesheet" href="{{ url('css/font.css') }}">
    <link rel="stylesheet" href="{{ url('css/form.css') }}">
    <link rel="stylesheet" href="{{ url('css/aside.css') }}">
    <link rel="stylesheet" href="{{ url('css/cakephotos.css') }}">
@endsection

@section('aside')
    @include('include.front-aside')
@endsection

@section('main')
    <form method="POST" action="{{ route('user.session.cart.add') }}" class="flex-culomn textbackground">
        @csrf
        @foreach ($cakeinfos as $cakeinfo)
            <input type="hidden" name="cake_info_id" value="{{ $cakeinfo->id }}">
            <input type="hidden" name="mainphoto" value="{{ $cakeinfo->mainphoto }}">
            <input type="hidden" name="cakename" value="{{ $cakeinfo->cakename }}">
            <a href="{{ route('front.cake', $cakeinfo->id) }}">
                <img src="{{ asset($cakeinfo->mainphoto) }}" class="mainphoto">
            </a>
            <p>商品名：{{ $cakeinfo->cakename }}</p>
        @endforeach
        @foreach ($cakeinfosubs as $cakeinfosub)
            <input type="hidden" name="cake_info_sub_id" value="{{ $cakeinfosub->id }}">
            <input type="hidden" name="capacity" value="{{ $cakeinfosub->capacity }}">
            <input type="hidden" name="price" value="{{ $cakeinfosub->price }}">
            <p>内容量：{{ $cakeinfosub->capacity }}</p>
            <p>価格：{{ $cakeinfosub->price }}</p>
        @endforeach
        <input type="date" name="birthday">
        <input type="time" name="time">
        <textarea name="message" cols="30" rows="5" placeholder="メッセージを記入してください"></textarea>
        <button>カートに情報を保存する</button>
    </form>
@endsection
