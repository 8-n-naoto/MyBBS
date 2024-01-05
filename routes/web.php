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

// Route::get('/', function () {
//     return view('welcome');
// });

use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InformationController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\ForgotPasswordLinkController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use GuzzleHttp\Middleware;

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



// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// require __DIR__.'/auth.php';

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

// //ログインペ―ジ
// Route::get('/login', [InformationController::class, 'login'])
//     ->name('login');
// //ログイン処理ページ
// Route::post('/', [InformationController::class, 'loginok'])
//     ->name('index');


//InformationController
Route::controller(InformationController::class)->middleware(['auth'])->group(function () {
    //個別ページ
    Route::get('/cake/{cakeinfo}', 'cakeinfo')->name('cake.cakeinfo');
    //予約用フォームページ
    Route::get('/form/{cakeinfo}', 'buy')->name('form');
    //フォーム確認画面
    Route::post('/form/formcheck', 'formcheck')->name('formcheck');
    //フォームOK画面
    Route::post('/form/formcheckok', 'reservation')->name('reservation');
});



//ReservationController
Route::controller(ReservationController::class)->middleware(['auth'])->group(function () {
    //管理画面トップ
    Route::get('/management/manage', [ReservationController::class, 'management'])
        ->name('management');
    //ON/OFF画面
    Route::get('/management/manage/edit', [ReservationController::class, 'edits'])
        ->name('cakeinfos');
    //個別設定ページ
    Route::get('/management/manage/edit/{cakeinfo}', [ReservationController::class, 'edit'])
        ->name('info.edit');


    //商品追加ページ
    Route::get('/management/create', [ReservationController::class, 'create'])
        ->name('create');
    //商品新規追加処理ページ
    Route::post('/management/store', [ReservationController::class, 'store'])
        ->name('posts.store');
    //商品情報更新処理(main)
    Route::patch('/management/manage/edit/update', [ReservationController::class, 'update'])
        ->name('update');
    //商品更新画面（price）
    Route::post('/management/manage/edit/addprice', [ReservationController::class, 'addprice'])
        ->name('add.price');
    //商品更新ページ(subphoto)
    Route::post('/management/manage/edit/addphoto', [ReservationController::class, 'addphoto'])
        ->name('add.photo');
    //商品情報削除ページ（main）
    Route::delete('/management/manage/edit/{cakeinfo}/destroy', [ReservationController::class, 'destroy'])
        ->name('destroy');
    //商品情報削除ページ（price）
    Route::delete('/management/manage/edit/{cakeinfosub}/destroyprice', [ReservationController::class, 'destroy_price'])
        ->name('destroy.price');
    //商品情報削除ページ（photo）
    Route::delete('/management/manage/edit/{cakephoto}/destroyphoto', [ReservationController::class, 'destroy_photo'])
        ->name('destroy.photo');

    //日付別総量確認画面(home)
    Route::get('/management/manage/date', [ReservationController::class, 'date'])
        ->name('date');
    //日付別総量確認画面(選択)
    Route::post('/management/manage/date/thedate', [ReservationController::class, 'thedate'])
        ->name('thedate');

    //総数表示ページ種類別
    Route::get('/management/manage/{cakeinfo}', [ReservationController::class, 'counts'])
        ->name('count');
});
