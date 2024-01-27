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
    <p>カートに商品がありません</p>
@endsection
