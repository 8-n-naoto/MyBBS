<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cake_info;
use App\Models\Cake_info_sub;
use App\Models\Cake_photo;
use App\Models\Main_reservation;
use App\Models\Sub_reservation;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class InformationController extends Controller
{
    // ホーム画面
    public function index()
    {
        // $infos=Cake_info::find(1)->price;
        // $infos=Cake_info::find(1)->cake_infos_sub;
        $infos = Cake_info::all();
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
        //ログイン処理をここでする
        //不一致ならばログイン画面に戻す
        //ログイン出来たなら下記の処理をする＋ログイン情報を保持

        $info = Cake_info::all();
        return view('index')
            ->with(['infos' => $info]);
    }

    //ケーキ詳細表示画面
    public function cakeinfo(Cake_info $cake_info)
    {
        $subitem = Cake_info::all();
        $id = $cake_info->id;
        $price = Cake_info_sub::where('cake_infos_id', '=', $id)->get();

        return view('cake.cakeinfo')
            ->with([
                'info' => $cake_info,
                'prices' => $price,
                'subinfo' => $subitem,
            ]);
    }

    //予約詳細入力画面
    public function buy(Cake_info $cake_info)
    {
        $id = $cake_info->id;
        $price = Cake_info_sub::where('cake_infos_id', '=', $id)->get();
        return view('cake.form')
            ->with([
                'info' => $cake_info,
                'prices' => $price,
            ]);
    }

    // 予約情報確認画面
    public function formcheck(Request $request)
    {
        $request->validate([
            'users_id'=>'required',
            'birthday'=>'required',
            'time'=>'required',
            'cakename'=>'required', //出来るなら既存のデータと照合して、間違っていれば返したい
            'mainphoto'=>'required',//対応しているか確認したい
            'capacity'=>'required',//対応しているか確認したい
            'price'=>'required',//対応しているか確認したい
            'massage'=>'required',//確認くらいは出したい
        ],[
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

        return view('cake.formcheckok');
        // ->with(['info' => $posts])
    }
}
