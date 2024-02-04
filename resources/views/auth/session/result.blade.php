@extends('components.frontlayout')

@section('css')
    <link rel="stylesheet" href="{{ url('css/cakephotos.css') }}">
    <link rel="stylesheet" href="{{ url('css/font.css') }}">
    <link rel="stylesheet" href="{{ url('css/form.css') }}">
    <link rel="stylesheet" href="{{ url('css/aside.css') }}">
@endsection

@section('aside')
    @include('include.front-aside')
@endsection

@section('main')
    <section class="form">
        <div>
        <p class="">またのお越しをお待ちしております！</p>
        </div>
      <div>
        <a href="{{route('index')}}" alt="ホームに戻るよ！">
          <button>ホームへ戻る</button>
        </a>
      </div>
    </section>
@endsection
