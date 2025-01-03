@extends('components.managementlayout')

@section('title', 'お知らせ新規作成')

@section('css')
    <link rel="stylesheet" href="{{ url('css/management.css') }}">
@endsection

@section('aside')
    @include('include.aside')
@endsection

@section('main')
    <p class="topic-font">お知らせ新規追加</p>
    <div class="textbackground">
        <form method="POST" action="{{ route('information.criate.post') }}" class="update flex-column">
            @csrf
            <div class="flwx-row">
                <p class="middlefont">題名：</p>
                <input type="text" name="topic" value="{{ old('topic') }}" class="form-font">
                @error('topic')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
            <p class="middlefont">お知らせ内容</p>
            <textarea name="information"class="edit-textarea">{{ old('information') }}</textarea>
            @error('information')
                <p class="error">{{ $message }}</p>
            @enderror
            <button class="update">追加する</button>
        </form>
    </div>
@endsection

@section('js')
    <script src="{{ url('js/button.js') }}"></script>
@endsection
