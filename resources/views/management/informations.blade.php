@extends('components.managementlayout')

@section('title', 'おしらせ')

@section('css')
    <link rel="stylesheet" href="{{ url('css/management.css') }}">
@endsection

@section('aside')
    @include('include.aside')
@endsection

@section('main')
    <p class="topic-font">お知らせ一覧</p>
    <ul class="textbackground">
        @forelse ($informations as $information)
            <a href="{{ route('information.edit.store', $information) }}">
                <li class="form-font link">更新日：{{ $information->updated_at->format('Y年m月d日') }} {{ $information->topic }}
                </li>
            </a>
        @empty
            <li class="fonm-font">コンテンツがありません</li>
        @endforelse
    </ul>
@endsection
