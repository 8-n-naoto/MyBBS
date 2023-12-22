<x-layout>
    {{-- <?php dd($info); ?> --}}
    <main class="flex-center">
        <!-- 画面左側 -->
        <section class="textbackground">
            <form method="post" action="{{route('posts.store')}}" enctype="multipart/form-data" id="add_cake">
                @csrf
                <label>
                    写真更新用:<input type="file" name="mainphoto" accept=".jpg,.png">
                    @error('mainphoto')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </label>
                <label>
                    ケーキの名前：<input type="text" name="cakename" size="20" placeholder="">
                    @error('cakename')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </label>
                <label>
                    商品コード:<input type="text" name="cakecode" size="7" placeholder="#000000">
                    <p>既存の商品コード</p>
                    @forelse ($cakecode as $cakecode)
                    <p>商品コード：{{$cakecode->cakecode}} 商品名：{{$cakecode->cakename}}</p>
                    @empty
                    <p>まだ商品がありません</p>
                    @endforelse
                    @error('cakecode')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </label>
                <label>
                    ひとこと説明：<input type="text" name="topic" size="20" placeholder="">
                    @error('topic')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </label>
                <label class="flex-row">
                    大きさ：<input type="text" name="capacity" size="5" placeholder="">
                    @error('capacity')
                        <div class="error">{{ $message }}</div>
                    @enderror
                    お値段：<input type="text" name="price" size="7" placeholder="">円
                    @error('price')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </label>
                <label>説明文
                <textarea name="explain" placeholder=""></textarea>
                @error('explain')
                    <div class="error">{{ $message }}</div>
                @enderror
                </label>
                <button class="button" id="button">追加するよ！</button>
            </form>
        </section>
    </main>
    <script>
        'use strict'
        {
            document.getElementById('add_cake').addEventListener('submit', e => {
                e.preventDefault();
                if (!confirm('商品を追加しますか?')) {
                    return;
                }
                e.target.submit();
            });
        }
    </script>

</x-layout>
