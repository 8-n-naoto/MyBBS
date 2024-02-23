@extends('components.managementlayout')

@section('title', '商品詳細編集')

{{-- <?php dd($cakeinfo); ?> --}}
@section('css')
    <link rel="stylesheet" href="{{ url('css/management.css') }}">
@endsection

@section('main')
    <section class="">
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
                    <div class="flex-row">
                        <div class="flex-column">
                            <p class="middlefont">現在の写真</p>
                            <img src="{{ asset($info->mainphoto) }}" class="editphoto" alt="ケーキの写真" accept=".jpg,.png">
                            {{-- 写真の選択 --}}
                            <input type="file" name="mainphoto" value="{{ $info->mainphoto }}" class="file">
                            @error('mainphoto')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="flex-column">
                            <table class="cakeinfo">
                                <tbody>
                                    <tr>
                                        <td class="form-font">商品名</td>
                                        <td>
                                            <input type="text" name="cakename" value="{{ $info->cakename }}"
                                                class="formfont">
                                            @error('cakename')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="form-font">ひとこと説明</td>
                                        <td> <input type="text" name="topic" size="20" value="{{ $info->topic }}"
                                                class="value-font cakeform">
                                            @error('topic')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="form-font">商品コード</td>
                                        <td>
                                            <p class="form-font">{{ $info->cakecode }}</p>
                                            <input type="hidden" name="cakecode" size="7"
                                                value="{{ $info->cakecode }}" class="value-font cakeform">
                                            @error('cakecode')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </td>
                                    </tr>
                                </tbody>
                            </table>


                            <p class="middlefont">既存の商品コード</p>
                            <table class="cakecode">
                                @forelse ($cakeinfos as $cakeinfo)
                                    <tr>
                                        <td class="form-font">商品コード</td>
                                        <td class="form-font">{{ $cakeinfo->cakecode }}</td>
                                        <td class="form-font">商品名</td>
                                        <td>{{ $cakeinfo->cakename }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="form-font"></td>
                                        <td class="form-font"></td>
                                        <td class="form-font">まだ商品がありません</td>
                                        <td></td>
                                    </tr>
                                @endforelse
                            </table>

                        </div>
                    </div>

                    {{-- 説明文//改行適応させたい --}}
                    <div>
                        <p class="middlefont">説明文</p>
                        <textarea name="explain"class="edit-textarea">{{ $info->explain }}</textarea>
                        @error('explain')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="flex-row">
                        <button class="item-end" id="button">更新</button>
                </form>
                <form method="post" action="{{ route('cakes.cake.destroy', $info) }}" class="delete flex-row item-end">
                    @method('DELETE')
                    @csrf
                    <button class="item-end">削除</button>
                </form>
            </div>
            </div>



            <table>
                <td>

                    {{-- 大きさと価格の追加/削除 --}}
                    <h3 class="middlefont">&laquo;内容量と価格の設定&raquo;</h3>
                    <table class="cakecode" id="price">
                        <tbody class="pricetable">
                            <form method="post" action="{{ route('cakes.price.criate', $info) }}" id="update_price"
                                class="flex-row update">
                                @csrf
                                <tr>
                                    <td class="form-font">内容量</td>
                                    <td class="form-font">
                                        <input type="text" name="capacity" class="capacity">
                                        @error('capacity')
                                            <div class="error">{{ $message }}</div>
                                        @enderror
                                    </td>
                                    <td class="form-font">価格</td>
                                    <td class="form-font">
                                        ￥<input type="text" name="price" class="price">円
                                        @error('price')
                                            <div class="error">{{ $message }}</div>
                                        @enderror
                                    </td>
                                    <td>
                                        <input type="hidden" name='id' class="cake_id" value="{{ $info->id }}">
                                        <button type="button" class="button priceadd">追加</button>
                                    </td>
                                </tr>
                            </form>
                            {{-- 既存の大きさと価格の表示 --}}

                            @if ($prices)
                                @forelse ($prices as $price)
                                    <tr id="deleteprice">
                                        <td class="form-font">内容量</td>
                                        <td class="form-font">{{ $price->capacity }}</td>
                                        <td class="form-font">価格</td>
                                        <td class="form-font">￥{{ $price->price }}円</td>
                                        <td>
                                            <form method="post" action="{{ route('cakes.price.destroy', $price) }}"
                                                class="flex-row delete">
                                                @method('DELETE')
                                                @csrf
                                                <input type="hidden" name='id' value="{{ $cakeinfo->id }}">
                                                <input type="hidden" name='price_id' value="{{ $price->id }}">
                                                <button type="button" class="pricedelete">消去</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="form-font"></td>
                                        <td class="form-font"></td>
                                        <td class="form-font">まだ商品がありません</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                @endforelse
                            @endif

                        </tbody>
                    </table>
                </td>
                <td>

                    {{-- タグに関する表示 --}}
                    <h3 class="middlefont">&laquo;設定タグ追加と一覧&raquo;</h3>
                    <table class="cakecode" id="tag">
                        <tbody class="tagtable">
                            <form method="POST" action="{{ route('cakes.tag.criate', $info) }}"
                                class="update flex-row">
                                @csrf
                                <tr>
                                    <td class="form-font">タグ名</td>
                                    <td class="form-font">
                                        <input type="hidden" name="cake_infos_id" value="{{ $info->id }}">
                                        <input type="text" name="tag" size="15" class="tag">
                                        @error('tag')
                                            <div class="error">{{ $message }}</div>
                                        @enderror
                                    </td>
                                    <td class="form-font">

                                        <input type="hidden" name='id' class="cake_id"
                                            value="{{ $info->id }}">
                                        <button type="button" class="tagadd">追加</button>
                                    </td>
                                </tr>
                            </form>
                            {{-- 既存の大きさと価格の表示 --}}

                            @if ($tags)
                                @forelse ($tags as $tag)
                                    <tr id="deletetag">
                                        <td class="form-font"></td>
                                        <td class="form-font">{{ $tag->tag }}</td>
                                        <td class="form-font">
                                            <form method="POST" action="{{ route('cakes.tag.destroy', $tag) }}"
                                                class="delete flex-column">
                                                @method('DELETE')
                                                @csrf
                                                <input type="hidden" name="info" value="{{ $info->id }}">
                                                <input type="hidden" name='tag_id' value="{{ $tag->id }}">
                                                <button type="button" class="tagdelete">削除</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="form-font"></td>
                                        <td class="form-font"></td>
                                        <td class="form-font">まだ商品がありません</td>
                                    </tr>
                                @endforelse
                            @endif
                    </table>
                    </tbody>
                </td>
            </table>

            <table class="newphoto">
                <form method="post" action="{{ route('cakes.photo.criate') }}" enctype="multipart/form-data"
                    id="update_subphoto"class="update flex-row">
                    @csrf
                    <input type="hidden" name='cake_id' value="{{ $info->id }}">
                    <tr>
                        <td class="form-font">画像を選択する</td>
                        <div><output id="output1"></output></div>
                        <td class="form-font">
                            <input type="file" name="subphotos" accept=".jpg,.png" class="galleryphoto"
                                id="galleryphoto">
                            @error('subphotos')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </td>
                        <td class="form-font">画像の名前</td>
                        <td class="form-font">
                            <input type="text" name="photoname" size="10"
                                class="value-font cakeform galleryname" style="width: 240px">
                            @error('photoname')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </td>
                        <td>
                            <button type="button" class="galleryadd">追加</button>
                        </td>
                    </tr>
                </form>
            </table>

            <h3 class="middlefont">既存のギャラリー</h3>
            <div class="cakephotos" id="gallery">
                @forelse ($subphotos as $subphoto)
                    <object class="gallery">
                        <img src=" {{ asset($subphoto->subphotos) }}" alt="商品画像"width="200px">
                        <div class="flex-row item-end">
                            <p>{{ $subphoto->photoname }}</p>
                            <form method="post" action="{{ route('cakes.photo.destroy', $subphoto) }}" class="delete">
                                @method('DELETE')
                                @csrf
                                <input type="hidden" name="info" value="{{ $info->id }}">
                                <input type="hidden" name="gallery_id" value="{{ $subphoto->id }}">
                                <button class="gallerydelete">消去</button>
                            </form>
                        </div>
                    </object>
                @empty
                    <p>画像を追加してください</p>
                @endforelse
            </div>
        </section>
    </section>
@endsection

@section('js')
    <script>
        // 金額関係のスクリプト
        // 金額追加
        (function($) {
            $('.priceadd').on('click', function(e) {
                e.preventDefault();
                if (confirm('追加しますか？')) {
                    //保存するデータ
                    var capacity = $('.capacity').val();
                    var price = $('.price').val();
                    var cake_id = $('.cake_id').val();
                    var CSRF = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        url: "{{ route('cakes.price.criate') }}",
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content'),
                        },
                        method: "POST",
                        data: {
                            "cake_id": cake_id,
                            "capacity": capacity,
                            "price": price,
                        },
                        // 生成する要素群
                        success: function(response) {
                            $('.pricetable').append(`
                             <tr id="deleteprice">
                                    <td class="form-font">内容量</td>
                                    <td class="form-font">${capacity} </td>
                                    <td class="form-font">価格</td>
                                    <td class="form-font">￥${price}円</td>
                                    <td>
                                        <form method="post" action="{{ route('cakes.price.destroy') }}?${response.price_id}" class="flex-row delete">
                                            <input type="hidden" name="_token" value="${CSRF}" autocomplete="off">
                                                    <input type="hidden" name='id' value="{{ $cakeinfo->id }}">
                                                    <input type="hidden" name='price_id' value="${response.price_id}">
                                                    <button type="button" class="pricedelete">消去</button>
                                        </form>
                                    </td>
                            </tr>
          `)
                        }
                        // dataType: "",
                    }).done(function(response) {
                        console.log('通信成功');
                        console.log(response);

                    }).fail(function() {
                        alert('情報が誤っています');
                    }).always(function() {
                        console.log('実行しました');
                        // success: function(json){
                        // }
                    });
                }


            });
        })(jQuery);

        // 金額削除
        (function($) {
            $('.pricedelete').on('click', function(e) {
                e.preventDefault();
                // 渡すデータ
                var price_id = $(this).siblings('#price [name="price_id"]').val();
                var CSRF = $('meta[name="csrf-token"]').attr('content');
                //削除する要素
                var delete_price = $(this).parent().parent().parent();

                if (confirm('削除しますか？')) {
                    $.ajax({
                        url: "{{ route('cakes.price.destroy') }}",
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content'),
                        },
                        method: "POST",
                        data: {
                            "price_id": price_id,
                        },
                        success: function() {
                            //要素の削除
                            delete_price.remove();
                        },
                        // dataType: "",
                    }).done(function() {
                        console.log('通信成功');
                    }).fail(function() {
                        alert('失敗しました');
                    }).always(function() {
                        console.log('実行しました');
                    });
                }
            });
        })(jQuery);

        //  タグ関係のスクリプト
        // タグ作成
        (function($) {
            $('.tagadd').on('click', function(e) {

                e.preventDefault();
                if (confirm('追加しますか？')) {

                    var tag = $('.tag').val();
                    var cake_infos_id = $('.cake_id').val();
                    var CSRF = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        url: "{{ route('cakes.tag.criate') }}",
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content'),
                        },
                        method: "POST",
                        data: {
                            "cake_infos_id": cake_infos_id,
                            "tag": tag,

                        },
                        // dataType: "",
                    }).done(function(response) {
                        console.log('通信成功');
                        $('.tagtable').append(`
                          <tr>
                            <td class="form-font"></td>
                            <td class="form-font">${tag}</td>
                            <td class="form-font">
                                <form method="POST" action="{{ route('cakes.tag.destroy') }}" class="delete flex-column">
                                    <input type="hidden" name="cake_id" value="${response.cake_id}">
                                    <input type="hidden" name='tag_id' value="${response.id}">
                                    <input type="hidden" name="_token" value="${CSRF}" autocomplete="off">
                                    <button type="button" class="tagdelete">削除</button>
                                </form>
                            </td>
                          </tr>
                     `)
                    }).fail(function() {
                        alert('情報が誤っています');
                    }).always(function() {
                        console.log('実行しました');
                        console.log($('.cake_id').val());
                        // success: function(json){
                        // }
                    });
                }

            });
        })(jQuery);

        // タグ削除処理
        (function($) {
            $('.tagdelete').on('click', function(e) {
                e.preventDefault();
                // 渡すデータ
                var tag_id = $(this).siblings('#tag [name="tag_id"]').val();
                var CSRF = $('meta[name="csrf-token"]').attr('content');
                //削除する要素
                var delete_tag = $(this).parent().parent().parent();

                if (confirm('削除しますか？')) {
                    $.ajax({
                        url: "{{ route('cakes.tag.destroy') }}",
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content'),
                        },
                        method: "POST",
                        data: {
                            "tag_id": tag_id,
                        },
                        success: function() {
                            //要素の削除
                            delete_tag.remove();
                        },
                        // dataType: "",
                    }).done(function() {
                        console.log('通信成功');
                        //要素の削除
                        delete_tag.remove();

                    }).fail(function() {
                        alert('失敗しました');
                        console.log('通信失敗');
                    }).always(function() {
                        console.log('実行しました');
                    });
                }
            });
        })(jQuery);

        //  gallery関係
        // ギャラリー作成
        (function($) {
            $('.galleryadd').on('click', function(e) {
                e.preventDefault();
                var CSRF = $('meta[name="csrf-token"]').attr('content');
                var galleryname = $('.galleryname').val();
                var cake_id = $('.cake_id').val();

                //file関係の処理
                var file = document.getElementById('galleryphoto').files[0];
                var form = new FormData();
                //フォームデータにアップロードファイルの情報追加
                form.append("subphotos", file);
                form.append("photoname", galleryname);
                form.append("cake_id", cake_id);

                if (confirm('追加しますか？')) {
                    $.ajax({
                        url: "{{ route('cakes.photo.criate') }}",
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content'),
                        },
                        method: "POST",
                        data: form,
                        contentType: false,
                        processData: false,
                    }).done(function(response) {
                        console.log('通信成功');
                        $('.cakephotos').append(`
                        <object class="gallery">
                            <img src="  http://57.181.132.42/storage/images/${file.name}" alt="商品画像"width="200px">
                            <div class="flex-row item-end">
                                <p>${galleryname}</p>
                                <form method="post" action="{{ route('cakes.photo.destroy') }}" class="delete">
                                @method('DELETE')
                                @csrf
                                <input type="hidden" name="info" value="{{ $info->id }}">
                                <button type="button" class="gallerydelete">消去</button>
                            </form>
                            </div>
                        </object>
                  `)
                    }).fail(function() {
                        console.log('通信失敗');
                        alert('情報が不足しています');
                    }).always(function() {
                        console.log('実行しました');
                    });
                }
            });
        })(jQuery);

        // ギャラリー削除
        (function($) {
            $('.gallerydelete').on('click', function(e) {
                e.preventDefault();
                // 渡すデータ
                var gallery_id = $(this).siblings('#gallery [name="gallery_id"]').val();
                var CSRF = $('meta[name="csrf-token"]').attr('content');
                //削除する要素
                var delete_gallery = $(this).parent().parent().parent();
                if (confirm('削除しますか？')) {
                    $.ajax({
                        url: "{{ route('cakes.photo.destroy') }}",
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content'),
                        },
                        method: "POST",
                        data: {
                            "gallery_id": gallery_id,
                        },
                        // dataType: "",
                        success: function() {
                            //要素の削除
                            delete_gallery.remove();
                        },
                    }).done(function() {
                        console.log('通信成功');
                    }).fail(function() {
                        alert('失敗しました');
                    }).always(function() {
                        console.log('実行しました');
                    });
                }
            });
        })(jQuery);
    </script>




    <script src="{{ url('js/button.js') }}"></script>
    {{-- <script>
        'use strict';
        var file = document.getElementById('galleryphoto');

        function fileChange(ev) {
            var target = ev.target;
            var files = target.files;

            console.log(files);
        }
        file.addEventListener('change', fileChange, false);
    </script> --}}
@endsection
