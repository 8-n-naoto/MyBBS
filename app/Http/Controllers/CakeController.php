<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CakeInfo;
use App\Models\Tag;
use App\Models\CakeInfoSub;
use App\Models\CakePhoto;
use App\Models\BasicIngredient;
use App\Models\EachIngredient;
use GuzzleHttp\Promise\Each;

class CakeController extends Controller
{
    //ON/OFF画面
    public function _suitch()
    {
        $infos = CakeInfo::all();
        return view('management.edits')
            ->with([
                'cakeinfos' => $infos,
                'infos' => $infos,
            ]);
    }

    //商品表示ON/OFF切り替え機能
    public function _boolean(Request $request, CakeInfo $cakeinfo)
    {
        //トークン再生成
        $request->session()->regenerateToken();

        $request->validate([
            'boolean' => 'required',
        ], [
            'boolean.required' => '必要な情報が不足しています',
        ]);


        $cakeinfo->boolean = $request->boolean;
        $cakeinfo->save();

        return redirect()
            ->route('cakes.switch');
    }

    //個別詳細変更画面
    public function _update_store(CakeInfo $cakeinfo)
    {
        $infos = CakeInfo::all();
        $cakephotos = CakePhoto::where('cake_photos_id', $cakeinfo->id)->get();
        $prices = CakeInfoSub::where('cake_infos_id', $cakeinfo->id)->get();
        $cakeID = $cakeinfo->id;
        $tags = Tag::where('cake_infos_id', $cakeID)->get();

        return view('management.edit')
            ->with([
                'cakeinfos' => $infos,
                'cakeinfo' => $cakeinfo,
                'info' => $cakeinfo,
                'prices' => $prices,
                'cakecodes' => $infos,
                'cakenames' => $infos,
                'subphotos' => $cakephotos,
                'tags' => $tags,
            ]);
    }

    //商品追加ページ
    public function _criate_store()
    {
        $infos = CakeInfo::all();
        return view('management.create')
            ->with([
                'cakeinfos' => $infos,
                'cakecodes' => $infos,
                'cakenames' => $infos,
            ]);
    }

    //商品追加用処理
    public function _cake_criate(Request $request)
    {
        //トークン再生成
        $request->session()->regenerateToken();

        //バリデート
        $request->validate([
            'cakename' => 'required|unique:cake_infos',
            // 'topic' => 'required',
            'explain' => 'required',
            'cakecode' => 'required|unique:cake_infos',
            'cakename' => 'required',
            'mainphoto' => 'required',
            'capacity' => 'required',
            'price' => 'required',
        ], [
            'users_id.required' => 'ログインしてください',
            'cakename.required' => 'ケーキの名前を入力してください',
            'cakename.unique' => '同じ商品名がすでに使われています',
            // 'topic.required' => 'ひとこと説明を入力してください',
            'explain.required' => '説明を入力してください',
            'cakecode.required' => '商品コードを入力してください',
            'cakecode.unique' => 'この商品コードはすでに使われています',
            'cakename.required' => 'ケーキの名前を入力してください',
            'mainphoto.required' => 'ケーキの写真を追加してください',
            'capacity.required' => '大きさや内容量を入力してください',
            'price.required' => '価格を追加してください',
        ]);

        $post = new CakeInfo();
        $post->cakename = $request->cakename;
        $post->topic = $request->topic;
        $post->explain = $request->explain;
        $post->cakecode = $request->cakecode;
        // name属性が'images'のinputタグをファイル形式に、画像をpublic/imagesに名前付きで保存
        $image_path = $request->file('mainphoto')->getClientOriginalName();
        // 上記処理にて保存した画像に名前を付け、Cakeinfoテーブルのimagesカラムをパスに形にして名前を付ける
        $request->file('mainphoto')->storeAs('public/images/' . $image_path);
        //名前を保存
        $post->mainphoto = 'storage/images/' . $image_path;
        $post->save();

        $id = $post->id;
        $post = new CakeInfoSub();
        $post->cake_infos_id = $id;
        $post->capacity = $request->capacity;
        $post->price = $request->price;
        $post->save();


        return redirect()
            ->route('cakes.switch');
    }

