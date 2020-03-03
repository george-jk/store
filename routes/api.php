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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
// 	return $request->user();
// });

Route::apiResource('category','API\CategoryController');
Route::apiResource('products','API\ProductsController');
Route::get('products-cat/{category_id}','API\ProductsController@getByCategory');
Route::get('search/{name}','API\ProductsController@search');
Route::get('terms/general/{id}','API\TermsController@showGeneral');
Route::get('terms/delivery/{id}','API\TermsController@showDelivery');
Route::apiResource('order','API\OrdersController');
Route::apiResource('contact','API\ContactsController');
