@extends('errors::minimal')

@section('css')
    <link rel="stylesheet" href="{{ url('css/front.css') }}">
@endsection

@section('main')
    <p class="middlefont">ページの移動に失敗しました。<br />
        お探しのページは存在しません</p>

        <form method="get" action="{{ route('index') }}">
        <button>ホームに戻る</button>
    </form>
@endsection
