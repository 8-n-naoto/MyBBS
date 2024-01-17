@extends('components.managementlayout')

@section('css')
    <link rel="stylesheet" href="{{ url('css/font.css') }}">
    <link rel="stylesheet" href="{{ url('css/aside.css') }}">
@endsection

@section('main')
    <section class="flex-center">
        <!-- 画面左側 -->
        <section class="textbackground">
            <form method="post" action="{{ route('cakes.cake.criate') }}" enctype="multipart/form-data" id="add_cake">
                @csrf
                <div class="flex-row">
                    <p class="form-font">写真更新用:</p>
                    <input type="file" name="mainphoto" accept=".jpg,.png">
                    @error('mainphoto')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                <div class="flex-row">
                    <p class="form-font">ケーキの名前：</p>
                    <input type="text" name="cakename" size="20" placeholder="">
                    @error('cakename')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                <div class="flex-row">
                    <div class="flex-row">
                        <p class="form-font">商品コード:</p>
                        <div>
                            <input type="text" name="cakecode" size="7" placeholder="#000000">
                            @error('cakecode')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <p class="form-font">既存の商品コード</p>
                        <div class="flex-row">
                            <div class="flex-column">
                                @forelse ($cakecodes as $cakecode)
                                    <div class="flex-row">
                                        <p class="form-font">商品コード：
                                        <p>{{ $cakecode->cakecode }} </p>
                                    </div>
                                @empty
                                    <p class="form-font">まだ商品がありません</p>
                                @endforelse
                            </div>

                            <div class="flex-column">
                                @forelse ($cakenames as $cakename)
                                    <div class="flex-row">
                                        <p class="form-font">商品名：</p>
                                        <p>{{ $cakecode->cakename }}</p>
                                    </div>

                                @empty
                                    <p class="form-font">まだ商品がありません</p>
                                @endforelse
                            </div>

                        </div>
                    </div>

                </div>
                <div class="flex-row">
                    <p class="form-font">ひとこと説明：</p>
                    <input type="text" name="topic" size="20" placeholder="">
                    @error('topic')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                <div class="flex-row">
                    <p class="form-font">内容量：</p>
                    <input type="text" name="capacity" size="5" placeholder="">
                    @error('capacity')
                        <div class="error">{{ $message }}</div>
                    @enderror
                    <p class="form-font">価格：</p>
                    <input type="text" name="price" size="7" placeholder="">
                    <p class="form-font">円</p>
                    @error('price')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                <div class="flex-row">
                    <p class="form-font">説明文</p>
                    <textarea name="explain" placeholder=""></textarea>
                    @error('explain')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                <button class="button" id="addcake">追加するよ！</button>
            </form>
        </section>
    </section>
    <script src="{{ url('js/button.js') }}"></script>
@endsection
