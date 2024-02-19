{{-- <?php dd($info); ?> --}}
@extends('components.frontlayout')

@section('title','予約情報入力(relation)')

@section('css')
    <link rel="stylesheet" href="{{ url('css/front.min.css') }}">
@endsection

@section('aside')
    @include('include.front-aside')
@endsection


@section('main')
    <section class="form">
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
                     <ul>
                        <li class="flex-row">
                            <input type="radio" name="time" id="time1" value="10:00:00">
                            <label class="font" for="time1">10時～11時</label>
                        </li>
                        <li class="flex-row">
                            <input type="radio" name="time" id="time2" value="11:00:00">
                            <label class="font" for="time2">11時～12時</label>
                        </li>
                        <li class="flex-row">
                            <input type="radio" name="time" id="time3" value="12:00:00">
                            <label class="font" for="time3">12時～13時</label>
                        </li>
                        <li class="flex-row">
                            <input type="radio" name="time" id="time4" value="13:00:00">
                            <label class="font" for="time4">13時～14時</label>
                        </li>
                        <li class="flex-row">
                            <input type="radio" name="time" id="time5" value="14:00:00">
                            <label class="font" for="time5">14時～15時</label>
                        </li>
                        <li class="flex-row">
                            <input type="radio" name="time" id="time6" value="15:00:00">
                            <label class="font" for="time6">15時～16時</label>
                        </li>
                        <li class="flex-row">
                            <input type="radio" name="time" id="time7" value="16:00:00">
                            <label class="font" for="time7">16時～17時</label>
                        </li>
                    </ul>
                </label>
                @error('time')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            {{-- 予約一覧まとめて表示 --}}
            @forelse ($carts as $cart)
                @if ($cart->cake_info_sub->cake_info->boolean)
                    <div class="flex-row textbackground">
                        <img src="{{ asset($cart->cake_info_sub->cake_info->mainphoto) }}" class="formphoto"
                            alt="ケーキの写真">
                        <div class="flex-column">
                            <p class="form-font items">
                            購入商品：{{ e($cart->cake_info_sub->cake_info->cakename) }}
                            </p>
                            <p class="form-font items">
                                内容量：{{ $cart->cake_info_sub->capacity }}
                                ￥{{ $cart->cake_info_sub->price }}円
                            </p>
                            <p class="form-font items">メッセージ：{{ $cart->message }}</p>
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
