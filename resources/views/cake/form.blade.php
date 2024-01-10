{{-- <?php dd($info); ?> --}}
@extends('components.frontlayout')


@section('main')
<section class="form">
    <form method="post" action="{{ route('formcheck') }}">
        @csrf
        <div>
            <input type="hidden" name="users_id" id="name" value="{{Auth::user()->id}}">
            <label for="name">お名前:
                <input type="text" name="users_name" id="name" value="{{Auth::user()->name}}">様</label>
            @error('users_id')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="date">受け取り日時:
                <input type="date" name="birthday" id="date"></label>
            @error('birthday')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="date">受け取り時間:
                <input type="time" name="time" id="time"></label>
            @error('time')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <img src="{{ asset($info->mainphoto) }}" width="240px">
            <label for="cake">ケーキの種類:
                <input type="text" name="cakename" id="cake" value="{{ $info->cakename }}" readonly></label>
            <input type="hidden" name="mainphoto" id="cake" value="{{ $info->mainphoto }}" readonly></label>
        </div>
        <div>
            @forelse ($prices->cake_info_subs as $price)
                <label>
                    <input type="radio" name="capacity" value="{{ $price->capacity }}">
                    大きさ：{{ $price->capacity }}お値段：{{ $price->price }}円
                </label>
                <input type="hidden" name="price" value="{{ $price->price }}">
                @error('capacity')
                    <div class="error">{{ $message }}</div>
                @enderror
            @empty
                <p>ただいま準備中...</p>
            @endforelse
        </div>
        <div>
            メッセ―ジ：
            <textarea name="massage" placeholder="メッセージを入力してください"></textarea>
            @error('massage')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <button class="button">確認画面へ！</button>
        </div>
    </form>
</section>
@endsection
