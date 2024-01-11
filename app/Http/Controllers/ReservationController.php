<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Models\CakeInfo;
use  App\Models\Main_reservation;
use  App\Models\Sub_reservation;
use Carbon\Carbon;

class ReservationController extends Controller
{
    // 管理画面ホーム
    public function management()
    {
        $day = Carbon::today()->format('m月d日のご予約');
        $info = CakeInfo::all();
        $infosub = Sub_reservation::all();
        $today = Carbon::today();
        $reservation = Main_reservation::whereDate('birthday', $today)->get();

        return view('management.manage')
            ->with([
                'day' => $day,
                'infosubs' => $infosub,
                'reservations' => $reservation,
                'cakeinfos' => $info,
            ]);
    }


    //日にち別予約数確認画面(当日)
    public function _date_store()
    {
        $infos = CakeInfo::all();
        $today = Carbon::today();
        $reservations = Main_reservation::whereDate('birthday', $today)->get();  //今日以降のものを抽出→日にち順に並び変える→時間順に並び変える→ゲット
        $info_sub = Sub_reservation::all(); //あとから上ので一緒に出せるようにする。
        $date = Carbon::today()->format('Y年m月d日');

        return view('management.date')
            ->with([
                'date' => $date,
                'cakeinfos' => $infos,
                'infosubs' => $info_sub,
                'reservations' => $reservations,
            ]);
    }
    //日にち別予約数確認画面（指定）
    public function _date_get(Request $request)
    {
        $infos = CakeInfo::all();
        $reservations = Main_reservation::whereDate('birthday', $request->date)->get();
        $info_sub = Sub_reservation::all();
        return view('management.date')
            ->with([
                'cakeinfos' => $infos,
                'reservations' => $reservations,
                'infosubs' => $info_sub,
                'date' => $request->date,
            ]);
    }

    // 予約情報確認画面
    public function _information_store()
    {
        $info = CakeInfo::all();

        return view('management.reservationscheck')
            ->with([
                'cakeinfos' => $info,
                'main' => null,
                'id' => null,
            ]);
    }

    //予約検索用
    public function _information_get(Request $request)
    {
        $info = CakeInfo::all();
        $main = Main_reservation::where('id', '=', $request->MainReservationsID)->get();
        $sub = Sub_reservation::where('id', '=', $request->SubReservationsID)->get();

        return view('management.reservationscheck')
            ->with([
                'cakeinfos' => $info,
                'reservations' => $main,
                'infosubs' => $sub,
                'id' => $request,
            ]);
    }

    //商品別総数表示ページ種類別
    public function _count_store(CakeInfo $cakeinfo)
    {
        $infos = CakeInfo::all();
        $cakename = $cakeinfo->cakename;
        $info = Main_reservation::all();
        $subinfo = Sub_reservation::where('cakename', $cakename)->get();

        return view('management.count')
            ->with([
                'cakeinfos' => $infos,
                'reservations' => $info,
                'infosubs' => $subinfo,
                'name' => $cakeinfo,

            ]);
    }
}

/**
 *関数の説明
 *
 *
 *
 **/