    //更新処理
    public function _cake_update(Request $request, CakeInfo $cakeinfo)
    {
        //トークン再生成
        $request->session()->regenerateToken();

        //バリデート
        $request->validate([
            'cakename' => 'required',
            'mainphoto' => 'required',
            // 'topic' => 'required',
            'explain' => 'required',
            'cakecode' => 'required',
        ], [
            'cakename.required' => '商品名を入力してください',
            // 'topic.required' => 'ひとこと説明を入力してください',
            'explain.required' => '説明を入力してください',
            'cakecode.required' => '商品コードを入力してください',
            'mainphoto.required' => 'ケーキの写真を追加してください',
        ]);

        $cakeinfo->cakename = $request->cakename;
        $cakeinfo->cakecode = $request->cakecode;
        $cakeinfo->topic = $request->topic;
        $cakeinfo->explain = $request->explain;

        // name属性が'images'のinputタグをファイル形式に、画像をpublic/imagesにファイル名で保存
        $image_path = $request->file('mainphoto')->getClientOriginalName();
        // 上記処理にて保存した画像に名前を付け、Cakeinfoテーブルのimagesカラムにパスの形式にして、格納
        $request->file('mainphoto')->storeAs('public/images/' . $image_path);
        $cakeinfo->mainphoto = 'storage/images/' . $image_path;
        $cakeinfo->save();


        $infos = CakeInfo::all();
        $cakephotos = CakePhoto::where('cake_photos_id', $cakeinfo->id)->get();
        $prices = CakeInfoSub::where('cake_infos_id', $cakeinfo->id)->get();
        $cakeID = $cakeinfo->id;
        $tags = Tag::where('cake_infos_id', $cakeID)->get();

        return view('management.edit')
            ->with([
                'cakeinfos' => $infos,
                'cakeinfo' => $cakeinfo,
                'info' => $cakeinfo,
                'prices' => $prices,
                'cakecodes' => $infos,
                'cakenames' => $infos,
                'subphotos' => $cakephotos,
                'tags' => $tags,
            ]);
    }

    //商品更新処理（price）
    public function _price_criate(Request $request, CakeInfo $cakeinfo)
    {
        //トークン再生成
        $request->session()->regenerateToken();

        $request->validate([
            'capacity' => 'required',
            'price' => 'required',
        ], [
            'capacity.required' => '大きさや内容量を入力してください',
            'price.required' => '価格を追加してください',
        ]);

        $post = new CakeInfoSub();
        $post->cake_infos_id = $request->id;
        $post->capacity = $request->capacity;
        $post->price = $request->price;
        $post->save();


        $infos = CakeInfo::all();
        $cakephotos = CakePhoto::where('cake_photos_id', $cakeinfo->id)->get();
        $prices = CakeInfoSub::where('cake_infos_id', $cakeinfo->id)->get();
        $cakeID = $cakeinfo->id;
        $tags = Tag::where('cake_infos_id', $cakeID)->get();

        return view('management.edit')
            ->with([
                'cakeinfos' => $infos,
                'cakeinfo' => $cakeinfo,
                'info' => $cakeinfo,
                'prices' => $prices,
                'cakecodes' => $infos,
                'cakenames' => $infos,
                'subphotos' => $cakephotos,
                'tags' => $tags,
            ]);
    }

