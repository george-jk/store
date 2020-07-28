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
Route::prefix('admin')->middleware('verified')->group(function () {
	Route::get('routelist','RouteListController@index');
	Route::resource('orders','OrderController');
	Route::post('orders/status-change/{order}','OrderController@changeStatus')
		->name('orders.status-change');
	Route::resource('products','ProductsController');
	Route::resource('categories','CategoriesController');
	Route::resource('image','ImageController');
	Route::get('articles/add','ArticlesController@add');
	Route::resource('articles','ArticlesController');
	Route::get('terms/general','TermsController@indexGeneral')
		->name('terms.general');
	Route::get('terms/delivery','TermsController@indexDelivery')
		->name('terms.delivery');
	Route::resource('terms','TermsController');
});


// Route::get('category/{id}','CategoriesController@getProducts')->name('category.getProducts');
// Route::get('product/{id}','ProductsController@getCategory')->name('product.getCategory');


