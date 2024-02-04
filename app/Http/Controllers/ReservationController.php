<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Models\CakeInfo;
use  App\Models\Information;
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
    //予約情報削除
    public function _information_destroy(Request $request, Sub_reservation $sub_reservation)
    {
        //トークン再生成
        $request->session()->regenerateToken();

        $sub_reservation->delete();

        $info = CakeInfo::all();
        $today = Carbon::today();
        $main = Main_reservation::where('id', $request->id)->where('birthday','>=',$today)->get();

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
        $today = Carbon::today();
        $cakename = $cakeinfo->cakename;
        $reservations = Sub_reservation::where('cakename', $cakename)->get();  //条件追加する
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

    //お知らせ一覧
    public function _information_edits_store()
    {
        $info = CakeInfo::all();
        $information = Information::all();

        return view('management.informations')
            ->with([
                'cakeinfos' => $info,
                'informations' => $information,
            ]);
    }

    //お知らせ個別編集画面
    public function _information_edit_store(Information $information)
    {
        $info = CakeInfo::all();

        return view('management.information')
            ->with([
                'cakeinfos' => $info,
                'information' => $information,
            ]);
    }
    //お知らせ個別編集画面
    public function _information_criate_store()
    {
        $info = CakeInfo::all();

        return view('management.information-criate')
            ->with([
                'cakeinfos' => $info,
            ]);
    }

    //お知らせ投稿処理
    public function _information_criate_post(Information $information, Request $request)
    {
        //トークン再生成
        $request->session()->regenerateToken();

        $request->validate([
            'topic' => 'required',
            'information' => 'required',
        ], [
            'topic.required' => '題名を入力してください',
            'information.required' => 'お知らせを記入してください',
        ]);

        $posts = new Information();
        $posts->topic = $request->topic;
        $posts->information = $request->information;
        $posts->save();


        $info = CakeInfo::all();
        $information = Information::all();

        return view('management.informations')
            ->with([
                'cakeinfos' => $info,
                'informations' => $information,
            ]);
    }

    //お知らせ削除処理
    public function _information_edit_destroy(Information $information, Request $request)
    {
        //トークン再生成
        $request->session()->regenerateToken();

        $information->delete();

        $info = CakeInfo::all();
        $information = Information::all();

        return view('management.informations')
            ->with([
                'cakeinfos' => $info,
                'information' => $information,
            ]);
    }

    //お知らせ更新処理
    public function _information_edit_update(Information $information, Request $request)
    {
        //トークン再生成
        $request->session()->regenerateToken();

        $request->validate([
            'topic' => 'required',
            'information' => 'required',
        ], [
            'topic.required' => '題名を入力してください',
            'information.required' => '題名を入力してください',
        ]);

        $information->topic = $request->topic;
        $information->information = $request->information;
        $information->save();

        $info = CakeInfo::all();
        $informations = Information::orderByDEsc('updated_at')->get();

        return view('management.informations')
            ->with([
                'cakeinfos' => $info,
                'informations'=>$informations,
            ]);
    }
}

// public function ()
// {
//     $info = CakeInfo::all();

//     return view('management.manage')
//         ->with([
//             'cakeinfos' => $info,
//         ]);a
// }

//トークン再生成
// $request->session()->regenerateToken();
/**
 *関数の説明
 *
 *
 *
 **/
