@extends('components.frontlayout')

@section('title','お知らせ')

@section('css')
    <link rel="stylesheet" href="{{ url('css/front.css') }}">
@endsection

@section('aside')
    @include('include.front-aside')
@endsection
@section('main')
        <h3 class="topic-font">おしらせ</h3>
    <section class="informations">
        <p class="form-font items">{{ $information->topic }}</p>
        <p class="information-font">{{ $information->information }}</p>
    </section>
@endsection
