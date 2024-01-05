@extends('components.footer')
@extends('components.aside')
@extends('components.header')

@section('contents')
    {{-- <?php dd($prices); ?> --}}
    <main class="flex-center">
        <!-- 画面左側 -->
        <section class="textbackground">
            {{-- 確認後下記の属性にこれをたすenctype="multipart/form-data" --}}
            <form method="post" action="{{ route('update', $info) }}" enctype="multipart/form-data" id="update_cake"
                class="update">
                @method('PATCH')
                @csrf
                <label>
                    <p>現在の写真</p>
                    <img src="{{ asset($info->mainphoto) }}" class="images" alt="ケーキの写真" width="160px" accept=".jpg,.png">
                    <input type="file" name="mainphoto" value="{{ $info->mainphoto }}">
                    @error('mainphoto')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </label>
                <label>
                    ケーキの名前：<input type="text" name="cakename" size="20" value="{{ $info->cakename }}">
                    @error('cakename')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </label>
                <label>
                    商品コード:<input type="text" name="cakecode" size="7" value="{{ $info->cakecode }}">
                    <p>既存の商品コード</p>
                    @forelse ($cakecode as $cakecode)
                        <p>商品コード：{{ $cakecode->cakecode }} 商品名：{{ $cakecode->cakename }}</p>
                    @empty
                        <p>まだ商品がありません</p>
                    @endforelse
                    @error('cakecode')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </label>
                <label>
                    ひとこと説明：<input type="text" name="topic" size="20" value="{{ $info->topic }}">
                    @error('topics')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </label>
                <label>説明文：
                    <textarea name="explain" value="">{{ $info->explain }}</textarea>
                    @error('explain')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </label>
                <button class="button" id="button">更新するよ！</button>
            </form>
            <form method="post" action="{{ route('destroy', $info) }}" class="delete">
                @method('DELETE')
                @csrf
                <button class="button">削除ボタン</button>
            </form>

            <h2>大きさと値段の設定</h2>
            <form method="post" action="{{ route('add.price', $info) }}" id="update_price" class="flex-row update">
                @csrf
                <input type="hidden" name='id' value="{{ $info->id }}">
                <label>
                    大きさ：<input type="text" name="capacity" size="5">
                    @error('capacity')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </label>
                <label>
                    お値段：<input type="text" name="price" size="7">
                    @error('price')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </label>
                <button class="button">追加するよ！</button>
            </form>

            @forelse ($prices as $price)
                <form method="post" action="{{ route('destroy.price', $price) }}" id="" class="flex-row delete">
                    @method('DELETE')
                    @csrf
                    <p>大きさ：{{ $price->capacity }}</p>
                    <p> お値段：{{ $price->price }}円</p>
                    <input type="hidden" id="info" value="{{ $info }}">
                    <button class="button">消去</button>
                </form>
            @empty
                <p>バリエーションを追加してください</p>
            @endforelse





            <h2>ギャラリーの設定</h2>
            <form method="post" action="{{ route('add.photo') }}" enctype="multipart/form-data" id="update_subphoto"
                class="update">
                @csrf
                <input type="hidden" name='cake_photos_id' value="{{ $info->id }}">
                <label>
                    写真を選択してください： <input type="file" name="subphotos" accept=".jpg,.png">
                    @error('subphotos')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </label>
                <label>
                    写真の名前：<input type="text" name="photoname" size="7">
                    @error('photoname')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </label>
                <button class="button">追加するよ！</button>
            </form>

            @forelse ($subphotos as $subphoto)
                <form method="post" action="{{ route('destroy.photo', $subphoto) }}" class="delete">
                    @method('DELETE')
                    @csrf
                    <img src=" {{ asset($subphoto->subphotos) }}" alt=""width="200px">
                    <p>写真の名前：{{ $subphoto->photoname }}</p>
                    <input type="hidden" id="subphoto" value="{{ $subphoto }}">
                    <button class="button">消去</button>
                </form>
            @empty
                <p>バリエーションを追加してください</p>
            @endforelse


        </section>


    <script>
        'use strict';
        {
            // document.getElementById('update_cake').addEventListener('submit', e => {
            //     e.preventDefault();
            //     if (!confirm('商品を追加しますか?')) {
            //         return;
            //     }
            //     e.target.submit();
            // });
            // document.getElementById('update_price').addEventListener('submit', e => {
            //     e.preventDefault();
            //     if (!confirm('値段を追加しますか?')) {
            //         return;
            //     }
            //     e.target.submit();
            // });
            // document.getElementById('update_subphoto').addEventListener('submit', e => {
            //     e.preventDefault();
            //     if (!confirm('写真を追加しますか?')) {
            //         return;
            //     }
            //     e.target.submit();
            // });

            // ボタン更新用
            document.querySelectorAll('.update').forEach(element => {
                element.addEventListener('submit', e => {
                    e.preventDefault();
                    // switch()｛
                    if (!confirm('更新しますか？')) {
                        return;
                        // }
                        e.target.submit();
                    }
                    // ｝
                })
            });


            // ボタン削除用
            document.querySelectorAll('.delete').forEach(element => {
                element.addEventListener('submit', e => {
                    e.preventDefault();
                    if (!confirm('本当に削除しますか？')) {
                        return;
                    }
                    e.target.submit();
                })

            });

        }
    </script>
@endsection
