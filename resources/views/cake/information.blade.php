@extends('components.frontlayout')
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
    <section class="">
        <h3>おしらせ</h3>
        @foreach ($informations as $information)
        <p>{{ $information->topic }}</p>
        <p>{{ $information->information }}</p>
        @endforeach
    </section>
@endsection
