@extends('components.frontlayout')

@section('main')
    <main>
        <div class="container">
            <div class="jumbotron bg-white">
                <h1 class="text-center">商品情報</h1>
                <h3 class="my-4 text-center">
                    @if (isset($cakeinfo->cake_name))
                        {{ $cakeinfo->cake_name }}
                    @endif
                </h3>
                <div class="offset-sm-3">
                    <p class="offset-sm-6">
                        商品カテゴリ：
                        @if (isset($category_name->category_name))
                            {{ $category_name->category_name }}
                        @endif
                    </p>
                    <p>商品説明</p>
                    <p>
                        @if (isset($cakeinfo->description))
                            {{ $cakeinfo->description }}
                        @endif
                    </p>
                    <p class="mt-4 mb-5">価格：
                        @if (isset($cakeinfo->price))
                            {{ $cakeinfo->price }}
                        @endif
                        円
                    </p>
                </div>

                {{-- {!! Form::open(['route' => ['addcart.post', 'class' => 'd-inline']]) !!} --}}
                <form method="POST" action="{{ route('addcart.post') }}" class="d-iline">
                    @csrf

                    {{-- 画面遷移時にPOST送信 session保存に使用 --}}
                    {{-- {{ Form::hidden('products_id', $product->id) }}
                    {{ Form::hidden('users_id', $user->id) }} --}}
                    <input type="hidden" name="cake_code" value="{{ $info->id }}">
                    {{-- コントローラーで遷移時に$user_idを渡していく --}}
                    <input type="hidden" name="user_id" value="{{ $user_id }}">
                    {{-- messageが必要なので追加する --}}
                    <textarea name="message" cols="30" rows="10" placeholder="お誕生日メッセージを記入してください"></textarea>


                    {{-- <div class="form-row justify-content-center">
                        {!! Form::label('prodqty', '購入個数', ['class' => 'mt-1']) !!} --}}
                    <label for="prodqty" class="mt-1">
                        購入個数
                        <div class="form-group col-sm-1">
                            <div class="ml-1">
                                <input type="number" name="cake_quantity" class="form-control" id="prodqty"
                                    pattern="[1-9][0-9]*" min="1" required autofocus>
                            </div>
                        </div>
                        個
                    </label>
                    {{-- {!! Form::label('', '個', ['class' => 'mt-1 mr-3']) !!} --}}
                    <div class="form-group">
                        {{-- {!! Form::submit('カートへ', ['class' => 'btn btn-primary']) !!} --}}
                        <button class="btn btn-primary'">カートへ</button>
                    </div>
                    {{-- {!! Form::close() !!} --}}
                </form>

            </div>
        </div>
    </main>
@endsection



