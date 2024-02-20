@extends('components.frontlayout')

@section('title', 'カート情報保存（session）')

@section('css')
    <link rel="stylesheet" href="{{ url('css/front.min.css') }}">
@endsection

@section('aside')
    @include('include.front-aside')
@endsection

@section('main')
    <form method="POST" action="{{ route('user.session.cart.add') }}" class="flex-culomn textbackground">
        @csrf
        <label for="birthday" class="form-font items">受け取り日：</label>
        <input type="date" name="birthday" id="birthday">
        @error('birthday')
            <p class="error">{{ $message }}</p>
        @enderror
        <div>
            <label for="date" class="flex-row">
                <div>

                <p class="form-font items">受け取り時間:</p>
                </div>
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
            </label>
            @error('time')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex-row">
            <div>
                    <input type="hidden" name="cake_info_id" value="{{ $cakeinfo->id }}">
                    <a href="{{ route('front.cake', $cakeinfo->id) }}">
                        <img src="{{ asset($cakeinfo->mainphoto) }}" class="menuphotos">
                    </a>
            </div>
            <div>
                @foreach ($cakeinfosubs as $cakeinfosub)
                    <p class="form-font items">商品名：{{ $cakeinfo->cakename }}</p>
                    <div class="flex-row">
                        <input type="radio" id="{{ $cakeinfosub->id }}" name="cake_info_sub_id"
                            value="{{ $cakeinfosub->id }}">
                        <label class="flex-row" for="{{ $cakeinfosub->id }}">
                            <p class="form-font items">内容量：{{ $cakeinfosub->capacity }}</p>
                            <p class="form-font items">価格：{{ $cakeinfosub->price }}円</p>
                        </label>
                    </div>
                @endforeach
                @error('cake_info_sub_id')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div>
        <label for="message" class="form-font items">メッセージ：</label>
        <textarea name="message" placeholder="無ければ「無し」と入力してください"  class="message-textarea items">{{ old('message') }}</textarea>
        @error('message')
            <p class="error">{{ $message }}</p>
        @enderror

        </div>
        <button>カートに情報を保存する</button>
    </form>
@endsection
