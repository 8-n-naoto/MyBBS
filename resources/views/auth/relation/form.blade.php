{{-- <?php dd($info); ?> --}}
@extends('components.frontlayout')

@section('title', '予約情報入力(relation)')

@section('css')
    <link rel="stylesheet" href="{{ url('css/front.css') }}">
@endsection

@section('aside')
    @include('include.front-aside')
@endsection


@section('main')
    <section class="form">
        <h2 class="topic-font">購入予定商品一覧</h2>

        <form method="POST" action="{{ route('user.check.store') }}">
            @csrf
            <input type="hidden" name="users_id" id="name" value="{{ Auth::user()->id }}">
            <input type="hidden" name="users_name" id="name" value="{{ Auth::user()->name }}">
            @error('users_id')
                <div class="error">{{ $message }}</div>
            @enderror
            <table class="formtable">
                <tbody>
                    <tr>
                        <td>お名前</td>
                        <td>：</td>
                        <td>{{ Auth::user()->name }}様</td>
                    </tr>
                    <tr>
                        <td>受け取り日時</td>
                        <td>：</td>
                        <td>
                            <input type="date" name="birthday" id="date">
                            @error('birthday')
                                <p class="error">{{ $message }}</p>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <td>受け取り時間</td>
                        <td>：</td>
                        <td>
                            <ul>
                                <li class="flex-row ">
                                    <input type="radio" name="time" id="time1" value="10:00:00">
                                    <label class="font" for="time1">10時～11時</label>
                                </li>
                                <li class="flex-row">
                                    <input type="radio" name="time" id="time2" value="11:00:00">
                                    <label class="font" for="time2">11時～12時</label>
                                </li>
                                <li class="flex-row">
                                    <input type="radio" name="time" id="time3" value="12:00:00">
                                    <label class="font" for="time3">12時～13時</label>
                                </li>
                                <li class="flex-row">
                                    <input type="radio" name="time" id="time4" value="13:00:00">
                                    <label class="font" for="time4">13時～14時</label>
                                </li>
                                <li class="flex-row">
                                    <input type="radio" name="time" id="time5" value="14:00:00">
                                    <label class="font" for="time5">14時～15時</label>
                                </li>
                                <li class="flex-row">
                                    <input type="radio" name="time" id="time6" value="15:00:00">
                                    <label class="font" for="time6">15時～16時</label>
                                </li>
                                <li class="flex-row">
                                    <input type="radio" name="time" id="time7" value="16:00:00">
                                    <label class="font" for="time7">16時～17時</label>
                                    @error('time')
                                        <p class="error">{{ $message }}</p>
                                    @enderror
                                </li>
                            </ul>
                        </td>
                    </tr>

                    {{-- 予約一覧まとめて表示 --}}
                    @forelse ($carts as $cart)
                        @if ($cart->cake_info_sub->cake_info->boolean)
                            <tr>
                                <td> <img src="{{ asset($cart->cake_info_sub->cake_info->mainphoto) }}" class="formphoto"
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
                <button class="">確認画面へ！</button>
            </div>
        </form>
    </section>
@endsection
