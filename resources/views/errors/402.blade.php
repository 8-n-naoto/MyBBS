@extends('errors::minimal')

@section('css')
    <link rel="stylesheet" href="{{ url('css/front.css') }}">
@endsection

@section('main')
    <p class="middlefont">ページの移動に失敗しました。</p>
    <form action="get" action="{{ route('index') }}">
        <button>ホームに戻る</button>
    </form>
@endsection
