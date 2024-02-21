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

    <table class="info">
        @forelse ($informations as $information)
            <tr>
                <td class="form-font">更新日</td>
                <td class="form-font">{{ $information->updated_at->format('Y年m月d日') }}</td>
                <td class="form-wrap-font link">
                    <a href="{{ route('information.edit.store', $information) }}">
                        {{ $information->topic }}
                    </a>
                </td>
            </tr>
        @empty
            <td class="fonm-font">コンテンツがありません</td>
        @endforelse
    </table>

@endsection
