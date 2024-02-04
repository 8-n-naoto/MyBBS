@extends('components.managementlayout')

@section('css')
    <link rel="stylesheet" href="{{ url('css/font.css') }}">
    <link rel="stylesheet" href="{{ url('css/form.css') }}">
    <link rel="stylesheet" href="{{ url('css/aside.css') }}">
@endsection

@section('aside')
    @include('include.aside')
@endsection

@section('main')
    <ul class="textbackground">
        <li class="form-font">お知らせ一覧</li>
        @forelse ($informations as $information)
            <a href="{{route('information.edit.store',$information)}}">
                <li class="form-font link">{{ $information->topic }}</li>
            </a>
        @empty
            <li class="fonm-font">コンテンツがありません</li>
        @endforelse
    </ul>
@endsection
