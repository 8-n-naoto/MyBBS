@extends('components.frontlayout')

@section('title','カート情報保存（relation）')

@section('css')
    <link rel="stylesheet" href="{{ url('css/front.css') }}">
@endsection

@section('aside')
    @include('include.front-aside')
@endsection

@section('main')
<p class="textbackground ">カートに情報が保存されました</p>
<a href="{{route('index')}}">ホームに戻る</a>
@endsection


