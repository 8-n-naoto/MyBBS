@extends('components.frontlayout')

@section('title', '予約情報入力(session)')

@section('css')
    <link rel="stylesheet" href="{{ url('css/front.css') }}">
@endsection

@section('aside')
    @include('include.front-aside')
@endsection

@section('main')
    <section>
        <h2 class="topic-font">予約内容の確認</h2>
        <table class="formtable">
            <tbody>
                @foreach ($cartData as $key => $data)
                    <tr>
                        <td>
                            <a href="{{ route('front.cake', $data['cake_info_id']) }}">
                                <img src="{{ asset($data['mainphoto']) }}" class="formphoto" alt="ケーキの写真">
                            </a>
                        </td>
                        <td>
                            <table>
                                <tbody>
                                    <tr>
                                        <td>受取日</td>
                                        <td>：</td>
                                        <td>{{ e($data['birthday']) }}</td>
                                    </tr>
                                    <tr>
                                        <td>受け取り時間</td>
                                        <td>：</td>
                                        <td>{{ e($data['time']) }}</td>
                                    </tr>
                                    <tr>
                                        <td>商品名</td>
                                        <td>：</td>
                                        <td>{{ e($data['cakename']) }}</td>
                                    </tr>
                                    <tr>
                                        <td>容量</td>
                                        <td>：</td>
                                        <td>{{ $data['capacity'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>価格</td>
                                        <td>：</td>
                                        <td>￥{{ $data['price'] }}円</td>
                                    </tr>
                                    <tr>
                                        <td>メッセージ</td>
                                        <td>：</td>
                                        <td>{{ $data['message'] }}</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <form method="POST" action="{{ route('user.session.cart.destroy', $key) }}"
                                                class="delete">
                                                @method('DELETE')
                                                @csrf
                                                <button>予約情報を削除する</button>
                                            </form>
                                        </td>
                                    </tr>
                                </tbody>

                            </table>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <form action="{{ route('user.session.result.store') }}" method="post">
            @csrf
            <p class="topic-font">※登録したメールアドレスに自動メールが送信されます <br />
                ご注意ください※</p>
            <button>予約内容を確定する</button>
        </form>
    </section>
@endsection
