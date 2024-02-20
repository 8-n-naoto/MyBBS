@extends('components.frontlayout')

@section('title','予約完了画面(relation)')

@section('css')
    <link rel="stylesheet" href="{{ url('css/front.css') }}">
@endsection

@section('aside')
    @include('include.front-aside')
@endsection

@section('main')
    <section class="">
        <div class="flex-column">
            <p class="form-font items">{{ Auth::user()->name }}様</p>
            <p class="form-font  items">またのお越しをお待ちしております！</p>
            <p class="form-font items">ご予約画面より内容、ご予約番号確認できます。</p>
        </div>
        <div>
            <a href="{{ route('index') }}" alt="ホームに戻るよ！">
                <button>ホームへ戻る</button>
            </a>
        </div>
    </section>
@endsection
