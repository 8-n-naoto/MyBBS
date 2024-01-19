<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\CakeInfo;
use App\Models\Main_reservation;
use App\Models\Sub_reservation;
use Illuminate\Support\Facades\Auth;

class InformationController extends Controller
{

    // ホーム画面
    public function index()
    {
        $infos = CakeInfo::where('boolean', 1)->get();

        return view('index')
            ->with([
                'infos' => $infos,
            ]);
    }

    //ログイン画面
    public function login()
    {
        return view('login');
    }
    //ログイン処理
    public function loginok()
    {
        $infos = CakeInfo::where('boolean', 1)->get();
        return view('index')
            ->with(['infos' => $infos]);
    }

    //ケーキ詳細表示画面
    public function _store_cake(CakeInfo $cakeinfo)
    {
        $infos = CakeInfo::where('boolean', 1)->get();
        $subphotos = $cakeinfo;

        //お気に入り数表示
        $count = Favorite::where('cake_id', $cakeinfo->id)->count();

        return view('cake.cakeinfo')
            ->with([
                'infos' => $infos,
                'cakeinfos' => $cakeinfo,
                'subphotos' => $subphotos,
                'count' => $count,
            ]);
    }

    //予約詳細入力画面
    public function _store_form(CakeInfo $cakeinfo)
    {
        return view('cake.form')
            ->with([
                'info' => $cakeinfo,
                'prices' => $cakeinfo,
            ]);
    }

    // 予約情報確認画面
    public function _store_check(Request $request)
    {
        $request->validate([
            'users_name' => 'required',
            'users_id' => 'required',
            'birthday' => 'required',
            'time' => 'required',
            'cakename' => 'required', //出来るなら既存のデータと照合して、間違っていれば返したい
            'mainphoto' => 'required',
            'capacity' => 'required',
            'price' => 'required',
        ], [
            'users_id.required' => 'ログインしてください',
            'users_id.required' => 'ログインしてください',
            'birthday.required' => '受取日を入力してください',
            'time.required' => '受け取り時間を入力してください',
            'capacity.required' => '大きさ・価格をえらんでください',
        ]);


        return view('cake.formcheck')
            ->with(['info' => $request]);
    }


    //予約情報保存画面
    public function _store_result(Request $request)
    {
        $request->session()->regenerateToken();
        $posts = new Main_reservation();
        $posts->birthday = $request->birthday;
        $posts->time = $request->time;
        $posts->users_id = $request->users_id;
        $posts->save();
        $id = $posts->id;

        /**$info=Cart->cakeinfo->cakeinfosubs; //subに必要な情報を取得
         * $carts=Cart::where('user_id',Auth::user()->id)
         *foreach($carts as $cart){
         * $posts = new Sub_reservation();
         * $posts->main_reservation_id = $id;
         * $posts->cakename = $cart->cake_info->cakename;
         * $posts->capacity = $cart->cake_info->cake_info_subs->capacity;
         * $posts->price = $cart->cake_info->cake_info_subs->price;
         * $posts->massage = $cart->massage;
         * $posts->save();
         *}
         *
         * cartの情報を消す（出来ればトランザクション使いたい）
         **/
        $posts = new Sub_reservation();
        $posts->main_reservation_id = $id;
        $posts->cakename = $request->cakename;
        $posts->capacity = $request->capacity;
        $posts->price = $request->price;
        $posts->massage = $request->massage;
        $posts->save();

        $mainID = $id;
        $subID = $posts->id;
        return view('cake.formcheckok')
            ->with([
                'mainID' => $mainID,
                'subID' => $subID,
            ]);
    }

    //お気に入り登録
    public function _favorite_add(Request $request)
    {

        $request->session()->regenerateToken();
        $posts = new Favorite();
        $posts->user_id = $request->user_id;
        $posts->cake_id = $request->cake_id;
        $posts->save();


        $infos = CakeInfo::where('boolean', 1)->get();
        $subphotos = $request->cakeinfos_id;

        return back()
            ->with([
                'infos' => $infos,
                'subphotos' => $subphotos,
            ]);
    }
    //お気に入り削除
    public function _favorite_destroy(Favorite $favorite)
    {
        $favorite->delete();

        $id = Auth::user()->id;
        $infos = Favorite::where('user_id', $id)->get();

        return view('user.favorite')
            ->with([
                'infos' => $infos,
            ]);
    }
    //お気に入り移動
    public function _favorite_store(Request $request)
    {

        $id = $request->id;
        $infos = Favorite::where('user_id', $id)->get();


        return view('user.favorite', $infos)
            ->with([
                'infos' => $infos,
            ]);
    }

    // public function _favorite_count()
    // {
    //     //お気に入り数取得
    //     $cakeinfos = CakeInfo::all();
    //     //名前とお気に入り数の仮想配列を作る
    //     $favorites = [];
    //     foreach ($cakeinfos as $cakeinfo) {
    //         $id = $cakeinfo->id;
    //         $favorite = Favorite::where('cake_id', $id)->count();
    //         $favorites[$cakeinfo->cakename] = $favorite;
    //     }
    // }

    // //価格ソート機能
    // public function _sort_price()
    // {
    //     $cakes = CakeInfo::all();

    //     //商品ごとの最小の値を取得して、配列を作る
    //     $infos=[]; //最終的に作る配列

    //     foreach($cakes as $cake){
    //         if ($cake->boolean===1) {
    //             # code...
    //         }
    //         $id=$cake->id;
    //         $price = CakeInfoSub::where('cake_infos_id',$id)->get()->sortByDesc('price');
    //         $name=$cake->cakename;
    //         //名前が同じなので上書きされ、最小の値が残る
    //         $info=[]; //配列の中に入れる配列
    //         $info['price']=$price;
    //         $info['id']=$id;
    //         $info['mainphoto']=$cake->mainphoto;
    //         $info['cakename']=$name;
    //         array_push($infos,$info);
    //     }
    //     価格がひとつしか伝わっていない
    //     //取得した値をソートして渡す。
    //     return view('index')
    //         ->with(['infos' => $infos]);

    // }
}
