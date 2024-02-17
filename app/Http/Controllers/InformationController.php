<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Favorite;
use App\Models\Cart;
use App\Models\Tag;
use App\Models\CakeInfo;
use App\Models\CakeInfoSub;
use App\Models\Main_reservation;
use App\Models\Sub_reservation;
use  App\Models\Information;
use Illuminate\Support\Facades\Auth;
use App\Mail\ContactMail;
use DateTime;
use Illuminate\Support\Facades\Mail;

class InformationController extends Controller
{

    // ホーム画面
    public function index()
    {
        $infos = CakeInfo::where('boolean', 1)->get();
        $tags = Tag::all()->unique('tag');
        $informations = Information::orderByDEsc('updated_at')->get();
        $sliders = Tag::where('tag', 'イチオシ！')->get();

        return view('index')
            ->with([
                'infos' => $infos,
                'tags' => $tags,
                'informations' => $informations,
                'sliders' => $sliders,
            ]);
    }

    // tag別画面
    public function _tag_store(Tag $tag)
    {
        $infos = CakeInfo::where('boolean', 1)->get();
        $cakeinfo = Tag::where('tag', $tag->tag)->get();
        $tags = Tag::all()->unique('tag');
        $informations = Information::orderByDEsc('updated_at')->get();

        return view('cake.tag')
            ->with([
                'infos' => $infos,
                'cakeinfo' => $cakeinfo,
                'tags' => $tags,
                'tag' => $tag,
                'informations' => $informations,
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
    public function _cake_store(CakeInfo $cakeinfo)
    {
        $infos = CakeInfo::where('boolean', 1)->get();
        $tags = Tag::all()->unique('tag');
        $caketags = Tag::where('cake_infos_id', $cakeinfo->id)->get();
        $informations = Information::orderByDEsc('updated_at')->get();

        //お気に入り数表示
        $count = Favorite::where('cake_id', $cakeinfo->id)->count();

        return view('cake.cakeinfo')
            ->with([
                'infos' => $infos,
                'cakeinfos' => $cakeinfo,
                'subphotos' => $cakeinfo,
                'count' => $count,
                'tags' => $tags,
                'caketags' => $caketags,
                'informations' => $informations,
            ]);
    }


    /** 予約フォーム関係 **/
    //予約詳細入力画面
    public function _form_store(CakeInfo $cakeinfo)
    {
        $infos = CakeInfo::where('boolean', 1)->get();
        $tags = Tag::all()->unique('tag');
        return view('cake.form')
            ->with([
                'infos' => $infos,
                'tags' => $tags,
                'info' => $cakeinfo,
                'prices' => $cakeinfo,
            ]);
    }
    // 予約情報確認画面
    public function _check_store(Request $request)
    {
        //トークン再生成
        $request->session()->regenerateToken();

        //日にちの期間確認
        $startlimit = Carbon::today()->addDay(3);
        $endlimit = Carbon::today()->addMonth(2);
        $day = $request->birthday;

        $birthday = new DateTime($day);
        $holiday = intval($birthday->format('w'));
        if ($day < $startlimit  || $endlimit < $day) {
            return back()->withErrors([
                'birthday' => '３日後から２ヶ月の間で選択してください'
            ]);
        } elseif ($holiday === 3 || $holiday === 4) {
            // 休日以外か判別する
            // 0:日 1:月 2:火 3:水 4:木 5:金 6:土
            return back()->withErrors([
                'birthday' => '水曜日、木曜日は定休日です'
            ]);
        }

        $request->validate([
            'users_id' => 'required',
            'birthday' => 'required',
            'time' => 'required',
            'cakename' => 'required', //出来るなら既存のデータと照合して、間違っていれば返したい
            'mainphoto' => 'required',
            'capacity' => 'required',
            'price' => 'required',
            'message' => 'required',
        ], [
            'users_id.required' => 'ログインしてください',
            'birthday.required' => '受取日を入力してください',
            'time.required' => '受け取り時間を入力してください',
            'capacity.required' => '大きさ・価格をえらんでください',
            'message.required' => '「メッセージなし」、もしくはメッセージを入力してください'
        ]);



        $infos = CakeInfo::where('boolean', 1)->get();
        $tags = Tag::all()->unique('tag');

        return view('cake.formcheck')
            ->with([
                'info' => $request,
                'infos' => $infos,
                'tags' => $tags,
            ]);
    }
    //予約情報保存画面
    public function _result_store(Request $request)
    {
        //トークン再生成
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
        $posts->message = $request->message;
        $posts->save();

        $subID = $posts->id;


        $infos = CakeInfo::where('boolean', 1)->get();
        $tags = Tag::all()->unique('tag');
        return view('cake.formcheckok')
            ->with([
                'infos' => $infos,
                'tags' => $tags,
                'subID' => $subID,
            ]);
    }
    /** まとめて予約関係 **/
    //予約詳細入力画面
    public function _collect_form_store(CakeInfo $cakeinfo)
    {
        $id = Auth::user()->id;
        $carts = Cart::where('user_id', $id)->get();

        return view('auth.relation.form')
            ->with([
                'carts' => $carts,
            ]);
    }
    //予約詳細確認画面
    public function _collect_check_store(Request $request, CakeInfo $cakeinfo,)
    {
        //トークン再生成
        $request->session()->regenerateToken();

        $request->validate([
            'users_id' => 'required',
            'birthday' => 'required',
            'time' => 'required',

        ], [
            'users_id.required' => 'ログインしてください',
            'birthday.required' => '受取日を入力してください',
            'time.required' => '受け取り時間を入力してください',
        ]);
        $id = Auth::user()->id;
        $carts = Cart::where('user_id', $id)->get();

        return view('auth.relation.formcheck')
            ->with([
                'info' => $request,
                'carts' => $carts,
            ]);
    }
    //予約確定画面
    public function _collect_result_store(Request $request)
    {
        //トークン再生成
        $request->session()->regenerateToken();

        //main_reservationテーブルの情報を保存
        $posts = new Main_reservation();
        $posts->birthday = $request->birthday;
        $posts->time = $request->time;
        $posts->users_id = $request->users_id;
        $posts->save();
        $id = $posts->id;

        //sub_reservationテーブルの情報を保存
        $user_id = Auth::user()->id;
        $carts = Cart::where('user_id', $user_id)->get();

        foreach ($carts as $cart) {
            if ($cart->cake_info_sub->cake_info->boolean) {
                $posts = new Sub_reservation();
                $posts->main_reservation_id = $id;
                $posts->cakename = $cart->cake_info_sub->cake_info->cakename;
                $posts->capacity = $cart->cake_info_sub->capacity;
                $posts->price = $cart->cake_info_sub->price;
                $posts->message = $cart->message;
                $posts->save();
            }
            $cart->delete();
        }

        $mainID = $id;
        $subID = $posts->id;
        return view('auth.relation.result')
            ->with([]);
    }

    /** お気に入り機能関係 **/
    //お気に入り登録
    public function _favorite_add(Request $request)
    {
        //お気に入り登録
        $request->session()->regenerateToken();

        $already = Favorite::query()
            ->where('user_id', $request->input('user_id'))
            ->where('cake_id', $request->input('cake_id'))
            ->exists();

        if ($already) {
            return back()->withErrors([
                'cake_id' => 'すでに登録されております。'
            ]);
        }

        $posts = new Favorite();
        $posts->user_id = $request->user_id;
        $posts->cake_id = $request->cake_id;
        $posts->save();

        // $infos = CakeInfo::where('boolean', 1)->get();
        // $subphotos = $request->cakeinfos_id;

        // return back()
        //     ->with([
        //         'infos' => $infos,
        //         'subphotos' => $subphotos,
        //     ]);
    }
    //お気に入り削除
    public function _favorite_destroy(Favorite $favorite, Request $request)
    {
        //トークン再生成
        $request->session()->regenerateToken();

        $favorite->delete();

        $id = Auth::user()->id;
        $tags = Tag::all()->unique('tag');
        $infos = CakeInfo::where('boolean', 1)->get();
        $favorites = Favorite::where('user_id', $id)
            ->whereHas('cake_info', function ($query) {
                $query->where('boolean', 1);
            })
            ->get();

        return view('auth.favorite')
            ->with([
                'infos' => $infos,
                'tags' => $tags,
                'favorites' => $favorites,
            ]);
    }
    //お気に入り移動
    public function _favorite_store()
    {
        $infos = CakeInfo::where('boolean', 1)->get();
        $tags = Tag::all()->unique('tag');
        $id = Auth::user()->id;
        $favorites = Favorite::where('user_id', $id)
            ->whereHas('cake_info', function ($query) {
                $query->where('boolean', 1);
            })
            ->get();

        return view('auth.favorite')
            ->with([
                'favorites' => $favorites,
                'tags' => $tags,
                'infos' => $infos,
            ]);
    }


    /**  カート機能関係・リレーション用 **/
    //カート追加
    public function _cart_add(Request $request)
    {
        //トークン再生成
        $request->session()->regenerateToken();

        $posts = new Cart();
        $posts->user_id = $request->user_id;
        $posts->cake_info_subs_id = $request->cake_info_subs_id;
        $posts->message = 'メッセージなし';
        $posts->save();

        $infos = CakeInfo::where('boolean', 1)->get();
        $subphotos = $request->cakeinfos_id;

        return back()
            ->with([
                'infos' => $infos,
                'subphotos' => $subphotos,
            ]);
    }
    //カート削除
    public function _cart_destroy(Cart $cart, Request $request)
    {
        //トークン再生成
        $request->session()->regenerateToken();

        $cart->delete();

        $id = Auth::user()->id;
        $carts = Cart::where('user_id', $id)->get();
        $infos = CakeInfo::where('boolean', 1)->get();
        $tags = Tag::all()->unique('tag');
        $count = Cart::where('user_id', $id)->count();


        if ($count) {
            //中身があればこっち
            return view('auth.relation.cart')
                ->with([
                    'infos' => $infos,
                    'tags' => $tags,
                    'carts' => $carts,
                ]);
        } else {
            //中身がなければこっち
            return view('auth.nocartlist')->with([
                'infos' => $infos,
                'tags' => $tags,
            ]);
        }
    }
    //カート移動
    public function _cart_store()
    {
        $id = Auth::user()->id;
        $carts = Cart::where('user_id', $id)->get();
        $infos = CakeInfo::where('boolean', 1)->get();
        $tags = Tag::all()->unique('tag');
        $count = Cart::where('user_id', $id)->count();

        if ($count) {
            //中身があればこっち
            return view('auth.relation.cart')
                ->with([
                    'infos' => $infos,
                    'tags' => $tags,
                    'carts' => $carts,
                ]);
        } else {
            //中身がなければこっち
            return view('auth.nocartlist')->with([
                'data' => $count,
                'infos' => $infos,
                'tags' => $tags,
            ]);
        }
    }
    //カート(メッセージ)更新
    public function _cart_update(Request $request, Cart $cart)
    {
        //トークン再生成
        $request->session()->regenerateToken();

        //更新処理
        $cart->message = $request->message;
        $cart->save();

        $id = Auth::user()->id;
        $carts = Cart::where('user_id', $id)->get();
        $infos = CakeInfo::where('boolean', 1)->get();
        $tags = Tag::all()->unique('tag');

        return view('auth.relation.cart')
            ->with([
                'carts' => $carts,
                'infos' => $infos,
                'tags' => $tags,
            ]);
    }

    /** カート機能・セッション用 **/
    //カート画面の移動
    public function _session_cart_store(Request $request)
    {
        //removeメソッドでの配列削除時の配列連番抜け対策
        if ($request->session()->has('cartData')) {
            $cartData = array_values($request->session()->get('cartData'));
        }

        if (!empty($cartData)) {
            //中身があればこっち
            $infos = CakeInfo::where('boolean', 1)->get();
            $tags = Tag::all()->unique('tag');
            return view('auth.session.cartlist')->with([
                'cartData' => $cartData,
                'infos' => $infos,
                'tags' => $tags,
            ]);
        } else {
            //中身がなければこっち
            $infos = CakeInfo::where('boolean', 1)->get();
            $tags = Tag::all()->unique('tag');
            return view('auth.nocartlist')->with([
                'infos' => $infos,
                'tags' => $tags,
            ]);
        }
    }
    //カートの不足している情報記入画面へ移動
    public function _session_cart_reservation(Request $request)
    {
        $infos = CakeInfo::where('boolean', 1)->get();
        $tags = Tag::all()->unique('tag');
        $cakeinfos = CakeInfo::where('id', $request->cake_info_id)->get();
        $cakeinfosubs = Cakeinfosub::where('id', $request->cake_info_sub_id)->get();

        return view('auth.session.cartinfoadd')->with([
            'infos' => $infos,
            'tags' => $tags,
            'cakeinfos' => $cakeinfos,
            'cakeinfosubs' => $cakeinfosubs,
        ]);
    }
    //カートに情報を保存する
    public function _session_cart_add(Request $request)
    {
        //トークン再生成
        $request->session()->regenerateToken();

        //日にちの期間確認
        $startlimit = Carbon::today()->addDay(3);
        $endlimit = Carbon::today()->addMonth(2);
        $day = $request->birthday;

        $birthday = new DateTime($day);
        $holiday = intval($birthday->format('w'));
        if ($day < $startlimit  || $endlimit < $day) {
            return back()->withErrors([
                'birthday' => '３日後から２ヶ月の間で選択してください'
            ]);
        } elseif ($holiday === 3 || $holiday === 4) {
            // 休日以外か判別する
            // 0:日 1:月 2:火 3:水 4:木 5:金 6:土
            return back()->withErrors([
                'birthday' => '水曜日、木曜日は定休日です'
            ]);
        }

        $request->validate([
            'cake_info_id' => 'required',
            'cake_info_sub_id' => 'required',
            'birthday' => 'required',
            'time' => 'required',
            'message' => 'required',
        ], [
            'cake_info_id.required' => '不正な移動です',
            'cake_info_sub_id.required' => 'どれかひとつ選択してください',
            'birthday.required' => '受取日を指定してください',
            'time.required' => '受け取り時間を選択してください',
            'message.required' => '誕生日メッセージを入力してください',
        ]);

        $cakeinfo = CakeInfo::find($request->cake_info_id);
        $cakeinfosub = CakeInfoSub::find($request->cake_info_sub_id);

        //inputタグのname属性を指定し$requestからPOST送信された内容を取得する。
        $cartData = [
            'cake_info_id' => $request->cake_info_id,  //
            'cake_info_sub_id' => $request->cake_info_sub_id,
            'mainphoto' => $cakeinfo->mainphoto,  //
            'birthday' => $request->birthday, //
            'time' => $request->time, //
            'message' => $request->message, //
            'cakename' => $cakeinfo->cakename,
            'capacity' => $cakeinfosub->capacity,
            'price' => $cakeinfosub->price,
        ];

        $request->session()->push('cartData', $cartData);

        $infos = CakeInfo::where('boolean', 1)->get();
        $tags = Tag::all()->unique('tag');
        return view('auth.relation.cartresult')->with([
            'infos' => $infos,
            'tags' => $tags,
        ]);
    }
    //カートの情報削除
    public function _session_cart_destroy(Request $request, $key)
    {
        //トークン再生成
        $request->session()->regenerateToken();

        //これで削除
        $request->session()->forget('cartData.' . $key);

        $infos = CakeInfo::where('boolean', 1)->get();
        $tags = Tag::all()->unique('tag');

        //session情報があればこっち
        if ($request->session()->has('cartData')) {
            //削除後の情報を取得
            $cartData = $request->session()->get('cartData');
            return view('auth.session.cartlist')->with([
                'cartData' => $cartData,
                'infos' => $infos,
                'tags' => $tags,
            ]);
        }

        return view('auth.nocartlist')->with([
            'infos' => $infos,
            'tags' => $tags,
        ]);
    }
    //予約情報確認画面
    public function _session_collect_form_store(Request $request)
    {
        //removeメソッドでの配列削除時の配列連番抜け対策
        $cartData = array_values($request->session()->get('cartData'));

        $infos = CakeInfo::where('boolean', 1)->get();
        $tags = Tag::all()->unique('tag');
        return view('auth.session.form')->with([
            'cartData' => $cartData,
            'infos' => $infos,
            'tags' => $tags,
        ]);
    }
    //予約情報保存＋カートの情報削除＋完了画面へ移動
    public function _session_collect_result_store(Request $request)
    {
        //トークン再生成
        $request->session()->regenerateToken();

        $cartData = $request->session()->get('cartData');
        $userID = Auth::user()->id;

        //データ保存処理
        foreach ($cartData as $data) {
            //日にちの期間確認
            $startlimit = Carbon::today()->addDay(3);
            $endlimit = Carbon::today()->addMonth(2);
            $day = $data['birthday'];

            $birthday = new DateTime($day);
            $holiday = intval($birthday->format('w'));
            if ($day < $startlimit  || $endlimit < $day) {
                return back()->withErrors([
                    'birthday' => '３日後から２ヶ月の間で選択してください'
                ]);
            } elseif ($holiday === 3 || $holiday === 4) {
                // 休日以外か判別する
                // 0:日 1:月 2:火 3:水 4:木 5:金 6:土
                return back()->withErrors([
                    'birthday' => '水曜日、木曜日は定休日です'
                ]);
            }
            $posts = new Main_reservation();
            $posts->birthday = $data['birthday'];
            $posts->time = $data['time'];
            $posts->users_id = $userID;
            $posts->save();
            $id = $posts->id;

            $posts = new Sub_reservation();
            $posts->main_reservation_id = $id;
            $posts->cakename = $data['cakename'];
            $posts->capacity = $data['capacity'];
            $posts->price = $data['price'];
            $posts->message = $data['message'];
            $posts->save();
        }

        // //メール送る
        $user = auth()->user();
        Mail::to($user->email)->send(new ContactMail($cartData));

        $cartData = $request->session()->forget('cartData');

        $infos = CakeInfo::where('boolean', 1)->get();
        $tags = Tag::all()->unique('tag');
        return view('auth.session.result')->with([
            'infos' => $infos,
            'tags' => $tags,
        ]);
    }

    //予約情報確認画面
    public function _reservations_store()
    {
        $infos = CakeInfo::where('boolean', 1)->get();
        $tags = Tag::all()->unique('tag');
        $id = Auth::user()->id;
        $today = Carbon::today();
        $reservations = Main_reservation::where('users_id', $id)->where('birthday', '>=', $today)->get();

        return view('auth.reservations')->with([
            'infos' => $infos,
            'tags' => $tags,
            'reservations' => $reservations,
        ]);
    }

    //お知らせ個別ページ移動
    public function _information_store(Information $Information)
    {
        $infos = CakeInfo::where('boolean', 1)->get();
        $tags = Tag::all()->unique('tag');
        $information = Information::where('id', $Information->id)->get();

        return view('cake.information')->with([
            'infos' => $infos,
            'tags' => $tags,
            'informations' => $information,
        ]);
    }
}

// public function ()
// {
//     $infos = CakeInfo::where('boolean', 1)->get();
//     $tags = Tag::all()->unique('tag');

//     return view('')->with([
//         'infos' => $infos,
//         'tags' => $tags,
//     ]);
// }
