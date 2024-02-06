@extends('components.managementlayout')

@section('css')
    <link rel="stylesheet" href="{{ url('css/font.css') }}">
    <link rel="stylesheet" href="{{ url('css/aside.css') }}">
    <link rel="stylesheet" href="{{ url('css/form.css') }}">
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
                </div>
                @error('mainphoto')
                    <div class="error">{{ $message }}</div>
                @enderror
                <div class="flex-row">
                    <p class="form-font">商品名：</p>
                    <div>
                        <input type="text" name="cakename" size="20" class="cakeform" value="{{old('cakename')}}">
                        @error('cakename')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="flex-row">
                    <div class="flex-row">
                        <p class="form-font">商品コード:</p>
                        <div>
                            <input type="text" name="cakecode" size="7" placeholder="#000000" value="{{old('cakecode')}}">
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
                                        <p class="value-font">{{ $cakecode->cakecode }} </p>
                                    </div>
                                @empty
                                    <p class="form-font">まだ商品がありません</p>
                                @endforelse
                            </div>

                            <div class="flex-column">
                                @forelse ($cakenames as $cakename)
                                    <div class="flex-row">
                                        <p class="form-font">商品名：</p>
                                        <p class="value-font">{{ $cakecode->cakename }}</p>
                                    </div>

                                @empty
                                    <p class="value-font">まだ商品がありません</p>
                                @endforelse
                            </div>

                        </div>
                    </div>

                </div>
                <div class="flex-row">
                    <p class="form-font">ひとこと説明：</p>
                    <div>
                        <input type="text" name="topic" size="20" class="value-font cakeform"  value="{{old('topic')}}">
                        @error('topic')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="flex-row">
                    <p class="form-font">内容量：</p>
                    <div>
                        <input type="text" name="capacity" size="5" class="value-font cakeform"  value="{{old('capacity')}}">
                        @error('capacity')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <div class="flex-row">
                            <p class="form-font">価格：</p>
                            <input type="text" name="price" size="7" class="value-font cakeform" value="{{old('price')}}">
                            <p class="form-font">円</p>
                        </div>
                        @error('price')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
                <div class="flex-row">
                    <p class="form-font">説明文：</p>
                        <textarea name="explain" class="value-font cakeformbox" placeholder="">{{old('explain')}}</textarea>
                </div>
                        @error('explain')
                            <div class="error">{{ $message }}</div>
                        @enderror
                <button class="button" id="addcake">追加するよ！</button>
            </form>
        </section>
    </section>
@endsection

@section('js')
    <script src="{{ url('js/button.js') }}"></script>
@endsection

