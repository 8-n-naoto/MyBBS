<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CakeInfo;
use App\Models\Main_reservation;
use App\Models\Sub_reservation;

class InformationController extends Controller
{
    // ホーム画面
    public function index()
    {
        $infos = CakeInfo::where('boolean', 1)->get();
        return view('index')
            ->with(['infos' => $infos]);
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

        return view('cake.cakeinfo')
            ->with([
                'infos' => $infos,
                'cakeinfos' => $cakeinfo,
                'subphotos' => $subphotos
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
            'massage' => 'required',
        ], [
            'users_id.required' => 'ログインしてください',
            'users_id.required' => 'ログインしてください',
            'birthday.required' => '受取日を入力してください',
            'time.required' => '受け取り時間を入力してください',
            'capacity.required' => '大きさ・価格をえらんでください',
            'massage.required' => 'メッセージなし、もしくはメッセージを入力してください',
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

    //カート呼び出し
    public function _store_cart(Request $request){

        $id=$request->id;
        $infos=Cart::where('user_id',$id)->get();


        return view('user.cart')
        ->with([
            'infos'=>$infos,
        ]);
    }

    //処理がほとんどカートと同じなので時間があれば実装する
    // //お気に入り呼び出し
    // public function _store_favorite(Request $request){

    //     $id=$request->id;
    //     $infos=Favorite::where('user_id',$id)->get();
    //     $id=$infos->cakeID;
    //     $infos=CakeInfo::where('id',$id);


    //     return view('user.cart')
    //     ->with([
    //         'infos'=>$infos,

    //     ]);
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
