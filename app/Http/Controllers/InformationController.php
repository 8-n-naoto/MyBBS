<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CakeInfo;
use App\Models\CakeInfoSub;
use App\Models\CakePhoto;
use App\Models\Main_reservation;
use App\Models\Sub_reservation;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class InformationController extends Controller
{
    // ホーム画面
    public function index()
    {
        $infos = CakeInfo::where('boolean','=',1)->get();
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
        $info = CakeInfo::all();
        return view('index')
            ->with(['infos' => $info]);
    }

    //ケーキ詳細表示画面
    public function cakeinfo(CakeInfo $cakeinfo)
    {
        $subitem = CakeInfo::all();
        $subphotos=$cakeinfo;

        return view('cake.cakeinfo')
            ->with([
                'infos' => $cakeinfo,
                'subinfo' => $subitem,
                'subphotos'=>$subphotos
            ]);
    }

    //予約詳細入力画面
    public function buy(CakeInfo $cakeinfo)
    {
        return view('cake.form')
            ->with([
                'info' => $cakeinfo,
                'prices' => $cakeinfo,
            ]);
    }

    // 予約情報確認画面
    public function formcheck(Request $request)
    {
        $request->validate([
            'users_name'=>'required',
            'users_id'=>'required',
            'birthday'=>'required',
            'time'=>'required',
            'cakename'=>'required', //出来るなら既存のデータと照合して、間違っていれば返したい
            'mainphoto'=>'required',
            'capacity'=>'required',
            'price'=>'required',
            'massage'=>'required',
        ],[
            'users_id.required'=>'ログインしてください',
            'users_id.required'=>'ログインしてください',
            'birthday.required'=>'受取日を入力してください',
            'time.required'=>'受け取り時間を入力してください',
            'capacity.required'=>'大きさ・価格をえらんでください',
            'massage.required'=>'メッセージなし、もしくはメッセージを入力してください',
        ]);


        return view('cake.formcheck')
            ->with(['info' => $request]);
    }


    //予約情報保存画面
    public function reservation(Request $request)
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

        $mainID=$id;
        $subID=$posts->id;
        return view('cake.formcheckok')
        ->with([
            'mainID' => $mainID,
            'subID'=>$subID,
        ]);
    }

}
