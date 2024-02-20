@extends('components.managementlayout')

@section('title', '商品詳細編集')

{{-- <?php dd($tags); ?> --}}
@section('css')
    <link rel="stylesheet" href="{{ url('css/management.css') }}">
@endsection

@section('main')
    <section class="flex-center">
        <!-- 画面左側 -->
        <h3 class="topic-font">商品内容を変更する</h3>
        <section class="textbackground">

            <div class="flex-column">
                {{-- メイン情報更新/削除 --}}
                <p class="middlefont">&laquo;メイン情報変更&raquo;</p>
                <form method="post" action="{{ route('cakes.cake.update', $cakeinfo) }}" enctype="multipart/form-data"
                    id="update_cake" class="update">
                    @method('PATCH')
                    @csrf

                    {{-- ケーキの写真 --}}
                    <p class="form-font">現在の写真</p>
                    <div class="flex-row">
                        <div class="flex-column">
                            <img src="{{ asset($info->mainphoto) }}" class="editphoto" alt="ケーキの写真" accept=".jpg,.png">
                        </div>
                        <div class="flex-column">
                            {{-- 写真の選択 --}}
                            <input type="file" name="mainphoto" value="{{ $info->mainphoto }}" class="file">
                            @error('mainphoto')
                                <div class="error">{{ $message }}</div>
                            @enderror

                            <div>
                                {{-- 商品名 --}}
                                <div class="flex-row">
                                    <p class="form-font">商品名　　　：</p>
                                    <div class="flex-column">
                                        <input type="text" name="cakename" size="20" value="{{ $info->cakename }}"
                                            class="value-font cakeform">
                                        @error('cakename')
                                            <div class="error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- トピック --}}
                                <div class="flex-row">
                                    <p class="form-font">ひとこと説明：</p>
                                    <div class="flex-column">
                                        <input type="text" name="topic" size="20" value="{{ $info->topic }}"
                                            class="value-font cakeform">
                                        @error('topic')
                                            <div class="error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="flex-row">
                                    {{-- 商品コード --}}
                                    <p class="form-font">商品コード　：</p>
                                    <div class="flex-column">
                                        <p>{{ $info->cakecode }}</p>
                                        <input type="hidden" name="cakecode" size="7" value="{{ $info->cakecode }}"
                                            class="value-font cakeform">
                                        @error('cakecode')
                                            <div class="error">{{ $message }}</div>
                                        @enderror
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
                                                    <p class="form-font">{{ $cakecode->cakecode }}</p>
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
                                                    <p class="value-font">{{ $cakename->cakename }}</p>
                                                </div>
                                            @empty
                                                <p class="value-font">まだ商品がありません</p>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>


                    {{-- 説明文//改行適応させたい --}}
                    <div>
                        <p class="form-font">説明文：</p>
                        <textarea name="explain"class="cakeformbox">{{ $info->explain }}</textarea>
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
            </div>

            {{-- 大きさと価格の追加/削除 --}}
            <div class="flex-culomn">
                <h3 class="middlefont">&laquo;内容量と価格の設定&raquo;</h3>
                <div class="flex-column">
                    <form method="post" action="{{ route('cakes.price.criate', $info) }}" id="update_price"
                        class="flex-row update">
                        @csrf
                        <input type="hidden" name='id' value="{{ $info->id }}">
                        <div class="flex-row">
                            <div class="flex-row">
                                <p class="form-font">内容量：</p>
                                <div>
                                    <input type="text" name="capacity" size="10" class="cakeform">
                                    @error('capacity')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="flex-row">
                                <p class="form-font">価格　：</p>
                                <div>
                                    <input type="text" name="price" size="10" class="cakeform">
                                    @error('price')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>
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
                                    <p class="value-font">{{ $price->capacity }}</p>
                                </div>
                                <div class="flex-row">
                                    <p class="form-font"> 価格　：</p>
                                    <p class="value-font">￥{{ $price->price }}円</p>
                                </div>
                                <input type="hidden" name="info" value="{{ $info->id }}">
                                <button class="button">消去</button>
                            </form>
                        @empty
                            <p>バリエーションを追加してください</p>
                        @endforelse
                    </div>
                </div>
                {{-- タグに関する表示 --}}
                <h3 class="middlefont">&laquo;設定タグ追加と一覧&raquo;</h3>

                <form method="POST" action="{{ route('cakes.tag.criate', $info) }}" class="update flex-row">
                    @csrf
                    <p class="form-font">タグ名：</p>
                    <div class="flex-column">
                        <input type="hidden" name="cake_infos_id" value="{{ $info->id }}">
                        <input type="text" name="tag" size="15" class="cakeform">
                        @error('tag')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                    <button>追加</button>
                </form>
                @forelse ($tags as $tag)
                    <form method="POST" action="{{ route('cakes.tag.destroy', $tag) }}" class="delete flex-column">
                        @method('DELETE')
                        @csrf
                        <div class="flex-row">
                            <p class="form-font">{{ $tag->tag }}</p>
                            <input type="hidden" name="info" value="{{ $info->id }}">
                            <button>削除</button>
                        </div>
                    </form>
                @empty
                    <p class="form-font">まだ設定されていません</p>
                @endforelse
            </div>

            <h3 class="middlefont">&laquo;ギャラリーの設定&raquo;</h3>
            <p class="form-font">新規追加</p>
            <form method="post" action="{{ route('cakes.photo.criate', $info) }}" enctype="multipart/form-data"
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
                    <input type="text" name="photoname" size="10" class="value-font cakeform">
                    @error('photoname')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                <button class="button">追加するよ！</button>
            </form>

            <h3 class="middlefont">&laquo;既存のギャラリー&raquo;</h3>
            <div class="gallery">
                @forelse ($subphotos as $subphoto)
                    <object>
                        <img src=" {{ asset($subphoto->subphotos) }}" alt="商品画像"width="200px">
                        <input type="hidden" name="info" value="{{ $info->id }}">
                        <div class="flex-row item-end">
                            <p>{{ $subphoto->photoname }}</p>
                            <form method="post" action="{{ route('cakes.photo.destroy', $subphoto) }}" class="delete">
                                @method('DELETE')
                                @csrf
                                <button class="button">消去</button>
                            </form>
                        </div>
                    </object>
                @empty
                    <p>バリエーションを追加してください</p>
                @endforelse
            </div>
        </section>
    </section>
@endsection

@section('js')
    <script src="{{ url('js/button.js') }}"></script>
@endsection
