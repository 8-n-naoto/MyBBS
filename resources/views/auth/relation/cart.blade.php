@extends('components.frontlayout')
@section('css')
    <link rel="stylesheet" href="{{ url('css/cakephotos.css') }}">
    <link rel="stylesheet" href="{{ url('css/font.css') }}">
    <link rel="stylesheet" href="{{ url('css/form.css') }}">
    <link rel="stylesheet" href="{{ url('css/aside.css') }}">
@endsection

@section('aside')
    @include('include.front-aside')
@endsection

@section('main')
    <section>
        <h2 class="textbackground bigfont">カート一覧</h2>
        <section>
            <div class="flex-column">
                @forelse ($carts as $cart)
                    <div class="flex-row textbackground">
                        <a href="{{ route('front.cake', $cart->cake_info_sub->cake_info->id) }}">
                            <img src="{{ asset($cart->cake_info_sub->cake_info->mainphoto) }}" class="cartphotos" alt="ケーキの写真">
                        </a>
                        <div>
                            <p class="cakenamefont">
                                {{ e($cart->cake_info_sub->cake_info->cakename) }}
                            </p>
                            <p class="cakenamefont">
                                {{ $cart->cake_info_sub->capacity }}
                                {{ $cart->cake_info_sub->price }}円
                            </p>
                            <form method="POST" action="{{ route('user.cart.update', $cart) }}" class="flex-row">
                                @method('PATCH')
                                @csrf
                                <p class="form-font">メッセージ：</p>
                                <input type="text" class="cakeform" name="message" value="{{ $cart->message }}">
                                <button>メッセージを変更する</button>
                            </form>
                            <form method="POST" action="{{ route('user.cart.destroy', $cart) }}" class="delete">
                                @method('DELETE')
                                @csrf
                                <button>予約情報を削除する</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p>カートに商品がありません</p>
                @endforelse
            </div>
        </section>
        <form method="GET" action="{{ route('user.form.store') }}">
            @csrf
            <button class="form-font">まとめて予約する</button>
        </form>
    </section>
@endsection


@section('js')
    <script src="{{ url('js/button.js') }}"></script>
@endsection