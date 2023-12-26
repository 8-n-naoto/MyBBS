<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Models\CakeInfo;
use  App\Models\CakeInfoSub;
use App\Models\CakePhoto;
use  App\Models\Main_reservation;
use  App\Models\Sub_reservation;
use App\Models\User;
use Carbon\Carbon;

class ReservationController extends Controller
{
    // 管理画面ホーム
    public function management()
    {
        $info = CakeInfo::all();
        $infosub = Sub_reservation::all();
        $user = User::all();
        $today = Carbon::today();
        $reservation = Main_reservation::whereDate('birthday', $today)->get();

        return view('management.manage')
            ->with([
                'users'=>$user,
                'info' => $info,
                'infosub'=>$infosub,
                'reservations' => $reservation,
            ]);
    }


    //ON/OFF画面
    public function edits()
    {
        $info = CakeInfo::all();
        return view('management.edits')
            ->with([
                'info' => $info,
            ]);
    }

    //個別詳細変更画面
    public function edit(CakeInfo $cake_info)
    {
        $cakecode=CakeInfo::all();
        $cakephotos=CakePhoto::where('cake_infos_id','=',$cake_info->id)->get();
        $prices = CakeInfoSub::where('cake_infos_id', '=', $cake_info->id)->get();
        return view('management.edit')
            ->with([
                'info' => $cake_info,
                'prices' => $prices,
                'cakecode'=>$cakecode,
                'subphotos'=>$cakephotos
            ]);
    }

    //商品追加ページ
    public function create()
    {
        $cakecode=CakeInfo::all();
        return view('management.create')
        ->with([
            'cakecode'=>$cakecode,
        ]);
    }

