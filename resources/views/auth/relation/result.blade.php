@extends('components.frontlayout')

@section('title','予約完了画面(relation)')

@section('css')
    <link rel="stylesheet" href="{{ url('css/font.css') }}">
    <link rel="stylesheet" href="{{ url('css/form.css') }}">
    <link rel="stylesheet" href="{{ url('css/main.css') }}">
@endsection

@section('main')
    <section class="form">
        <div>
            <p class="form-font">{{ Auth::user()->name }}様</p>
            <p class="form-font">またのお越しをお待ちしております！</p>
            <p>ご予約画面より内容、ご予約番号確認できます。</p>
        </div>
        <div>
            <a href="{{ route('index') }}" alt="ホームに戻るよ！">
                <button>ホームへ戻る</button>
            </a>
        </div>
    </section>
@endsection
