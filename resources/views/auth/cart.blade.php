@extends('components.frontlayout')

@section('css')
    <link rel="stylesheet" href="{{ url('css/cakephotos.css') }}">
    <link rel="stylesheet" href="{{ url('css/font.css') }}">
    <link rel="stylesheet" href="{{ url('css/form.css') }}">
@endsection

@section('main')
    <section>
        <h2 class="textbackground bigfont">カート一覧</h2>
        <section>
            <div class="cakephotos textbackground">
                @forelse ($cartinfos as $info)
                    <object>
                        <a href="{{ route('front.cake', $info->id) }}">
                            <p class="cakenamefont">
                                <img src="{{ asset($info->cake_info->mainphoto) }}" class="menuphotos" alt="ケーキの写真">
                                {{ e($info->cake_info->cakename) }}
                            </p>
                        </a>

                        @foreach ($info->carts as $cart)
                            <div class="flex-row">
                                <form method="POST" action="{{ route('user.cart.update', $cart) }}">
                                    @method('PATCH')
                                    @csrf
                                    <p class="form-font">メッセージ：</p>
                                    <input type="text" class="cakeform" name="message" value="{{ $cart->message }}">
                                    <button>メッセージを変更する</button>
                                </form>
                            </div>
                        @endforeach
                        <p>{{ $info->cake_info->cakename }}予約合計台：{{ count($info->carts) }}台</p>
                    </object>
                @empty
                    <p>カートの中身がありません</p>
                @endforelse
            </div>
        </section>
        <form method="POST" action="{{ route('user.form.store') }}">
            @csrf
            <button>まとめて予約する</button>
        </form>
    </section>
@endsection
