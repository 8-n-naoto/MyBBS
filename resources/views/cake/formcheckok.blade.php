@extends('components.frontlayout')

@section('title', '予約完了画面')

@section('css')
    <link rel="stylesheet" href="{{ url('css/front.css') }}">
@endsection

@section('aside')
    @include('include.front-aside')
@endsection

@section('main')
    <section class="informations">
        <div>
            <p class="form-font items">{{ Auth::user()->name }}様の予約番号：{{ $subID }}</p>
            <p class="form-font items">またのお越しをお待ちしております！</p>
        </div>
        <div>
            <a href="{{ route('index') }}" alt="ホームに戻るよ！">
                <button>ホームへ戻る</button>
            </a>
        </div>
    </section>
@endsection
