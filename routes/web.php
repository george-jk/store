<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes([
	'verify'=>true,
	'register'=>false,
	'reset'=>false,
]);
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin', 'HomeController@index');
Route::prefix('admin')->group(function () {
	Route::get('routelist','RouteListController@index')->middleware('verified');
	Route::resource('orders','OrderController')->middleware('verified');
	Route::post('orders/status-change/{order}','OrderController@changeStatus')->middleware('verified')->name('orders.status-change');
	Route::resource('products','ProductsController')->middleware('verified');
	Route::resource('categories','CategoriesController')->middleware('verified');
	Route::resource('image','ImageController')->middleware('verified');
	Route::resource('articles','ArticlesController')->middleware('verified');
	Route::get('terms/general','TermsController@indexGeneral')->middleware('verified')->name('terms.general');
	Route::get('terms/delivery','TermsController@indexDelivery')->middleware('verified')->name('terms.delivery');
	Route::resource('terms','TermsController')->middleware('verified');
});


Route::get('category/{id}','CategoriesController@getProducts')->name('category.getProducts');
Route::get('product/{id}','ProductsController@getCategory')->name('product.getCategory');


Route::get('/admin/products', 'ProductsController@admin')->name('products.admin')->middleware('verified');

