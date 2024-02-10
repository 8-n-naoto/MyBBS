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
<p class="textbackground bigfont">お知らせ新規追加</p>
        <div class="textbackground">
            <form method="POST" action="{{ route('information.criate.post') }}" class="update">
                @csrf
                <p class="form-font">題名</p>
                <input type="text" name="topic" value="">
                @error('topic')
                <p class="error">{{$message}}</p>
                @enderror
                <p class="form-font">お知らせ内容</p>
                <textarea name="information" id="" cols="30" rows="10"></textarea>
                @error('information')
                <p class="error">{{$message}}</p>
                @enderror
                <button class="update">追加する</button>
            </form>
        </div>
@endsection

@section('js')
    <script src="{{ url('js/button.js') }}"></script>
@endsection
