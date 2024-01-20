<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CakeInfo;
use App\Category;
use App\Order;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ProductController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | 商品詳細 → カート画面へのSession情報保存
    |--------------------------------------------------------------------------
    */
    public function addCart(Request $request)
    {
        //商品詳細画面のhidden属性で送信（Request）された商品IDと注文個数を取得し配列として変数に格納
        //inputタグのname属性を指定し$requestからPOST送信された内容を取得する。
        $cartData = [
            'session_cakes_id' => $request->cake_id,
            'session_quantity' => $request->cake_quantity,
            'message' => $request->message,
        ];

        //sessionにcartData配列が「無い」場合、商品情報の配列をcartData(key)という名で$cartDataをSessionに追加
        if (!$request->session()->has('cartData')) {
            $request->session()->push('cartData', $cartData);
        } else {
            //すでにあるsessionにcartData配列が「有る」場合、情報取得
            $sessionCartData = $request->session()->get('cartData');

            //isSameProductId定義 product_id同一確認フラグ false = 同一ではない状態を指定
            $isSameProductId = false;
            foreach ($sessionCartData as $index => $sessionData) {
                //product_idが同一であれば、フラグをtrueにする → 個数の合算処理、及びセッション情報更新。更新は一度のみ
                if ($sessionData['session_cakes_id'] === $cartData['session_cakes_id']) {
                    $isSameProductId = true;
                    $quantity = $sessionData['session_quantity'] + $cartData['session_quantity'];
                    $message = $cartData['messgae'];

                    //cartDataをrootとしたツリー状の多次元連想配列の特定のValueにアクセスし、指定の変数でValueの上書き処理
                    $request->session()->put('cartData.' . $index . '.session_quantity', $quantity);
                    $request->session()->put('cartData.' . $index . '.message', $message);

                    break;
                }
            }

            //product_idが同一ではない状態を指定 その場合であればpushする
            if ($isSameProductId === false) {
                $request->session()->push('cartData', $cartData);
            }
        }

        //POST送信された情報をsessionに保存 'users_id'(key)に$request内の'users_id'をセット
        $request->session()->put('users_id', ($request->users_id));
        return redirect()->route('cartlist.index');
    }

    /*
    |--------------------------------------------------------------------------
    | カート内商品表示
    |--------------------------------------------------------------------------
    */
    public function index(Request $request)
    {
        //渡されたセッション情報をkey（名前）を用いそれぞれ取得、変数に代入
        $sessionUser = User::find($request->session()->get('users_id'));

        //removeメソッドでの配列削除時の配列連番抜け対策
        if ($request->session()->has('cartData')) {
            $cartData = array_values($request->session()->get('cartData'));
        }

        if (!empty($cartData)) {
            $sessionCakesId = array_column($cartData, 'session_cakes_id');
            $cakeinfo = CakeInfo::with('cakecode')->find($sessionCakesId);

            foreach ($cartData as $index => &$data) {
                //二次元目の配列を指定している$dataに'cakeinfo〜'key生成 Modelオブジェクト内の各カラムを代入
                //＆で参照渡し 仮引数($data)の変更で実引数($cartData)を更新する
                $data['cakename'] = $cakeinfo[$index]->cakename;
                $data['capacity'] = $cakeinfo[$index]->capacity;
                $data['price'] = $cakeinfo[$index]->price;
                $data['message'] = $cakeinfo[$index]->message;
                //商品小計の配列作成し、配列の追加
                $data['itemPrice'] = $data['price'] * $data['session_quantity'];
            }

            //＆を外す
            unset($data);

            return view('products.cartlist')->with([
                'sessionUser' => $sessionUser,
                'cartData' => $cartData,
            ]);
        } else {
            return view('products.no_cart_list',  ['user' => Auth::user()]);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | カート内商品の削除
    |--------------------------------------------------------------------------
    */
    public function remove(Request $request)
    {

        // ↓これでも削除できる
        // $request->session()->forget('cartData.' . $index);

        //session情報の取得（product_idと個数の2次元配列）
        $sessionCartData = $request->session()->get('cartData');

        //削除ボタンから受け取ったproduct_idと個数を2次元配列に
        $removeCartItem = [
            [
                'session_cakes_id' => $request->cake_id,
                'session_quantity' => $request->product_quantity,
                'message' => $request->message,
            ]
        ];
        //sessionデータと削除対象データを比較、重複部分を削除し残りの配列を抽出
        $removeCompletedCartData = array_udiff($sessionCartData, $removeCartItem, function ($sessionCartData, $removeCartItem) {
            $result1 = $sessionCartData['session_cakes_id'] - $removeCartItem['session_cakes_id'];
            $result2 = $sessionCartData['session_quantity'] - $removeCartItem['session_quantity'];
            $result3 = $sessionCartData['message'] - $removeCartItem['message'];
            return $result1 + $result2 + $result3;
        });

        //上記の抽出情報でcartDataを上書き処理
        $request->session()->put('cartData', $removeCompletedCartData);
        //上書き後のsession再取得↓いる？？
        $cartData = $request->session()->get('cartData');

        //session情報があればtrue
        if ($request->session()->has('cartData')) {
            return redirect()->route('cartlist.index');
        }

        return view('products.no_cart_list', ['user' => Auth::user()]);
    }

    /*
    |--------------------------------------------------------------------------
    | カート内商品注文確定(DB登録)
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        //$request->session()->forget('cartData');
        $cartData = $request->session()->get('cartData');

        //オブジェクト生成
        $order = new \App\Models\Sub_reservation();
        //指定値をオブジェクト代入
        $order->user_id = Auth::user()->id;
        $order->order_number = rand();
        //認証済みのユーザーのみオブジェクトへ保存
        Auth::user()->main_reservation()->sub_reservations()->save($order);

        //Qrderテーブルの カラム「order_number」が「$order->order_number」の値を取得
        $savedOrder = Order::where('order_number', $order->order_number)->get();
        //上記Collectionから id の値だけを取得した配列に変換
        $savedOrderId = $savedOrder->pluck('id')->toArray();

        //注文詳細情報保存を注文数分繰り返す １回のリクエストを複数カラムに分けDB登録
        foreach ($cartData as $data) {
            //注文詳細情報に関わるオブジェクト生成
            $orderDetail = new \App\OrderDetail;
            $orderDetail->product_id = $data['session_products_id'];
            $orderDetail->order_id = $savedOrderId[0];
            $orderDetail->shipment_status_id = 1;
            $orderDetail->order_quantity = $data['session_quantity'];
            $orderDetail->save();
        }

        //session削除
        $request->session()->forget('cartData');
        return view('products/purchase_completed', compact('order'));
    }

    /*
    |--------------------------------------------------------------------------
    | 商品詳細画面
    |--------------------------------------------------------------------------
    */
    public function show($id)
    {
        //itemDetail/{id} パラメータのユーザIDを元にDBを検索しModelオブジェクト取得
        $product = Product::find($id);
        if (!empty($product)) {
            //productテーブルのcategory_idを取得、Category.phpを経由し該当idが所有するカテゴリー名を取得する
            $category_name = Category::find($product->category_id);
            $user = Auth::user();
            return view('products.productInfo', compact('product', 'category_name', 'user'));
        }

        return redirect()->route('noProduct');
    }
}
