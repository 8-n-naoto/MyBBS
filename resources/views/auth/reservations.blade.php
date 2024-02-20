
@extends('components.frontlayout')

@section('title','ご予約情報確認画面')

@section('css')
    <link rel="stylesheet" href="{{ url('css/front.css') }}">
@endsection

@section('aside')
    @include('include.front-aside')
@endsection

@section('main')
    <section>
        <h3 class="textbackground form-font">ご予約情報の確認</h3>
        @include('include.reservations')
    </section>
@endsection


@section('js')
<script src="{{ url('js/button.js') }}"></script>
@endsection
