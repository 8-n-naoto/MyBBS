<?php

// use Illuminate\Support\Facades\Route;

// /*
// |--------------------------------------------------------------------------
// | Web Routes
// |--------------------------------------------------------------------------
// |
// | Here is where you can register web routes for your application. These
// | routes are loaded by the RouteServiceProvider and all of them will
// | be assigned to the "web" middleware group. Make something great!
// |
// */

use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InformationController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\ForgotPasswordLinkController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\AdminRegisterController;
use App\Http\Controllers\CakeController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



/**
 * 名詞＋処理の名前
 *移動 store
 *追加・新規作成 update
 *更新 update
 *削除 destroy
 **/

//ログインページ
Route::get('login', [AuthenticatedSessionController::class, 'create'])
    ->name('login');
//ログイン処理
Route::post('login', [AuthenticatedSessionController::class, 'store']);
//ユーザー登録ページ
Route::get('/register', [RegisterController::class, 'create'])
    ->name('register');
//ログイン処理
Route::post('/register', [RegisterController::class, 'store'])
    ->name('register');
//ログアウト処理
Route::post('/logout', [Logoutcontroller::class, 'destroy'])
    ->middleware('auth');
//パスワードリセット
Route::post('/forgot-password', [ForgotPasswordLinkController::class, 'store']);
Route::post('/forgot-password/{token}', [ForgotPasswordController::class, 'reset']);


//管理者登録用
Route::controller(AdminRegisterController::class)->middleware(['auth'])->group(function () {
    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
        // 登録
        Route::get('register', 'create')->name('register');
        Route::post('register', 'store');
    });
});
//管理者ログイン用
Route::controller(AdminLoginController::class)->middleware(['auth'])->group(function () {
    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
        // ログイン
        Route::get('login', 'showLoginPage')->name('login');
        Route::post('login', 'login');
    });
});
//ログアウト処理
Route::post('/admin/logout', [Logoutcontroller::class, 'destroy'])
    ->middleware('auth:admin')
    ->name('admin.destroy');
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// ホーム
Route::get('/', [InformationController::class, 'index'])
    ->name('index');

/** ケーキ予約受付関係やお知らせ **/
Route::controller(InformationController::class)->middleware(['auth'])->group(function () {
    Route::group(['prefix' => 'front', 'as' => 'front.'], function () {
        //個別ページ
        Route::get('/{cakeinfo}/cake', '_cake_store')->name('cake')->where('cakeinfo', '[0-9]+');
        //tag別ページ
        Route::get('/{tag}/tag', '_tag_store')->name('tag');
        //予約詳細入力画面
        Route::get('/{cakeinfo}/form', '_form_store')->name('form')->where('cakeinfo', '[0-9]+');
        //フォーム確認画面
        Route::post('/form/formcheck', '_check_store')->name('check');
        //フォームOK画面
        Route::post('/form/formcheckok', '_result_store')->name('result');

        //お知らせ個別ページ
        Route::get('/{information}/post', '_information_store')->name('information.store')->where('information', '[0-9]+');
    });
});

/** ユーザーごとの情報関係 **/
Route::controller(InformationController::class)->middleware(['auth'])->group(function () {
    Route::group(['prefix' => 'user', 'as' => 'user.'], function () {

        /** お気に入り機能 **/
        // お気に入り移動
        Route::get('/favorite', '_favorite_store')->name('favorite.store');
        // お気に入り登録
        Route::post('/fovorite/add', '_favorite_add')->name('favorite.add');
        //お気に入り削除
        Route::delete('/favorite/{favorite}/destroy', '_favorite_destroy')->name('favorite.destroy')->where('favorite', '[0-9]+');

        /** 予約情報の確認 **/
        //予約確認画面移動
        Route::get('/reservations', '_reservations_store')->name('reservations.store');


        /** カート機能関係・リレーション使用 **/
        // カート移動
        Route::get('/cart', '_cart_store')->name('cart.store');
        // カート登録
        Route::post('/cart/add', '_cart_add')->name('cart.add');
        //カート削除
        Route::delete('/cart/{cart}/destroy', '_cart_destroy')->name('cart.destroy')->where('cart', '[0-9]+');
        //カート(メッセージ)更新
        Route::patch('/cart/{cart}/update', '_cart_update')->name('cart.update')->where('cart', '[0-9]+');
        //まとめて予約移動
        Route::get('/form', '_collect_form_store')->name('form.store');
        //まとめて予約確認画面へ移動
        Route::post('/form/check', '_collect_check_store')->name('check.store');
        //まとめて予約処理＋カートの中身削除処理+完了画面へ移動
        Route::post('/form/result', '_collect_result_store')->name('result.store');
        //ホームに返す
        Route::get('/form/return', '_collect_home_store')->name('home.store');

        /** カート機能関係・セッション使用 **/
        // カート移動
        Route::get('/session/cart', '_session_cart_store')->name('session.cart.store');
        //カート必要情報入力
        Route::post('/session/cart/reservation', '_session_cart_reservation')->name('session.cart.reservation');
        // カート登録
        Route::post('/session/cart/add', '_session_cart_add')->name('session.cart.add');
        //カート削除
        Route::delete('/session/cart/{key}/destroy', '_session_cart_destroy')->name('session.cart.destroy')->where('cart', '[0-9]+');
        //まとめて予約確認画面へ移動
        Route::get('/session/form', '_session_collect_form_store')->name('session.form.store');
        //まとめて予約処理＋カートの中身削除処理+完了画面へ移動
        Route::post('/session/form/result', '_session_collect_result_store')->name('session.result.store');
        //ホームに返す
        Route::get('/session/form/return', '_session_collect_home_store')->name('session.home.store');
    });
});


