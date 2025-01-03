@extends('components.managementlayout')

@section('title', 'お知らせ編集')

@section('css')
    <link rel="stylesheet" href="{{ url('css/management.css') }}">
@endsection

@section('aside')
    @include('include.aside')
@endsection

@section('main')
    <ul>
        <div>
            <form method="POST" action="{{ route('information.edit.update', $information) }}"
                class="update textbackground flex-column">
                @csrf
                @method('PATCH')
                <p class="form-font">題名</p>
                <input type="text" name="topic" value="{{ $information->topic }}" class="items">
                @error('topic')
                    <p class="error">{{ $message }}</p>
                @enderror
                <p class="form-font">お知らせ内容</p>
                <textarea name="information" class="edit-textarea">{{ $information->information }}</textarea>
                @error('information')
                    <p class="error">{{ $message }}</p>
                @enderror
                <button class="update">更新する</button>
            </form>
            <form method="POST" action="{{ route('information.edit.destroy', $information) }}" class="delete">
                @csrf
                @method('DELETE')
                <button>削除する</button>
            </form>
        </div>
    </ul>
@endsection

@section('js')
    <script src="{{ url('js/button.js') }}"></script>
@endsection