    //商品更新処理(photo)
    public function _photo_criate(CakeInfo $cakeinfo, Request $request)
    {
        //トークン再生成
        $request->session()->regenerateToken();

        //バリデート
        $request->validate([
            'cake_photos_id' => 'required',
            'photoname' => 'required',
            'subphotos' => 'required',
        ], [
            'cake_infos_id.required' => 'ログインしてください',
            'photoname.required' => 'ケーキの名前を入力してください',
            'subphotos.required' => '写真を選択してください',
        ]);

        $post = new CakePhoto();
        $post->cake_photos_id = $request->cake_photos_id;
        $post->photoname = $request->photoname;
        // // name属性が'images'のinputタグをファイル形式に、画像をpublic/imagesに名前付きで保存
        $image_path = $request->file('subphotos')->getClientOriginalName();
        // 上記処理にて保存した画像に名前を付け、Cakeinfoテーブルのimagesカラムをパスに形にして名前を付ける
        $request->file('subphotos')->storeAs('public/images/' . $image_path);
        //名前を保存
        $post->subphotos = 'storage/images/' . $image_path;
        $post->save();

        $infos = CakeInfo::all();
        $cakephotos = CakePhoto::where('cake_photos_id', $cakeinfo->id)->get();
        $prices = CakeInfoSub::where('cake_infos_id', $cakeinfo->id)->get();
        $cakeID = $cakeinfo->id;
        $tags = Tag::where('cake_infos_id', $cakeID)->get();

        return view('management.edit')
            ->with([
                'cakeinfos' => $infos,
                'cakeinfo' => $cakeinfo,
                'info' => $cakeinfo,
                'prices' => $prices,
                'cakecodes' => $infos,
                'cakenames' => $infos,
                'subphotos' => $cakephotos,
                'tags' => $tags,
            ]);
    }

    //商品情報更新用(tag)
    public function _tag_criate(CakeInfo $cakeinfo, Request $request)
    {
        //トークン再生成
        $request->session()->regenerateToken();

        $already = Tag::query()
            ->where('tag', $request->input('tag'))
            ->where('cake_infos_id', $request->input('cake_infos_id'))
            ->exists();

        if ($already) {
            return back()->withErrors([
                'tag' => '既に登録されております。'
            ]);
        }
        //バリデート
        $request->validate([
            'cake_infos_id' => 'required',
            'tag' => 'required',
        ], [
            'cake_infos_id.required' => '情報が不足しています',
            'tag.required' => 'タグ名を入力してください',
        ]);



        $post = new Tag();
        $post->cake_infos_id = $cakeinfo->id;
        $post->tag = $request->tag;
        $post->save();

        $infos = CakeInfo::all();
        $cakephotos = CakePhoto::where('cake_photos_id', $cakeinfo->id)->get();
        $prices = CakeInfoSub::where('cake_infos_id', $cakeinfo->id)->get();
        $cakeID = $cakeinfo->id;
        $tags = Tag::where('cake_infos_id', $cakeID)->get();


        return back('management.edit')
            ->with([
                'cakeinfos' => $infos,
                'cakeinfo' => $cakeinfo,
                'info' => $cakeinfo,
                'prices' => $prices,
                'cakecodes' => $infos,
                'cakenames' => $infos,
                'subphotos' => $cakephotos,
                'tags' => $tags,
            ]);
    }


    //商品情報削除用ページ
    public function _cake_destroy(CakeInfo $cakeinfo, Request $request)
    {
        //トークン再生成
        $request->session()->regenerateToken();

        //削除
        $cakeinfo->delete();
        //残りの値を渡して表示する。
        $cakeinfo = CakeInfo::all();
        return view('management.edits')
            ->with([
                'info' => $cakeinfo,
                'cakeinfos' => $cakeinfo,
            ]);
    }
    //商品情報削除用ページ(price)
    public function _price_destroy(Request $request, CakeInfoSub $cakeinfosub)
    {
        //トークン再生成
        $request->session()->regenerateToken();

        $cakeinfosub->delete();

        //残りの値を渡して表示する。
        $cakeinfo = $request->id;
        $infos = CakeInfo::all();
        $cakephotos = CakePhoto::where('cake_photos_id', $cakeinfo)->get();
        $prices = CakeInfoSub::where('cake_infos_id', $cakeinfo)->get();
        $cakeinfos = CakeInfo::find($cakeinfo);
        $tags = Tag::where('cake_infos_id', $cakeinfo)->get();

        return view('management.edit')
            ->with([
                'cakeinfos' => $infos,
                'cakeinfo' => $cakeinfos,
                'info' => $cakeinfos,
                'prices' => $prices,
                'cakecodes' => $infos,
                'cakenames' => $infos,
                'subphotos' => $cakephotos,
                'tags' => $tags,
            ]);
    }

