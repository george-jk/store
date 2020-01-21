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

Route::get('test','API\OrdersController@test');
Route::apiResource('category','API\CategoryController');
Route::apiResource('products','API\ProductsController');
Route::get('products-cat/{category_id}','API\ProductsController@getByCategory');
Route::get('search/{name}','API\ProductsController@search');

Route::apiResource('order','API\OrdersController');
