{{-- <?php dd($info); ?> --}}
@extends('components.frontlayout')

@section('title', '購入フォーム')

@section('css')
    <link rel="stylesheet" href="{{ url('css/front.css') }}">
@endsection

@section('aside')
    @include('include.front-aside')
@endsection

@section('main')
    <section class="informations">
        <form method="post" action="{{ route('front.check') }}">
            @csrf
            <input type="hidden" name="users_id" id="name" value="{{ Auth::user()->id }}">
            <div class="flex-row">
                <p class="form-font items">お名前：</p>
                <p class="form-font">{{ Auth::user()->name }}様</p>
                <input type="hidden" name="users_name" id="name" value="{{ Auth::user()->name }}">
                @error('users_id')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="date" class="flex-row">
                    <p class="form-font items">受け取り日時:</p>
                    <input type="date" name="birthday" id="date">
                </label>
                @error('birthday')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            <div class="flex-row">
                <p class="form-font items">受け取り時間:</p>
                <ul>
                    <li class="flex-row">
                        <input type="radio" name="time" id="time1" value="10:00:00">
                        <label class="form-font items" for="time1">10時～11時</label>
                    </li>
                    <li class="flex-row">
                        <input type="radio" name="time" id="time2" value="11:00:00">
                        <label class="form-font items" for="time2">11時～12時</label>
                    </li>
                    <li class="flex-row">
                        <input type="radio" name="time" id="time3" value="12:00:00">
                        <label class="form-font items" for="time3">12時～13時</label>
                    </li>
                    <li class="flex-row">
                        <input type="radio" name="time" id="time4" value="13:00:00">
                        <label class="form-font items" for="time4">13時～14時</label>
                    </li>
                    <li class="flex-row">
                        <input type="radio" name="time" id="time5" value="14:00:00">
                        <label class="form-font items" for="time5">14時～15時</label>
                    </li>
                    <li class="flex-row">
                        <input type="radio" name="time" id="time6" value="15:00:00">
                        <label class="form-font items" for="time6">15時～16時</label>
                    </li>
                    <li class="flex-row">
                        <input type="radio" name="time" id="time7" value="16:00:00">
                        <label class="form-font items" for="time7">16時～17時</label>
                    </li>
                </ul>
                @error('time')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            <div class="flex-row">
                <img src="{{ asset($info->mainphoto) }}" width="240px">
                <div>
                    <p class="form-font items">ケーキの種類:{{ $info->cakename }}</p>
                    <input type="hidden" name="cakename" id="cake" value="{{ $info->cakename }}" readonly>
                    <input type="hidden" name="mainphoto" id="cake" value="{{ $info->mainphoto }}" readonly>
                    @forelse ($prices->cake_info_subs as $price)
                        <label class="flex-row">
                            <input type="radio" name="capacity" value="{{ $price->capacity }}">
                            <p class="form-font items">大きさ：{{ $price->capacity }} お値段：{{ $price->price }}円</p>
                        </label>
                        <input type="hidden" name="price" value="{{ $price->price }}">
                        @error('capacity')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    @empty
                        <p class="form-font items">ただいま準備中...</p>
                    @endforelse
                </div>
            </div>
            <div class="flex-row">
                <p class="form-wrap-font items">メッセ―ジ：</p>
                <textarea name="message" placeholder="メッセージを入力してください" class="message-textarea items">{{ old('message') }}</textarea>
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