    //商品情報削除用ページ(photo)
    public function _photo_destroy(Request $request, CakePhoto $cakephoto)
    {
        //トークン再生成
        $request->session()->regenerateToken();

        $cakephoto->delete();

        //残りの値を渡して表示する。
        $cakeinfo = $request->info;
        $infos = CakeInfo::all();
        $cakephotos = CakePhoto::where('cake_photos_id', $cakeinfo)->get();
        $prices = CakeInfoSub::where('cake_infos_id', $cakeinfo)->get();
        $cakeinfos = CakeInfo::find($cakeinfo);
        $tags = Tag::where('cake_infos_id', $cakeinfo)->get();

        return view('management.edit')
            ->with([
                'cakeinfos' => $infos,
                'cakeinfo' => $cakeinfo,
                'info' => $cakeinfos,
                'prices' => $prices,
                'cakecodes' => $infos,
                'cakenames' => $infos,
                'subphotos' => $cakephotos,
                'tags' => $tags,
            ]);
    }

    //商品情報削除用ページ(tag)
    public function _tag_destroy(Request $request, Tag $tag)
    {
        //トークン再生成
        $request->session()->regenerateToken();

        $tag->delete();

        //残りの値を渡して表示する。
        $cakeinfo = $request->info;
        $infos = CakeInfo::all();
        $cakephotos = CakePhoto::where('cake_photos_id', $cakeinfo)->get();
        $prices = CakeInfoSub::where('cake_infos_id', $cakeinfo)->get();
        $cakeinfos = CakeInfo::find($cakeinfo);
        $tags = Tag::where('cake_infos_id', $cakeinfo)->get();

        return view('management.edit')
            ->with([
                'cakeinfos' => $infos,
                'cakeinfo' => $cakeinfo,
                'info' => $cakeinfos,
                'prices' => $prices,
                'cakecodes' => $infos,
                'cakenames' => $infos,
                'subphotos' => $cakephotos,
                'tags' => $tags,
            ]);
    }

