@extends('components.managementlayout')

@section('css')
    <link rel="stylesheet" href="{{ url('css/font.css') }}">
    <link rel="stylesheet" href="{{ url('css/aside.css') }}">
    <link rel="stylesheet" href="{{ url('css/cakephotos.css') }}">
@endsection

@section('main')
    <section class="flex-center">
        <!-- 画面左側 -->
        <h3 class="bigfont textbackground">商品内容を変更する</h3>
        <section class="textbackground">

            {{-- メイン情報更新/削除 --}}
            <p class="form-font">&laquo;メイン情報変更&raquo;</p>
            <form method="post" action="{{ route('cakes.cake.update', $info) }}" enctype="multipart/form-data"
                id="update_cake" class="update">
                @method('PATCH')
                @csrf

                {{-- ケーキの写真 --}}
                <p class="form-font">現在の写真</p>
                <div class="flex-row">
                    <div class="flex-column">
                        <img src="{{ asset($info->mainphoto) }}" class="management-photo" alt="ケーキの写真" accept=".jpg,.png">
                    </div>
                    <div class="flex-column">
                        {{-- 写真の選択 --}}
                        <input type="file" name="mainphoto" value="{{ $info->mainphoto }}">
                        @error('mainphoto')
                            <div class="error">{{ $message }}</div>
                        @enderror

                        <div class="flex-row">
                            <div>
                                {{-- 商品名 --}}
                                <div class="flex-row">
                                    <p class="form-font">商品名　　　：</p>
                                </div>
                                @error('cakename')
                                    <div class="error">{{ $message }}</div>
                                @enderror

                                <div class="flex-row">
                                    {{-- 商品コード --}}
                                    <p class="form-font">商品コード　：</p>
                                </div>
                                @error('cakecode')
                                    <div class="error">{{ $message }}</div>
                                @enderror

                                {{-- トピック --}}
                                <div class="flex-row">
                                    <p class="form-font">ひとこと説明：</p>
                                </div>
                                @error('topic')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                            <div>
                                {{-- 商品名 --}}
                                <div class="flex-row">
                                    <input type="text" name="cakename" size="20" value="{{ $info->cakename }}"
                                        class="value-font">
                                </div>
                                @error('cakename')
                                    <div class="error">{{ $message }}</div>
                                @enderror

                                <div class="flex-row">
                                    {{-- 商品コード --}}
                                    <input type="text" name="cakecode" size="7" value="{{ $info->cakecode }}"
                                        class="value-font">
                                </div>
                                @error('cakecode')
                                    <div class="error">{{ $message }}</div>
                                @enderror

                                {{-- トピック --}}
                                <div class="flex-row">
                                    <input type="text" name="topic" size="20" value="{{ $info->topic }}"
                                        class="value-font">
                                </div>
                                @error('topic')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- 既存のコードと商品名 --}}
                    <div>
                        <p class="form-font">既存の商品コード</p>
                        <div class="flex-row">

                            {{-- 既存のコード --}}
                            <div class="flex-column">
                                @forelse ($cakecodes as $cakecode)
                                    <div class="flex-row">
                                        <p class="form-font">商品コード：</p>
                                        <p class="value-font">{{ $cakecode->cakecode }}</p>
                                    </div>
                                @empty
                                    <p>まだ商品がありません</p>
                                @endforelse
                            </div>

                            {{-- 対応する商品名 --}}
                            <div class="flex-column">
                                @forelse ($cakenames as $cakename)
                                    <div class="flex-row">
                                        <p class="form-font"> 商品名：</p>
                                        <p class="value-font">{{ $cakecode->cakename }}</p>
                                    </div>
                                @empty
                                    <p class="value-font">まだ商品がありません</p>
                                @endforelse
                            </div>
                        </div>
                    </div>


                </div>

                {{-- 説明文//改行適応させたい --}}
                <div>
                    <p class="form-font">説明文：</p>
                    <textarea name="explain" cols="80" rows="5">{{ $info->explain }}</textarea>
                    @error('explain')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                <div class="flex-row item-end">
                    <button class="button" id="button">更新</button>
                </div>
            </form>
            <form method="post" action="{{ route('cakes.cake.destroy', $info) }}" class="delete flex-row item-end">
                @method('DELETE')
                @csrf
                <button class="button">削除</button>
            </form>




            {{-- 大きさと価格の追加/削除 --}}
            <h3 class="form-font">&laquo;内容量と価格の設定&raquo;</h3>
            <div class="flex-row">
                <form method="post" action="{{ route('cakes.price.criate', $info) }}" id="update_price"
                    class="flex-row update">
                    @csrf
                    <input type="hidden" name='id' value="{{ $info->id }}">
                    <div class="flec-column">
                        <p class="form-font">内容量：</p>
                        <p class="form-font">価格　：</p>
                    </div>
                    <div class="flec-column">
                        <div>
                            <input type="text" name="price" size="10">
                            @error('price')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <input type="text" name="capacity" size="10">
                            @error('capacity')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div>
                        <button class="button">追加</button>
                    </div>

                </form>

                {{-- 既存の大きさと価格の表示 --}}
                <div>
                    @forelse ($prices as $price)
                        <form method="post" action="{{ route('cakes.price.destroy', $price) }}"
                            class="flex-row delete">
                            @method('DELETE')
                            @csrf
                            <div class="flex-row">
                                <p class="form-font">内容量：</p>
                                <p>{{ $price->capacity }}</p>
                            </div>
                            <div class="flex-row">
                                <p class="form-font"> 価格　：</p>
                                <p class="value-font">{{ $price->price }}円</p>
                            </div>
                            <input type="hidden" id="info" value="{{ $info }}">
                            <button class="button">消去</button>
                        </form>
                    @empty
                        <p>バリエーションを追加してください</p>
                    @endforelse
                </div>
            </div>




            <h3 class="form-font">&laquo;ギャラリーの設定&raquo;</h3>
            <p class="form-font">新規追加</p>
            <form method="post" action="{{ route('cakes.photo.criate') }}" enctype="multipart/form-data"
                id="update_subphoto"class="update flex-row">
                @csrf
                <input type="hidden" name='cake_photos_id' value="{{ $info->id }}">
                <div class="flex-column">
                    <p class="form-font">写真を選択してください： </p>
                    <p class="form-font">写真の名前　　　　　　：</p>
                </div>
                <div class="flex-column">
                    <input type="file" name="subphotos" accept=".jpg,.png">
                    @error('subphotos')
                        <div class="error">{{ $message }}</div>
                    @enderror
                    <input type="text" name="photoname" size="10" class="value-font">
                    @error('photoname')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                <button class="button">追加するよ！</button>
            </form>

            <h3 class="form-font">&laquo;既存のギャラリー&raquo;</h3>
            <div class="gallery">
                @forelse ($subphotos as $subphoto)
                    <form method="post" action="{{ route('cakes.photo.destroy', $subphoto) }}" class="delete">
                        @method('DELETE')
                        @csrf
                        <object>
                            <img src=" {{ asset($subphoto->subphotos) }}" alt=""width="200px">
                            <input type="hidden" id="subphoto" value="{{ $subphoto }}">
                            <div class="flex-row item-end">
                                <p>{{ $subphoto->photoname }}</p>
                                <button class="button">消去</button>
                            </div>
                        </object>
                    </form>
                @empty
                    <p>バリエーションを追加してください</p>
                @endforelse
            </div>

        </section>
    </section>
    <script src="{{ url('js/button.js') }}"></script>
@endsection
