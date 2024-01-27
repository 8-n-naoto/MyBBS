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
    public function _session_cart_sdd(Request $request)
    {
        //inputタグのname属性を指定し$requestからPOST送信された内容を取得する。
        $cartData = [
            'cake_info_id' => $request->cake_info->id,  //
            'cake_info_sub_id' => $request->cake_info_sub->id,
            'mainphoto'=>$request->cake_info->mainphoto,  //
            'birthday' => $request->birthday, //
            'time' => $request->time, //
            'cakename'=>$request->cake_info->cakename,  //
            'capacity'=>$request->cake_info_sub->capacity, //
            'price'=>$request->cake_info->price, //
            'message' => $request->message, //
        ];

        $request->session()->push('cartData', $cartData);

        return route('auth.relation.cartresult');
    }

    /*
    |--------------------------------------------------------------------------
    | カート内商品表示
    |--------------------------------------------------------------------------
    */
    public function _session_cart_store(Request $request)
    {
        //removeメソッドでの配列削除時の配列連番抜け対策
        if ($request->session()->has('cartData')) {
            $cartData = array_values($request->session()->get('cartData'));
        }

        if (!empty($cartData)) {
            //中身があればこっち
            return view('auth.relation.cartlist')->with([
                'cartData' => $cartData,
            ]);
        } else {
            //中身がなければこっち
            return view('auth.nocartlist');
        }
    }

    // /*
    // |--------------------------------------------------------------------------
    // | カート内商品の削除
    // |--------------------------------------------------------------------------
    // */
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

    // /*
    // |--------------------------------------------------------------------------
    // | カート内商品注文確定(DB登録)
    // |--------------------------------------------------------------------------
    // */
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

    // /*
    // |--------------------------------------------------------------------------
    // | 商品詳細画面
    // |--------------------------------------------------------------------------
    // */
    // public function show($id)
    // {
    //     //itemDetail/{id} パラメータのユーザIDを元にDBを検索しModelオブジェクト取得
    //     $product = Product::find($id);
    //     if (!empty($product)) {
    //         //productテーブルのcategory_idを取得、Category.phpを経由し該当idが所有するカテゴリー名を取得する
    //         $category_name = Category::find($product->category_id);
    //         $user = Auth::user();
    //         return view('products.productInfo', compact('product', 'category_name', 'user'));
    //     }

    //     return redirect()->route('noProduct');
    // }
}
