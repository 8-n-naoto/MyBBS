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
use Illuminate\Support\Facades\Auth;

class InformationController extends Controller
{

    // ホーム画面
    public function index()
    {
        $infos = CakeInfo::where('boolean', 1)->get();
        $tags = Tag::all()->unique('tag');

        return view('index')
            ->with([
                'infos' => $infos,
                'tags' => $tags,
            ]);
    }

    // tag別画面
    public function _tag_store(Tag $tag)
    {
        $infos = CakeInfo::all();
        $cakeinfo = Tag::where('tag', $tag->tag)->get();
        $tags = Tag::all()->unique('tag');

        return view('cake.tag')
            ->with([
                'infos' => $infos,
                'cakeinfo' => $cakeinfo,
                'tags' => $tags,
                'tag' => $tag,
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
        $subphotos = $cakeinfo;

        //お気に入り数表示
        $count = Favorite::where('cake_id', $cakeinfo->id)->count();

        return view('cake.cakeinfo')
            ->with([
                'infos' => $infos,
                'cakeinfos' => $cakeinfo,
                'subphotos' => $subphotos,
                'count' => $count,
                'tags' => $tags,
                'caketags' => $caketags,
            ]);
    }


    /** 予約フォーム関係 **/
    //予約詳細入力画面
    public function _form_store(CakeInfo $cakeinfo)
    {
        return view('cake.form')
            ->with([
                'info' => $cakeinfo,
                'prices' => $cakeinfo,
            ]);
    }
    // 予約情報確認画面
    public function _check_store(Request $request)
    {
        //トークン再生成
        $request->session()->regenerateToken();

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


        return view('cake.formcheck')
            ->with(['info' => $request]);
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

        $mainID = $id;
        $subID = $posts->id;
        return view('cake.formcheckok')
            ->with([
                'mainID' => $mainID,
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
            ->with([
                'mainID' => $mainID,
                'subID' => $subID,
            ]);
    }

    /** お気に入り機能関係 **/
    //お気に入り登録
    public function _favorite_add(Request $request)
    {
        //お気に入り登録
        $request->session()->regenerateToken();

        // $request->validate([
        //     'user_id' => 'required',
        //     'cake_id' => 'required',
        // ], [
        //     'user_id.required' => 'ログインしてください',
        //     'cake_id.required' => 'ログインしてください',
        // ]);

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
    public function _favorite_destroy(Favorite $favorite, Request $request)
    {
        //トークン再生成
        $request->session()->regenerateToken();

        $favorite->delete();

        $id = Auth::user()->id;
        $infos = Favorite::where('user_id', $id)
            ->whereHas('cake_info', function ($query) {
                $query->where('boolean', 1);
            })
            ->get();

        return view('auth.favorite')
            ->with([
                'infos' => $infos,
            ]);
    }
    //お気に入り移動
    public function _favorite_store()
    {
        $id = Auth::user()->id;
        $infos = Favorite::where('user_id', $id)
            ->whereHas('cake_info', function ($query) {
                $query->where('boolean', 1);
            })
            ->get();

        return view('auth.favorite')
            ->with([
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

        return view('auth.relation.cart')
            ->with([
                'infos' => $infos,
                'tags' => $tags,
                'carts' => $carts,
            ]);
    }
    //カート移動
    public function _cart_store()
    {
        $id = Auth::user()->id;
        $carts = Cart::where('user_id', $id)->get();
        $infos = CakeInfo::where('boolean', 1)->get();
        $tags = Tag::all()->unique('tag');

        if (!$carts) {
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

        return view('auth.relation.cart')
            ->with([
                'carts' => $carts,
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

        //inputタグのname属性を指定し$requestからPOST送信された内容を取得する。
        $cartData = [
            'cake_info_id' => $request->cake_info_id,  //
            'cake_info_sub_id' => $request->cake_info_sub_id,
            'mainphoto' => $request->mainphoto,  //
            'birthday' => $request->birthday, //
            'time' => $request->time, //
            'cakename' => $request->cakename,  //
            'capacity' => $request->capacity, //
            'price' => $request->price, //
            'message' => $request->message, //
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

        foreach ($cartData as $data) {
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
}
