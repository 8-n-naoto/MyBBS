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
        $today = Carbon::today();
        $reservation = Main_reservation::whereDate('birthday', $today)->get();

        return view('management.manage')
            ->with([
                'day' => $day,
                'cakeinfos' => $info,
                'reservations' => $reservation,
            ]);
    }


    //日にち別予約数確認画面(当日)
    public function _date_store()
    {
        $infos = CakeInfo::all();
        $today = Carbon::today();
        //今日以降のものを抽出→日にち順に並び変える→時間順に並び変える→ゲット
        $reservations = Main_reservation::whereDate('birthday', $today)->get();
        $date = Carbon::today()->format('Y年m月d日');

        return view('management.date')
            ->with([
                'date' => $date,
                'cakeinfos' => $infos,
                'reservations' => $reservations,
            ]);
    }
    //日にち別予約数確認画面（指定）
    public function _date_get(Request $request)
    {
        $infos = CakeInfo::all();
        $reservations = Main_reservation::whereDate('birthday', $request->date)->get();
        return view('management.date')
            ->with([
                'cakeinfos' => $infos,
                'reservations' => $reservations,
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
        $main = Main_reservation::where('id', $request->MainReservationsID)->get();

        return view('management.reservationscheck')
            ->with([
                'cakeinfos' => $info,
                'reservations' => $main,
                'id' => $request,
            ]);
    }

    //商品別総数表示ページ種類別
    public function _count_store(CakeInfo $cakeinfo)
    {
        $infos = CakeInfo::all();
        $cakename = $cakeinfo->cakename;
        $reservations = Sub_reservation::where('cakename', $cakename)->get();
        $count = $reservations->count();

        return view('management.count')
            ->with([
                'cakeinfos' => $infos,
                'cakeinfo' => $cakeinfo,
                'reservations' => $reservations,
                'count' => $count,
            ]);
    }

    //商品別総数表示ページ種類別
    public function _count_get(Request $request, CakeInfo $cakeinfo)
    {
        $infos = CakeInfo::all();
        $cakename = $cakeinfo->cakename;

        // 初め
        $startdate = $request->startdate;
        // 終わり
        $enddate = $request->enddate;
        //指定した期間内のデータを抽出
        $info = Main_reservation::whereHas(
            'sub_reservations',
            function ($query) use ($cakename) {
                $query->where('cakename', $cakename);
            }
        )
            ->whereBetween('birthday', [$startdate, $enddate])
            ->get();
        //上のデータを指定した商品名のもののみ抽出したい

        $count = $info->count();

        return view('management.count')
            ->with([
                'cakeinfos' => $infos,
                'cakeinfo' => $cakeinfo,
                'reservations' => $info,
                'getcount' => $info,
                'count' => $count,
            ]);
    }
}

/**
 *関数の説明
 *
 *
 *
 **/