/** 管理画面系 **/
Route::controller(ReservationController::class)->middleware(['auth:admin'])->group(function () {
    Route::group(['prefix' => 'management/informations'], function () {
        //管理画面トップ
        Route::get('/', 'management')->name('management');   //_store

        //お知らせ一覧
        Route::get('/edits', '_information_edits_store')->name('information.edits.store');
        //お知らせ個別編集画面
        Route::get('/{information}/edit', '_information_edit_store')->name('information.edit.store')->where('information', '[0-9]+');
        //お知らせ個別編集画面
        Route::get('/criate/post', '_information_criate_store')->name('information.criate.store');
        //お知らせ投稿処理
        Route::post('/post', '_information_criate_post')->name('information.criate.post');
        //お知らせ削除処理
        Route::delete('/{information}/edit/destroy', '_information_edit_destroy')->name('information.edit.destroy')->where('information', '[0-9]+');
        //お知らせ更新処理
        Route::patch('/{information}/edit/update', '_information_edit_update')->name('information.edit.update')->where('information', '[0-9]+');
    });
});

/** 予約情報処理関係 **/
Route::controller(ReservationController::class)->middleware(['auth:admin'])->group(function () {
    Route::group(['prefix' => 'management/reservations', 'as' => 'reservations.'], function () {
        //日付別総量確認画面(home)
        Route::get('/date', '_date_store')->name('date.store');
        //日付別総量確認画面(指定)
        Route::post('/date', '_date_get')->name('date.get');
        //商品別総数表示ページ種類別(累計)
        Route::get('/{cakeinfo}/count', '_count_store')->name('count.store')->where('cakeinfo', '[0-9]+');
        //商品別総数表示ページ種類別(指定)
        Route::post('/{cakeinfo}/count', '_count_get')->name('count.get')->where('cakeinfo', '[0-9]+');
        //予約情報確認画面
        Route::get('/information', '_information_store')->name('information.store');
        //予約検索処理
        Route::post('/information', '_information_get')->name('information.get');
        //予約削除処理
        Route::delete('/{sub_reservation}information', '_information_destroy')->name('information.destroy');
    });
});

/** ケーキの情報処理関係 **/
Route::controller(CakeController::class)->middleware(['auth:admin'])->group(function () {
    Route::group(['prefix' => 'management/cake', 'as' => 'cakes.'], function () {
        //ON/OFF画面
        Route::get('/edit', '_suitch')->name('switch');
        //商品表示ON/OFF切り替え機能
        Route::patch('/{cakeinfo}/edit', '_boolean')->name('boolean')->where('cakeinfo', '[0-9]+');
        //商品追加ページ
        Route::get('/create', '_criate_store')->name('criate.store');
        //個別詳細変更画面
        Route::get('/{cakeinfo}/edit', '_update_store')->name('upudate.store')->where('cakeinfo', '[0-9]+');

        /** 追加処理一覧 **/
        //商品新規追加処理処理
        Route::post('/store', '_cake_criate')->name('cake.criate');
        //商品更新処理（price）
        Route::post('/edit/update/{cakeinfo}/addprice', '_price_criate')->name('price.criate');
        //商品更新画面(subphoto)
        Route::post('/edit/update/{cakeinfo}/addphoto', '_photo_criate')->name('photo.criate');
        //商品更新画面(tag)
        Route::post('/edit/update/{cakeinfo}/addtag', '_tag_criate')->name('tag.criate');

        /** 更新処理一覧 **/
        //商品情報更新処理(main)
        Route::patch('/edit/{cakeinfo}/update', '_cake_update')->name('cake.update')->where('cakeinfo', '[0-9]+');

        /** 削除処理一覧 **/
        //商品情報削除ページ（main）
        Route::delete('/edit/{cakeinfo}/destroy', '_cake_destroy')->name('cake.destroy')->where('cakeinfo', '[0-9]+');
        //商品情報削除ページ（price）
        Route::delete('/edit/{cakeinfosub}/destroyprice', '_price_destroy')->name('price.destroy')->where('cakeinfosub', '[0-9]+');
        //商品情報削除ページ（photo）
        Route::delete('/edit/{cakephoto}/destroyphoto', '_photo_destroy')->name('photo.destroy')->where('cakephoto', '[0-9]+');
        //商品情報削除ページ（tag）
        Route::delete('/edit/{tag}/destroytag', '_tag_destroy')->name('tag.destroy')->where('tag', '[0-9]+');
    });
});
