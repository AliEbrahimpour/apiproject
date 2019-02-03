<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::prefix('v1')->namespace('Api\v1')->group(function() {
    Route::post('register' , 'UserController@register');
    Route::post('login' , 'UserController@login');

    Route::middleware('auth:api')->group(function() {
        Route::get('user' , function () {
            return auth()->user();
        });

        Route::post('buy/{seller}' , 'SellerController@buy');
        Route::get('seller' , 'SellerController@index');
        Route::get('seller/{seller}' , 'SellerController@single');
        Route::post('setseller' , 'SellerController@register');

        Route::post('product/p-c' , 'CommentController@setting');
        Route::post('product/setcomment' , 'CommentController@setcomment');

        Route::get('product' , 'ProductController@index');
        Route::get('product/{product}' , 'ProductController@single');
        Route::post('product/{product}/setimage' , 'ProductController@setimage');
        Route::post('product/{product}/removeimage' , 'ProductController@removeimage');
        Route::get('showproduct' , 'ProductController@showproduct');

        Route::post('orderby' , 'AdminController@orderby');

        Route::get('transaction' , 'TransactionController@index');
        Route::get('transaction/{transaction}' , 'TransactionController@single');

        Route::get('buy' , 'BuyController@send');
        Route::get('callback' , 'BuyController@callback');
    });

});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
