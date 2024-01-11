@extends('components.frontlayout')
@section('css')
<link rel="stylesheet" href="{{ url('css/cakephotos.css') }}">
<link rel="stylesheet" href="{{ url('css/font.css') }}">
@endsection

@section('main')
    <section>
        <h1 class="bigfont textbackground">デコレーションケーキ</h1>
        @include('include.cakes')
    </section>
    @include('include.google-map')
@endsection
