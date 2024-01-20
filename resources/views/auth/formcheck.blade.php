{{-- <?php dd($info->capasity); ?> --}}
@extends('components.frontlayout')

@section('css')
    <link rel="stylesheet" href="{{ url('css/cakephotos.css') }}">
    <link rel="stylesheet" href="{{ url('css/font.css') }}">
    <link rel="stylesheet" href="{{ url('css/form.css') }}">
    <link rel="stylesheet" href="{{ url('css/animation.css') }}">
@endsection

@section('main')
    <section class="form">
        <form method="post" action="{{ route('user.result.store') }}" id="form_send" class="sendform">
            @csrf
            <div>
                <p>お名前:{{ $info->users_name }}</p>
                <input type="hidden" name="users_id" id="date" value="{{ $info->users_id }}">
            </div>
            <div>
                <p>受け取り日時:{{ $info->birthday }}</p>
                <input type="hidden" name="birthday" id="date" value="{{ $info->birthday }}">
            </div>
            <div>
                <p>受け取り時間:{{ $info->time }}</p>
                <input type="hidden" name="time" id="time" value="{{ $info->time }}">
            </div>
            {{-- 予約一覧まとめて表示 --}}
            @forelse ($carts as $cart)
                @if ($cart->cake_info_sub->cake_info->boolean)
                    <div class="flex-row textbackground">
                        <img src="{{ asset($cart->cake_info_sub->cake_info->mainphoto) }}" class="menuphotos"
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
                <button class="sendbutton" id="button">内容を確定する</button>
            </div>

            {{-- なんかおかしいので直す「flex」が原因 --}}
            <div class="loader">
                <div class="sk-chase">
                    <div class="sk-chase-dot"></div>
                    <div class="sk-chase-dot"></div>
                    <div class="sk-chase-dot"></div>
                    <div class="sk-chase-dot"></div>
                    <div class="sk-chase-dot"></div>
                    <div class="sk-chase-dot"></div>
                </div>
            </div>
        </form>
    </section>
    <script src="{{ url('js/button.js') }}"></script>
@endsection
