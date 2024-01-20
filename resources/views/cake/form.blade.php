{{-- <?php dd($info); ?> --}}
@extends('components.frontlayout')

@section('css')
    <link rel="stylesheet" href="{{ url('css/font.css') }}">
    <link rel="stylesheet" href="{{ url('css/form.css') }}">
@endsection

@section('main')
    <section class="form">
        <form method="post" action="{{ route('front.check') }}">
            @csrf
            <input type="hidden" name="users_id" id="name" value="{{ Auth::user()->id }}">
            <div class="flex-row">
                <p class="font">お名前：</p>
                <p class="font">{{ Auth::user()->name }}様</p>
                    <input type="hidden" name="users_name" id="name" value="{{ Auth::user()->name }}">
                @error('users_id')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="date" class="flex-row">
                    <p class="font">受け取り日時:</p>
                    <input type="date" name="birthday" id="date">
                </label>
                @error('birthday')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="date" class="flex-row">
                    <p class="font">受け取り時間:</p>
                    <input type="time" name="time" id="time"></label>
                @error('time')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <img src="{{ asset($info->mainphoto) }}" width="240px">
                <label for="cake" class="flex-row">
                    <p class="font">ケーキの種類:</p>
                    <input type="text" name="cakename" id="cake" value="{{ $info->cakename }}" readonly></label>
                <input type="hidden" name="mainphoto" id="cake" value="{{ $info->mainphoto }}" readonly></label>
            </div>
            <div>
                @forelse ($prices->cake_info_subs as $price)
                    <label class="flex-row">
                        <input type="radio" name="capacity" value="{{ $price->capacity }}">
                        <p class="font">大きさ：{{ $price->capacity }}お値段：{{ $price->price }}円</p>
                    </label>
                    <input type="hidden" name="price" value="{{ $price->price }}">
                    @error('capacity')
                        <div class="error">{{ $message }}</div>
                    @enderror
                @empty
                    <p>ただいま準備中...</p>
                @endforelse
            </div>
            <div class="flex-row">
                <p class="font">メッセ―ジ：</p>
                <textarea name="message" placeholder="メッセージを入力してください">メッセージなし</textarea>
                @error('message')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <button class="button">確認画面へ！</button>
            </div>
        </form>
    </section>
@endsection
