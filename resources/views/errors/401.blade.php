@extends('errors::minimal')

@section('css')
    <link rel="stylesheet" href="{{ url('css/front.css') }}">
@endsection

@section('main')
    <p class="middlefont">ページの移動に失敗しました。<br />
   アクセス権がない、または認証に失敗しています</p>
    <form action="get" action="{{ route('index') }}">
        <button>ホームに戻る</button>
    </form>
@endsection
