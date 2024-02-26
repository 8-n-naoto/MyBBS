@extends('components.frontlayout')

@section('title', 'カート一覧（relation）')

@section('css')
    <link rel="stylesheet" href="{{ url('css/front.css') }}">
@endsection

@section('aside')
    @include('include.front-aside')
@endsection

@section('main')
    <section>
        <h2 class="topic-font">カート一覧</h2>
        <section>
            <table class="formtable">
                <tbody>
                    @forelse ($carts as $cart)
                        <tr>
                            <td>
                                <a href="{{ route('front.cake', $cart->cake_info_sub->cake_info->id) }}">
                                    <img src="{{ asset($cart->cake_info_sub->cake_info->mainphoto) }}" class="formphoto"
                                        alt="ケーキの写真">
                                </a>
                            </td>
                            <td>
                                <table>
                                    <tbody>
                                        <tr>
                                            <td>購入商品</td>
                                            <td>：</td>
                                            <td> {{ e($cart->cake_info_sub->cake_info->cakename) }}</td>
                                        </tr>
                                        <tr>
                                            <td>内容量</td>
                                            <td>：</td>
                                            <td>{{ $cart->cake_info_sub->capacity }}</td>
                                        </tr>
                                        <tr>
                                            <td>価格</td>
                                            <td>：</td>
                                            <td>￥{{ $cart->cake_info_sub->price }}円</td>
                                        </tr>
                                        <tr>
                                            <td>メッセージ</td>
                                            <td>：</td>
                                            <td>
                                                <form method="POST" action="{{ route('user.cart.update', $cart) }}"
                                                    class="flex-row">
                                                    @method('PATCH')
                                                    @csrf
                                                    <input type="text" class="cakeform" name="message"
                                                        value="{{ $cart->message }}">
                                                    <button>メッセージを変更する</button>
                                                </form>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <form method="POST" action="{{ route('user.cart.destroy', $cart) }}"
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
                    @empty
                        <p>カートに商品がありません</p>
                    @endforelse
                </tbody>
            </table>

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
