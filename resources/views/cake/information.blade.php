@extends('components.frontlayout')

@section('title','お知らせ')

@section('css')
    <link rel="stylesheet" href="{{ url('css/font.css') }}">
    <link rel="stylesheet" href="{{ url('css/form.css') }}">
    <link rel="stylesheet" href="{{ url('css/aside.css') }}">
    <link rel="stylesheet" href="{{ url('css/cakephotos.css') }}">
@endsection

@section('aside')
    @include('include.front-aside')
@endsection
@section('main')
        <h3 class="middlefont textbackground">おしらせ</h3>
    <section class="informations">
        @foreach ($informations as $information)
        <p class="form-font">{{ $information->topic }}</p>
        <p class="information-font">{{ $information->information }}</p>
        @endforeach
    </section>
@endsection
