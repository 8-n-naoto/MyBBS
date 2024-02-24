@extends('errors::minimal')

@section('main')
    <p class="middlefont">ページの移動に失敗しました。</p>
    <form method="get" action="{{ route('index') }}">
        <button>ホームに戻る</button>
    </form>
@endsection
