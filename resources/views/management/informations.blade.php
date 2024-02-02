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
    <ul>
        <li>お知らせ一覧</li>
        @forelse ($informations as $information)
            <a href="{{route('information.edit.store',$information)}}">
                <li class="formfont link">{{ $information->topic }}</li>
            </a>
        @empty
            <li>コンテンツがありません</li>
        @endforelse
    </ul>
@endsection
