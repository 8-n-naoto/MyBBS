{{-- <?php dd($info); ?> --}}
@extends('components.frontlayout')

@section('css')
    <link rel="stylesheet" href="{{ url('css/cakephotos.css') }}">
    <link rel="stylesheet" href="{{ url('css/font.css') }}">
    <link rel="stylesheet" href="{{ url('css/form.css') }}">
    <link rel="stylesheet" href="{{ url('css/main.css') }}">
@endsection

@section('main')
    <section class="textbackground">
        <form method="POST" action="{{ route('user.check.store') }}">
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
                    <input type="time" name="time" id="time">
                </label>
                @error('time')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            {{-- 予約一覧まとめて表示 --}}
            @forelse ($carts as $cart)
                @if ($cart->cake_info_sub->cake_info->boolean)
                    <div class="flex-row textbackground">
                        <img src="{{ asset($cart->cake_info_sub->cake_info->mainphoto) }}" class="mainphoto"
                            alt="ケーキの写真">
                        <div>
                            <p class="cakenamefont">
                                {{ e($cart->cake_info_sub->cake_info->cakename) }}
                            </p>
                            <p class="cakenamefont">
                                {{ $cart->cake_info_sub->capacity }}
                                {{ $cart->cake_info_sub->price }}円
                            </p>
                            <p class="form-font">メッセージ：</p>
                            <p class="form-font">{{ $cart->message }}</p>
                        </div>
                    </div>
                @endif
            @empty
                <p>予約商品がありません</p>
            @endforelse
            <div>
                <button class="">確認画面へ！</button>
            </div>
        </form>
    </section>
@endsection