    //材料新規登録、更新画面移動
    public function _ingredient_criate_store(CakeInfo $cakeinfo)
    {
        $infos = CakeInfo::all();
        $exists = BasicIngredient::where('cake_infos_id', $cakeinfo->id)->count();

        //登録してあるか判断
        if ($exists) {
            //登録済みならこっち
            $basicIngredient = BasicIngredient::where('cake_infos_id', $cakeinfo->id)->get();
            return view('management.ingredient.criate')->with([
                'cakeinfos' => $infos,
                'basic' => $basicIngredient,
            ]);
        } else {
            //未登録ならこっち
            $menus = Cakeinfo::all();
            $none = 'まだ登録されておりません';
            return view('management.ingredient.criate')->with([
                'cakeinfos' => $infos,
                'menus' => $menus,
                'none' => $none,
            ]);
        }
    }
    //BasicIngredientテーブル新規追加処理
    public function _ingredient_post(Request $request)
    {
        //トークン再生成
        $request->session()->regenerateToken();
        $request->validate([
            'basic_amount' => 'required',
            'ingredient_unit' => 'required',
            'cake_infos_id' => 'required',
        ], [
            'basic_amount.required' => '基本量を入力してください',
            'ingredient_unit.required' => '共通単位を入力してください',
            'cake_infos_id.required' => 'ケーキの種類を選択してください',
        ]);
        //該当商品があるか検索
        $already = BasicIngredient::query()
            ->where('cake_infos_id', $request->input('cake_infos_id'))
            ->where('basic_amount', $request->input('basic_amount'))
            ->exists();
        if ($already) {
            return back()->withErrors([
                'basic_amount' => 'すでに同じ配合が登録されています'
            ]);
        }

        //情報保存
        $posts = new BasicIngredient();
        $posts->cake_infos_id = $request->cake_infos_id;
        $posts->basic_amount = $request->basic_amount;
        $posts->ingredient_unit = $request->ingredient_unit;
        $posts->save();


        $id = $posts->cake_infos_id;
        $infos = CakeInfo::all();
        $basicIngredient = BasicIngredient::where('cake_infos_id', $id)->get();
        return view('management.ingredient.criate')->with([
            'cakeinfos' => $infos,
            'basic' => $basicIngredient,
        ]);
    }
    //BasicIngredientテーブル更新処理
    public function _ingredient_update(BasicIngredient $basicIngredient, Request $request)
    {
        //トークン再生成
        $request->session()->regenerateToken();
        $request->validate([
            'basic_amount' => 'required',
            'ingredient_unit' => 'required',
            'cake_infos_id' => 'required',
        ], [
            'basic_amount.required' => '基本量を入力してください',
            'ingredient_unit.required' => '共通単位を入力してください',
            'cake_infos_id.required' => 'ケーキの種類を選択してください',
        ]);
        //該当商品があるか検索
        $already = BasicIngredient::query()
            ->where('cake_infos_id', $request->input('cake_infos_id'))
            ->where('basic_amount', $request->input('basic_amount'))
            ->exists();

        if ($already) {
            return back()->withErrors([
                'basic_amount' => 'すでに同じ配合が登録されています'
            ]);
        }

        //情報保存
        $basicIngredient->cake_infos_id = $request->cake_infos_id;
        $basicIngredient->basic_amount = $request->basic_amount;
        $basicIngredient->ingredient_unit = $request->ingredient_unit;
        $basicIngredient->save();


        $id = $basicIngredient->cake_infos_id;
        $infos = CakeInfo::all();
        $basicIngredient = BasicIngredient::where('cake_infos_id', $id)->get();
        return view('management.ingredient.criate')->with([
            'cakeinfos' => $infos,
            'basic' => $basicIngredient,
        ]);
    }
    //BasicIngredientテーブル情報削除処理
    public function _ingredient_destroy(BasicIngredient $basicIngredient, Request $request)
    {
        //トークン再生成
        $request->session()->regenerateToken();

        $id = $basicIngredient->cake_infos_id;
        $basicIngredient->delete();

        $infos = CakeInfo::all();
        $exists = BasicIngredient::where('cake_infos_id', $id)->count();

        //登録してあるか判断
        if ($exists) {
            //登録済みならこっち
            $basicIngredient = BasicIngredient::where('cake_infos_id', $id)->get();
            return view('management.ingredient.criate')->with([
                'cakeinfos' => $infos,
                'basic' => $basicIngredient,
            ]);
        } else {
            //未登録ならこっち
            $menus = Cakeinfo::all();
            $none = 'まだ登録されておりません';
            return view('management.ingredient.criate')->with([
                'cakeinfos' => $infos,
                'menus' => $menus,
                'none' => $none,
            ]);
        }
    }

