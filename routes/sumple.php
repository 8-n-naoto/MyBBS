<?php

use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| カート内商品関連
|--------------------------------------------------------------------------
*/
Route::view('/no-cartList', 'products/no_cart_list')->name('noCartlist');
Route::view('/purchaseCompleted', 'products/purchase_completed');

Route::resource('cartlist', 'ProductController', ['only' => ['index']]);
Route::post('productInfo/addCart/cartListRemove', 'ProductController@remove')->name('itemRemove');
Route::post('productInfo/addCart','ProductController@addCart')->name('addcart.post');
Route::post('productInfo/addCart/orderFinalize','ProductController@store')->name('orderFinalize');
