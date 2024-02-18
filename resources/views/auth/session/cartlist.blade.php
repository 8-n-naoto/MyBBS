@extends('components.frontlayout')

@section('title','カート一覧(session)')

@section('css')
    <link rel="stylesheet" href="{{ url('css/cakephotos.css') }}">
    <link rel="stylesheet" href="{{ url('css/font.css') }}">
    <link rel="stylesheet" href="{{ url('css/form.css') }}">
    <link rel="stylesheet" href="{{ url('css/aside.css') }}">
@endsection
{{-- <?php dd($cartData); ?> --}}

@section('aside')
    @include('include.front-aside')
@endsection

@section('main')
    <section>
        <h2 class="textbackground bigfont">カート一覧</h2>
        <section>
            <div class="flex-column">
                @foreach ($cartData as $key => $data)
                    <div class="flex-row textbackground">
                        <a href="{{ route('front.cake', $data['cake_info_id']) }}">
                            <img src="{{ asset($data['mainphoto']) }}" class="cartphotos" alt="ケーキの写真">
                        </a>
                        <div>
                            <p class="cakenamefont">
                                受取日：{{ e($data['birthday']) }}
                            </p>
                            <p class="cakenamefont">
                                受け取り時間：{{ e($data['time']) }}
                            </p>
                            <p class="cakenamefont">
                                商品名：{{ e($data['cakename']) }}
                            </p>
                            <p class="cakenamefont">
                                容量：{{ $data['capacity'] }}
                            </p>
                            <p class="cakenamefont">
                                価格：{{ $data['price'] }}円
                            </p>
                            <p class="cakenamefont">
                                メッセージ：{{ $data['message'] }}
                            </p>
                            <form method="POST" action="{{ route('user.session.cart.destroy', $key) }}" class="delete">
                                @method('DELETE')
                                @csrf
                                <button>予約情報を削除する</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
        @if ($cartData)
            <form method="GET" action="{{ route('user.session.form.store') }}">
                @csrf
                <button>まとめて予約する</button>
            </form>
        @endif
    </section>
@endsection

@section('js')
<script src="{{ url('js/button.js') }}"></script>
@endsection