    //配合個別詳細画面
    public function _ingredient_edit_store(BasicIngredient $basicIngredient)
    {
        $infos = CakeInfo::all();
        $each = EachIngredient::where('basic_ingredients_id', $basicIngredient->id)->get();
        return view('management.ingredient.edit')->with([
            'cakeinfos' => $infos,
            'basic' => $basicIngredient,
            'each' => $each,
        ]);
    }
    //配合個別詳細追加処理
    public function _ingredient_edit_post(BasicIngredient $basicIngredient, Request $request)
    {
        // トークン再生成
        $request->session()->regenerateToken();
        $request->validate([
            'basic_ingredients_id' => 'required',
            'ingredient_name' => 'required',
            'ingredient_amount' => 'required|integer',
            'lot_amount' => 'required|integer',
            'lot_unit' => 'required',
            'expiration' => 'integer',
        ], [
            'basic_ingredients_id.required' => '不正な遷移です',
            'ingredient_name.required' => '共通単位を入力してください',
            'ingredient_amount.required' => '分量を選択してください',
            'lot_amount.required' => '最低ロットを記入してください',
            'lot_unit.required' => '最低ロットの単位を入力してください',
            'ingredient_amount.integer' => '半角数字のみで入力してください',
            'lot_amount.integer' => '半角数字のみで入力してください',
            'expiration.integer' => '半角数字のみで入力してください',
        ]);
        //該当商品があるか検索
        $already = EachIngredient::query()
            ->where('basic_ingredients_id', $request->input('basic_ingredients_id'))
            ->where('ingredient_name', $request->input('ingredient_name'))
            ->exists();
        if ($already) {
            return back()->withErrors([
                'ingredient_name' => 'すでに同じものが登録されています'
            ]);
        }

        //情報保存
        $posts = new EachIngredient();
        $posts->basic_ingredients_id = $request->basic_ingredients_id;
        $posts->ingredient_name = $request->ingredient_name;
        $posts->ingredient_amount = $request->ingredient_amount;
        $posts->lot_amount = $request->lot_amount;
        $posts->lot_unit = $request->lot_unit;
        $posts->expiration = $request->expiration;
        $posts->save();


        $infos = CakeInfo::all();
        $each = EachIngredient::where('basic_ingredients_id', $basicIngredient->id)->get();
        return view('management.ingredient.edit')->with([
            'cakeinfos' => $infos,
            'basic' => $basicIngredient,
            'each' => $each,

        ]);
    }
    //材料詳細更新処理
    public function _ingredient_edit_update(EachIngredient $eachIngredient, Request $request)
    {
        // トークン再生成
        $request->session()->regenerateToken();
        $request->validate([
            'basic_ingredients_id' => 'required',
            'ingredient_name' => 'required',
            'ingredient_amount' => 'required|integer',
            'lot_amount' => 'required|integer',
            'lot_unit' => 'required',
            'expiration' => 'integer',
        ], [
            'basic_ingredients_id.required' => '不正な遷移です',
            'ingredient_name.required' => '共通単位を入力してください',
            'ingredient_amount.required' => '分量を選択してください',
            'lot_amount.required' => '最低ロットを記入してください',
            'lot_unit.required' => '最低ロットの単位を入力してください',
            'ingredient_amount.integer' => '半角数字のみで入力してください',
            'lot_amount.integer' => '半角数字のみで入力してください',
            'expiration.integer' => '半角数字のみで入力してください',
        ]);

        //情報保存
        $eachIngredient->basic_ingredients_id = $request->basic_ingredients_id;
        $eachIngredient->ingredient_name = $request->ingredient_name;
        $eachIngredient->ingredient_amount = $request->ingredient_amount;
        $eachIngredient->lot_amount = $request->lot_amount;
        $eachIngredient->lot_unit = $request->lot_unit;
        $eachIngredient->expiration = $request->expiration;
        $eachIngredient->save();


        $infos = CakeInfo::all();
        $basicIngredient = BasicIngredient::find($request->basic_ingredients_id);
        $each = EachIngredient::where('basic_ingredients_id', $request->basic_ingredients_id)->get();
        return view('management.ingredient.edit')->with([
            'cakeinfos' => $infos,
            'basic' => $basicIngredient,
            'each' => $each,

        ]);
    }
    //材料詳細削除処理
    public function _ingredient_edit_destroy(EachIngredient $eachIngredient, Request $request)
    {
        // トークン再生成
        $request->session()->regenerateToken();

        $eachIngredient->delete();

        $infos = CakeInfo::all();
        $basicIngredient = BasicIngredient::find($request->basic_ingredients_id);
        $each = EachIngredient::where('basic_ingredients_id', $request->basic_ingredients_id)->get();
        return view('management.ingredient.edit')->with([
            'cakeinfos' => $infos,
            'basic' => $basicIngredient,
            'each' => $each,

        ]);
    }

    //材料発注画面移動
    public function _ingredient_edit_order_store(BasicIngredient $basicIngredient)
    {
        $infos = CakeInfo::all();
        $each = EachIngredient::where('basic_ingredients_id', $basicIngredient->id)->get();
        return view('management.ingredient.order')->with([
            'cakeinfos' => $infos,
            'basic' => $basicIngredient,
            'each' => $each,
        ]);
    }
}
