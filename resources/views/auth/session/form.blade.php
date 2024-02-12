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
        <h2 class="textbackground bigfont">予約内容の確認</h2>
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
                        </div>
                    </div>
                @endforeach
            </div>
            <form action="{{ route('user.session.result.store') }}" method="post">
                @csrf
                <button>予約内容を確定する</button>
            </form>
        </section>
    </section>
@endsection
