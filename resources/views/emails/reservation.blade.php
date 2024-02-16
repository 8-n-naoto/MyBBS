@extends('components.frontlayout')

@section('css')
    <link rel="stylesheet" href="{{ url('css/cakephotos.css') }}">
    <link rel="stylesheet" href="{{ url('css/font.css') }}">
    <link rel="stylesheet" href="{{ url('css/form.css') }}">
@endsection
@section('main')
    <section>
        <h2 class="textbackground bigfont">ご予約商品一覧</h2>
        <section>
            <div class="flex-column">
                @foreach ($content as $key => $data)
                    <div class="flex-row textbackground">
                        <a href="{{ route('front.cake', $data['cake_info_id']) }}">
                            <img src="{{ asset($data['mainphoto']) }}" class="cartphotos" alt="ケーキの写真" width="240px">
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
        </section>

    </section>
@endsection
