{{-- <?php dd($info->capasity); ?> --}}
@extends('components.frontlayout')

@section('title', '予約情報確認（relation）')

@section('css')
    <link rel="stylesheet" href="{{ url('css/front.css') }}">
@endsection

@section('aside')
    @include('include.front-aside')
@endsection

@section('main')
    <section class="form">
        <h2 class="topic-font">ご入力情報確認</h2>
        <form method="post" action="{{ route('user.result.store') }}" id="form_send" class="sendform">
            @csrf


            <table class="formtable">
                <tbody>
                    <tr>
                        <td>お名前</td>
                        <td>：</td>
                        <td>
                            {{ $info->users_name }}
                            <input type="hidden" name="users_id" id="date" value="{{ $info->users_id }}">
                        </td>
                    </tr>
                    <tr>
                        <td>受け取り日</td>
                        <td>：</td>
                        <td>
                            {{ $info->birthday }}
                            <input type="hidden" name="birthday" id="date" value="{{ $info->birthday }}">
                        </td>
                    </tr>
                    <tr>
                        <td>受け取り時間</td>
                        <td>：</td>
                        <td>
                            {{ $info->time }}
                            <input type="hidden" name="time" id="time" value="{{ $info->time }}">
                        </td>
                    </tr>

                    {{-- 予約一覧まとめて表示 --}}
                    @forelse ($carts as $cart)
                        @if ($cart->cake_info_sub->cake_info->boolean)
                            <tr>
                                <td>
                                    <img src="{{ asset($cart->cake_info_sub->cake_info->mainphoto) }}" class="formphoto"
                                        alt="ケーキの写真">
                                </td>
                                <td></td>
                                <td>
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td>購入商品</td>
                                                <td>：</td>
                                                <td>{{ e($cart->cake_info_sub->cake_info->cakename) }}</td>
                                            </tr>
                                            <tr>
                                                <td> 内容量
                                                </td>
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
                                                <td>{{ $cart->message }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        @endif
                    @empty
                        <p>予約商品がありません</p>
                    @endforelse
                </tbody>

            </table>
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
@endsection

@section('js')
    <script src="{{ url('js/button.js') }}"></script>
@endsection
