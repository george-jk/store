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
]);

Route::prefix('admin')->group(function () {
	Route::resource('orders','OrderController')->middleware('verified');
	Route::post('orders/status-change/{order}','OrderController@changeStatus')->middleware('verified')->name('orders.status-change');
	Route::resource('products','ProductsController')->middleware('verified');
});


Route::resource('categories','CategoriesController')->names(['create'=>'category.create',])->middleware('verified');
Route::get('category/{id}','CategoriesController@getProducts')->name('category.getProducts');
Route::get('product/{id}','ProductsController@getCategory')->name('product.getCategory');

Route::get('/', 'HomeController@welcome');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin', 'HomeController@index');
Route::get('/admin/categories', 'CategoriesController@admin')->name('categories.admin')->middleware('verified');
Route::get('/admin/products', 'ProductsController@admin')->name('products.admin')->middleware('verified');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
