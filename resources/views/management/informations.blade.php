@extends('components.managementlayout')

@section('title','おしらせ')

@section('css')
    <link rel="stylesheet" href="{{ url('css/font.css') }}">
    <link rel="stylesheet" href="{{ url('css/form.css') }}">
    <link rel="stylesheet" href="{{ url('css/aside.css') }}">
@endsection

@section('aside')
    @include('include.aside')
@endsection

@section('main')
        <p class="textbackground form-font">お知らせ一覧</p>
    <ul class="textbackground">
        @forelse ($informations as $information)
            <a href="{{route('information.edit.store',$information)}}">
                <li class="form-font link">更新日：{{$information->updated_at->format('Y年m月d日')}} {{ $information->topic }}</li>
            </a>
        @empty
            <li class="fonm-font">コンテンツがありません</li>
        @endforelse
    </ul>
@endsection