    //商品追加用ページ
    public function store(Request $request)
    {
        //トークン再生成
        $request->session()->regenerateToken();

        //バリデート
        $request->validate([
            'cakename'=>'required',
            'topic'=>'required',
            'explain'=>'required',
            'cakecode'=>'required',
            'cakename'=>'required',
            'mainphoto'=>'required',
            'capacity'=>'required',
            'price'=>'required',
        ],[
            'users_id.required'=>'ログインしてください',
            'cakename.required'=>'ケーキの名前を入力してください',
            'topic.required'=>'ひとこと説明を入力してください',
            'explain.required'=>'説明を入力してください',
            'cakecode.required'=>'商品コードを入力してください',
            'cakename.required'=>'ケーキの名前を入力してください',
            'mainphoto.required'=>'ケーキの写真を追加してください',
            'capacity.required'=>'大きさや内容量を入力してください',
            'price.required'=>'価格を追加してください',
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

        $id=$post->id;
        $post = new CakeInfoSub();
        $post->cake_infos_id = $id;
        $post->capacity = $request->capacity;
        $post->price = $request->price;
        $post->save();


        return redirect()
            ->route('cakeinfos');
    }


    //商品更新画面（price）
    public function addprice(Request $request)
    {
        //トークン再生成
        $request->session()->regenerateToken();

        $request->validate([
            'capacity'=>'required',
            'price'=>'required',
        ],[
            'capacity.required'=>'大きさや内容量を入力してください',
            'price.required'=>'価格を追加してください',
        ]);

        $post = new CakeInfoSub();
        $post->cake_infos_id = $request->id;
        $post->capacity = $request->capacity;
        $post->price = $request->price;
        $post->save();

        return redirect()
            ->route('cakeinfos');
    }

    //商品更新処理(photo)
    public function addphoto(Request $request)
    {
        //トークン再生成
        $request->session()->regenerateToken();

        //バリデート
        $request->validate([
            'cake_infos_id'=>'required',
            'photoname'=>'required',
            'subphotos'=>'required',
        ],[
            'cake_infos_id.required'=>'ログインしてください',
            'photoname.required'=>'ケーキの名前を入力してください',
            'subphotos.required'=>'写真を選択してください',
        ]);

        $post = new CakePhoto();
        $post->cake_infos_id= $request->cake_infos_id;
        $post->photoname = $request->photoname;
        // // name属性が'images'のinputタグをファイル形式に、画像をpublic/imagesに名前付きで保存
        $image_path = $request->file('subphotos')->getClientOriginalName();
        // 上記処理にて保存した画像に名前を付け、Cakeinfoテーブルのimagesカラムをパスに形にして名前を付ける
        $request->file('subphotos')->storeAs('public/images/' . $image_path);
        //名前を保存
        $post->subphotos = 'storage/images/' . $image_path;
        $post->save();

        return redirect()
            ->route('cakeinfos');
    }

    //更新処理
    public function update(Request $request, CakeInfo $cakeinfo)
    {

        //トークン再生成
        $request->session()->regenerateToken();

        //バリデート
        $request->validate([
            'cakename'=>'required',
            'mainphoto'=>'required',
            'topic'=>'required',
            'explain'=>'required',
            'cakecode'=>'required',
        ],[
            'cakename.required'=>'ケーキの名前を入力してください',
            'topic.required'=>'ひとこと説明を入力してください',
            'explain.required'=>'説明を入力してください',
            'cakecode.required'=>'商品コードを入力してください',
            'mainphoto.required'=>'ケーキの写真を追加してください',
        ]);


        $cakeinfo->cakename = $request->cakename;
        $cakeinfo->topic = $request->topic;
        $cakeinfo->explain = $request->explain;
        $cakeinfo->cakecode = $request->cakecode;


        // name属性が'images'のinputタグをファイル形式に、画像をpublic/imagesにファイル名で保存
        $image_path = $request->file('mainphoto')->getClientOriginalName();
        // 上記処理にて保存した画像に名前を付け、Cakeinfoテーブルのimagesカラムにパスの形式にして、格納
        $request->file('mainphoto')->storeAs('public/images/' . $image_path);
        $cakeinfo->mainphoto = 'storage/images/' . $image_path;
        $cakeinfo->save();


        return redirect()
            ->route('cakeinfos');
    }

    //商品情報削除用ページ
    public function destroy(CakeInfo $cakeinfo)
    {

        //削除
        $cakeinfo->delete();
        //残りの値を渡して表示する。
        $cakeinfo = CakeInfo::all();
        return view('management.edits')
            ->with(['info' => $cakeinfo]);
    }
    //商品情報削除用ページ(price)
    public function destroy_price(Request $request, CakeInfoSub $cakeinfosub)
    {

        $cakeinfosub->delete();
        //残りの値を渡して表示する。
        $cakeinfo = CakeInfo::all();
        return view('management.edits')
            ->with(['info' => $cakeinfo]);
    }
    //商品情報削除用ページ(photo)
    public function destroy_photo(Request $request, CakePhoto $cakephoto)
    {

        $cakephoto->delete();
        //残りの値を渡して表示する。
        $cakeinfo = CakeInfo::all();
        return view('management.edits')
            ->with(['info' => $cakeinfo]);
    }



    // 予約一覧表示画面
    public function counts(CakeInfo $cake_info)
    {
        $today = Carbon::today();
        $cakename = $cake_info->cakename;
        $info = Sub_reservation::where('cakename', $cakename);

        // $info = Sub_reservation::where('cake', $cakename)->where('birthday', '>=', $today)->get();
        return view('management.count')
            ->with([
                'name' => $cake_info,
                'info' => $info,
            ]);
    }
    //日にち別予約数確認画面(当日)
    public function date()
    {
        $info = Main_reservation::all();  //今日以降のものを抽出→日にち順に並び変える→時間順に並び変える→ゲット
        $info_sub=Sub_reservation::all(); //あとから上ので一緒に出せるようにする。
        return view('management.date')
            ->with([
                'info' => $info,
                'info_sub'=>$info_sub,
            ]);
    }
}
